<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('formatDob', function ($dob) {
            return "<?php echo \Carbon\Carbon::parse($dob)->translatedFormat('d F Y'); ?>";
        });
        
        Blade::directive('nameMonth', function ($month) {
            return "<?php echo \Carbon\Carbon::createFromFormat('m', $month)->translatedFormat('F'); ?>";
        });

        Blade::directive('rupiah', function ($amount) {
            return "<?php echo 'Rp. ' . number_format($amount, 0, ',', '.'); ?>";
        });

        Blade::directive('formatRupiah', function ($amount) {
            return "<?php echo 'Rp. ' . number_format($amount, 0, ',', '.'); ?>";
        });
        
    }
}
