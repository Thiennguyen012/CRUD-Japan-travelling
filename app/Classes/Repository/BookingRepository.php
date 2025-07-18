<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IBookingRepository;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class BookingRepository extends BaseRepository implements IBookingRepository
{
    public function __construct(Booking $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function search(array $conditions) : Collection
    {
        return $this->model->when(isset($conditions["customer_name"]), function ($query) use ($conditions) {
            $query->where("customer_name", "like", "%{$conditions["customer_name"]}%");
        })->when(isset($conditions["customer_contact"]), function ($query) use ($conditions) {
            $query->where("customer_contact", "like", "%{$conditions["customer_contact"]}%");
        })->when(isset($conditions["checkin_time"]), function ($query) use ($conditions) {
            $query->where("checkin_time", ">=", Carbon::parse($conditions["checkin_time"])->format('Y-m-d H:i:s'));
        })->when(isset($conditions["checkout_time"]), function ($query) use ($conditions) {
            $query->where("checkout_time", "<=", Carbon::parse($conditions["checkout_time"])->format('Y-m-d H:i:s'));
        })->get();
    }
}
