<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Sleep;

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

        DB::listen(function (QueryExecuted $query) {
            $dumpQuery = [
                'SQL'   =>  $query->sql,
                'BINDINGS'  =>  $query->bindings,
                'TIME(ms)'  =>  $query->time,
            ];
            Log::channel('query')->info(print_r($dumpQuery, true));
            // Log::debug(print_r($dumpQuery,true));
        });
        // Sleep::sleep(2);
        // new Sleep(1)->seconds();

    }
}
