<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IPrefectureRepository;
use App\Models\Prefecture;

class PrefectureRepository extends BaseRepository implements IPrefectureRepository
{
    public function __construct(Prefecture $model)
    {
        parent::__construct($model);
    }
}
