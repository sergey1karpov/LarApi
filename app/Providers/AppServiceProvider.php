<?php

namespace App\Providers;

use App\Http\Interfaces\TicketSellerInterface;
use App\Http\TicketServiceOne;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TicketSellerInterface::class, function ($app) {
            return match ($app->make('config')->get('services.ticket-seller')) {
                'seller_1' => new TicketServiceOne(),
                default => throw new \RuntimeException("Unknown ticket seller service"),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
