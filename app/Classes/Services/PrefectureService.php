<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IPrefectureRepository;
use App\Classes\Services\Interfaces\IPrefectureService;
use Illuminate\Database\Eloquent\Collection;

/**
 * Implement PrefectureService
 */
class PrefectureService implements IPrefectureService
{
    private $prefectureRepository;

    public function __construct(IPrefectureRepository $prefectureRepository)
    {
        $this->prefectureRepository = $prefectureRepository;
    }

    /**
     * @inheritdoc
     */
    public function getAll() : Collection
    {
        return $this->prefectureRepository->find();
    }
}
