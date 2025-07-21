<?php

namespace App\Classes;

use Illuminate\Support\Facades\App;
use App\Classes\Repository\Interfaces as IRepository;
use App\Classes\Repository as Repository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
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
        App::bind(IRepository\IHotelRepository::class, Repository\HotelRepository::class);
        App::bind(IRepository\IPrefectureRepository::class, Repository\PrefectureRepository::class);
        App::bind(IRepository\IBookingRepository::class, Repository\BookingRepository::class);
        // binding cho IRestaurantRepository
        App::bind(IRepository\IRestaurantRepository::class, Repository\RestaurantRepository::class);
    }
}
