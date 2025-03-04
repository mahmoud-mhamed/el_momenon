<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeployCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Deploying...');
        $this->runExec('git restore .');
        $this->runExec('git pull');
        $this->runExec('composer install --no-interaction --prefer-dist --optimize-autoloader');
        $this->runExec('sudo -S service php8.3-fpm reload');
        $this->runExec('php artisan migrate --force');
        $this->runExec('php artisan lang:run');
        $this->runExec('php artisan ability:run');
        $this->runExec('npm install');
        $this->runExec('npm run build');
        $this->info('Deployed completed successfully.');
    }

    /**
     * @param $command
     * @return void
     */
    private function runExec($command): void
    {
        $this->info("Running command: {$command}");
        $this->newLine();

        exec($command, $output, $returnVar);

        foreach ($output as $line) {
            $this->line($line);
        }
        if ($returnVar !== 0) {
            $this->error("Failed to call $command");
            return; // Error code
        }
        $this->newLine();
    }
}
