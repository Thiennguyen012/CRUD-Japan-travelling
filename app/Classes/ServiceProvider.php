<?php

namespace App\Classes;

use Illuminate\Support\Facades\App;
use App\Classes\Services as Service;
use App\Classes\Services\Interfaces as IService;
use Illuminate\Support\ServiceProvider as LServiceProvider;

class ServiceProvider extends LServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(IService\IHotelService::class, Service\HotelService::class);
        App::bind(IService\IPrefectureService::class, Service\PrefectureService::class);
        App::bind(IService\IBookingService::class, Service\BookingService::class);
    }
}
