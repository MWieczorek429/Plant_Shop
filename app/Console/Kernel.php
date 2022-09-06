<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Product;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call( function(){

            $items = DB::table('orders')->select('detail')                
            ->where('paid','=',0)
            ->where('created_at', '<',  Carbon::now()->subMinute(15))
            ->first();
    
            $items = json_decode($items->detail, true);
    
            foreach($items as $key => $value){
    
                $product = Product::where('name','=',$key)->first();
                Product::where('name','=', $key)->update([
                    'stock' => $product->stock + $value,
                ]);

                if(Product::where('name','=','kawa')->where('available','=', 0)->value('stock') > 0)
                {
                    Product::where('name','=', $key)->update([
                        'available' => 1,
                    ]);
                }
            }

            DB::table('orders')
                ->where('paid','=',0)
                ->where('created_at', '<',  Carbon::now()->subMinute(15))
                ->delete();

        })->everyFifteenMinutes();
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
