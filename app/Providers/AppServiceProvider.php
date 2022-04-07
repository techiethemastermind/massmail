<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // CryptoApi Blockchain data Macro
        Http::macro('cryptoapi', function () {
            return Http::withHeaders([
                'X-API-Key'    => config('keys.api.crypto'),
                'Content-Type' => 'application/json'
            ])->baseUrl('https://rest.cryptoapis.io/v2/');
        });
    }
}
