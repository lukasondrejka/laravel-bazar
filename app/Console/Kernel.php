<?php

namespace App\Console;

use App\Product;
use App\ProductImage;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $productImages = ProductImage::where('product_id', null)->where('created_at', '<=', Carbon::now()->subHour(2))->get();

            foreach($productImages as $image){
                $image->deleteImage();
            }
        })->everyMinute();

        $schedule->call(function () {
            $products = Product::where('created_at', '<=', Carbon::now()->subMonths(2))->get();

            foreach($products as $product){
                $image->softDelete();
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
