<?php

namespace App\Console\Commands;

use App\Http\Repositories\ClientRepository;
use App\Http\Repositories\CompanyRepository;
use App\Http\Repositories\EmployeeRepository;
use App\Models\User;
use Illuminate\Console\Command;

class MakeUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user {--type=*} {--name=*} {--lastname=*} {--email=*} {--password=*} {--company=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a user command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param EmployeeRepository $employeeRepository
     * @param ClientRepository $clientRepository
     * @return void
     */
    public function handle(
        EmployeeRepository $employeeRepository,
        ClientRepository $clientRepository
    ) {
        $type = isset($this->option('type')[0]) ? $this->option('type')[0] : null;
        $name = isset($this->option('name')[0]) ? $this->option('name')[0] : null;
        $lastName = isset($this->option('lastname')[0]) ? $this->option('lastname')[0] : null;
        $email = isset($this->option('email')[0]) ? $this->option('email')[0] : null;
        $password = isset($this->option('password')[0]) ? $this->option('password')[0] : null;
        $company = isset($this->option('company')[0]) ? $this->option('company')[0] : null;

        $data = [
            'first_name' => $name,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $password
        ];

        if ($type == 'employee') {
            $data['role_id'] = 1;

            try {
                $employeeRepository->save($data);
            } catch (\Throwable $e) {
                dd($e);
            }
        }

        if ($type == 'client') {
            $data['role_id'] = 2;
            $data['company_id'] = $company ? $company : 1;

            try {
                $clientRepository->save($data);
            } catch (\Throwable $e) {
                dd($e);
            }
        }
    }
}
