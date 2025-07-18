<?php

namespace App\Classes\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IPrefectureService
{
    /**
     * Get all perfecture
     * @param array $data
     * @return Collection
     */
    public function getAll() : Collection;
}

