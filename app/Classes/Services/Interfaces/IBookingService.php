<?php

namespace App\Classes\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IBookingService
{
    /**
     * search booking by request
     * 
     * @param array $conditions
     * 
     * @return Collection
     */
    public function search(array $conditions) : Collection;
}

