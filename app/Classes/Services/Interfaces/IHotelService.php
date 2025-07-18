<?php

namespace App\Classes\Services\Interfaces;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface IHotelService
{
    /**
     * Create hotel
     * 
     * @param array $data
     * 
     * @return Hotel
     */
    public function create(array $data) : Hotel;

    /**
     * Update hotel
     * 
     * @param Hotel $hotel
     * @param array $data
     */
    public function update(Hotel $hotel, array $data) : bool;

    /**
     * find hotel by id
     * 
     * @param ?int $hotelId
     * 
     * @return Hotel|ModelNotFoundException
     */
    public function findById(?int $hotelId = null) : Hotel|ModelNotFoundException;

    /**
     * Check if this hotel can be deleted?
     * 
     * @param Hotel $hotel
     * 
     * @return bool
     */
    public function canDeleteHotel(Hotel $hotel) : bool;

    /**
     * Delete hotel
     * 
     * @param Hotel $hotel
     */
    public function delete(Hotel $hotel) : void;
}

