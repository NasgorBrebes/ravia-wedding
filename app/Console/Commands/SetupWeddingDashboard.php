<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupWeddingDashboard extends Command
{
    protected $signature = 'wedding:setup';
    protected $description = 'Setup wedding dashboard';

    public function handle()
    {
        $this->info('Setting up Wedding Dashboard...');

        // Run migrations
        $this->info('Running migrations...');
        Artisan::call('migrate');

        // Run seeders
        $this->info('Seeding database...');
        Artisan::call('db:seed', ['--class' => 'WeddingSettingSeeder']);

        // Create storage link
        $this->info('Creating storage link...');
        Artisan::call('storage:link');

        $this->info('Wedding Dashboard setup completed!');
        $this->info('You can now access the admin dashboard at: /admin/dashboard');
    }
}
