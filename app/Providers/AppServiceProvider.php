<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
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
        Blade::directive('harga', function ( $expression ) { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });
        Blade::directive('tanggal', function ($expression) {
            return "<?php echo \Carbon\Carbon::parse($expression)->locale('id')->translatedFormat('l, d F Y'); ?>";
        });
        // if (config('app.env') === 'local') {
        //     URL::forceScheme('https');
        // }
    }
}
