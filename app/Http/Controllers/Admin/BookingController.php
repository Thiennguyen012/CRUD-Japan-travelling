<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Classes\Services\Interfaces\IBookingService;
use App\Http\Requests\Admin\BookingSearchRequest;

class BookingController extends Controller
{
    private $bookingService;

    public function __construct(
        IBookingService $bookingService
    ) {
        $this->bookingService = $bookingService;
    }

    /** get methods */

    public function showSearch(): View
    {
        $vars = [
            'customer_name' => '',
            'customer_contact' => '',
            'checkin_time' => '',
            'checkout_time' => '',
        ];
        return view('admin.booking.search', compact('vars'));
    }

    /** post methods */

    public function searchResult(BookingSearchRequest $request): View
    {
        $vars = $request->all();
        $bookings = $this->bookingService->search($vars);
        return view('admin.booking.result', compact('bookings', 'vars'));
    }
}
