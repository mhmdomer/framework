<?php

namespace Illuminate\Foundation\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class OptimizeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'optimize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache the framework bootstrap files';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $confirmationMessage = 'Further configuration and routes changes will not take effect unless you run the command again or clear the cache, are you sure you want to run this command?';
        if (App::isLocal() && ! $this->confirm($confirmationMessage)) {
            return 1;
        }

        $this->call('config:cache');
        $this->call('route:cache');

        $this->info('Files cached successfully.');
    }
}
