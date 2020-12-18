<?php

namespace Database\Seeders;

use App\Http\Repositories\ClientRepository;
use App\Http\Repositories\EmployeeRepository;
use App\Models\Client;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /** @var EmployeeRepository */
    private $employeeRepository;

    /** @var ClientRepository */
    private $clientRepository;

    /**
     * UserSeeder constructor.
     * @param EmployeeRepository $employeeRepository
     * @param ClientRepository $clientRepository
     */
    public function __construct(
        EmployeeRepository $employeeRepository,
        ClientRepository $clientRepository
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->clientRepository = $clientRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (CompanySeeder::$companies as $company) {
            for ($i = 0; $i < 5; $i++) {
                User::factory()->create([
                    'profile_id' => Client::factory()->create([
                        'company_id' => Company::where('name', $company)->first()->id
                    ])
                ]);
            }
        }

        $data = [
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@foodatelier.nl',
            'password' => 'test',
            'role_id' => 1
        ];

        $this->employeeRepository->save($data);

        $data = [
            'first_name' => 'test',
            'last_name' => 'test',
            'email' => 'test@foodatelier.nl',
            'password' => 'test',
            'role_id' => 2,
            'company_id' => 1
        ];

        $this->clientRepository->save($data);
    }
}