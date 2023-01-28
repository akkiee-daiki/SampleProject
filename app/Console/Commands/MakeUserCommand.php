<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:makeUser {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make user especially for authenticated user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = new User;

        $user->name = $this->argument('name');
        $user->email = $this->argument('email');
        $user->password = bcrypt($this->argument('password'));

        $user->save();

    }
}
