<?php

namespace App\Classes\Repository\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IBookingRepository extends IBaseRepository
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
