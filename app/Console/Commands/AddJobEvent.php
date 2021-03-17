<?php

namespace App\Console\Commands;

use App\Jobs\AddJob;
use App\Jobs\CreateOrderJob;
use Illuminate\Console\Command;

class AddJobEvent extends Command
{
    protected $signature = 'add_job';

    public function handle()
    {
        $data = [
            'name' => 'Fabio',
            'email' => 'fabio@fabiofarias.com.br',
            'cc' => '9999222233334444',
            'exp' => '23/28'
        ];

        AddJob::dispatch($data);
    }
}
