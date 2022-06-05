<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResourceGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:resources';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate resources';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $list = [
            '',
        ];

        foreach ($list as $name)
        {
            $this->call('make:request', [
                'name' => $name . 'Request'
            ]);
            $this->call('make:seeder', [
                'name' => $name . 'Seeder'
            ]);
            $this->call('make:controller', [
                'name' => $name . 'Controller', '--model' => $name, '--api' => true
            ]);
        }

        foreach ($list as $name)
        {
            $this->call('make:model', [
                'name' => $name, '-m' => true
            ]);
        }
        return 0;
    }
}
