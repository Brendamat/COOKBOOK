<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;

class TestRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testa se todos os usuário possuem cargos atribuidos.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        $fails = 0;
        foreach ($users as $user) {
            if ($user->role_id == null) {
                $this->error("O usuário {$user->name} não possui cargos atribuídos.");
                $fails++;
            } else {
                $this->info("O usuário {$user->name} possui cargos atribuídos.");
            }
        }

        if ($fails > 0) {
            $this->error("Existem {$fails} usuários sem cargos atribuídos.");
        } else {
            $this->info("Sucesso. Todos os usuários {$users->count()} possuem cargos atribuídos.");
        }
    }
}
