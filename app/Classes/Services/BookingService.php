<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IBookingRepository;
use App\Classes\Services\Interfaces\IBookingService;
use Illuminate\Database\Eloquent\Collection;

/**
 * Implement BookingService
 */
class BookingService implements IBookingService
{
    private $bookingRepository;

    public function __construct(IBookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * @inheritdoc
     */
    public function search(array $conditions) : Collection
    {
        return $this->bookingRepository->search($conditions);
    }
}
