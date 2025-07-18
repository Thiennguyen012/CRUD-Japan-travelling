<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IHotelRepository;
use App\Models\Hotel;

class HotelRepository extends BaseRepository implements IHotelRepository
{
    public function __construct(Hotel $model)
    {
        parent::__construct($model);
    }
}
