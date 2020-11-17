<?php

namespace App\Console\Commands;

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
    protected $signature = 'make:user {--type=*} {--name=*} {--lastname=*} {--email=*} {--password=*}';

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
     * @return void
     */
    public function handle(EmployeeRepository $employeeRepository)
    {
        $type = $this->option('type')[0];
        $name = $this->option('name')[0];
        $lastName = $this->option('lastname')[0];
        $email = $this->option('email')[0];
        $password = $this->option('password')[0];

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
    }
}
