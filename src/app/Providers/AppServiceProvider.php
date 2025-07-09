<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use PetstoreClient\Api\PetApi;
use PetstoreClient\Configuration;
use App\Contracts\PetApiInterface;
use App\Services\PetApiService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PetApi::class, function ($app) {
            $guzzleClient = Http::buildClient();

            $config = new Configuration();
            $token = env('PETSTORE_API_TOKEN', 'special-key');
            $config->setAccessToken($token);

            return new PetApi($guzzleClient, $config);
        });

        $this->app->bind(PetApiInterface::class, PetApiService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
