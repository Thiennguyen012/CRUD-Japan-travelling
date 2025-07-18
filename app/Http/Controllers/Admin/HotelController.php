<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Hotel;
use App\Classes\Services\Interfaces\IPrefectureService;
use App\Classes\Services\Interfaces\IHotelService;
use App\Http\Requests\Admin\StoreHotelRequest;
use App\Http\Requests\Admin\HotelSearchRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class HotelController extends Controller
{
    private $prefectureService, $hotelService;

    public function __construct(
        IPrefectureService $prefectureService,
        IHotelService $hotelService
    ) {
        $this->prefectureService = $prefectureService;
        $this->hotelService = $hotelService;
    }

    /** get methods */

    public function showSearch(): View
    {
        $var = [];
        $prefectures = $this->prefectureService->getAll();

        $var = [
            'hotel_name' => '',
            'prefecture_id' => ''
        ];

        return view('admin.hotel.search', compact('prefectures', 'var'));
    }

    public function showResult(): View
    {
        return view('admin.hotel.result');
    }

    public function showEdit(Request $request): View
    {
        $hotel = $this->hotelService->findById($request->hotel_id);
        $prefectures = $this->prefectureService->getAll();
        return view('admin.hotel.edit', compact('hotel', 'prefectures'));
    }

    public function showCreate(): View
    {
        $prefectures = $this->prefectureService->getAll();
        return view('admin.hotel.create', compact('prefectures'));
    }

    /** post methods */

    public function searchResult(HotelSearchRequest $request): View
    {
        $var = [];

        $prefectures = $this->prefectureService->getAll();
        $hotelNameToSearch = $request->input('hotel_name');
        $prefectureIdToSearch = $request->input('prefecture_id');
        $hotelList = Hotel::getHotelListByName($hotelNameToSearch, $prefectureIdToSearch);

        $var = [
            'hotel_name' => $request->hotel_name,
            'prefecture_id' => $request->prefecture_id
        ];

        return view('admin.hotel.result', compact('hotelList', 'prefectures', 'var'));
    }

    public function edit(StoreHotelRequest $request): View
    {
        $hotel = $this->hotelService->findById($request->hotel_id);
        $this->hotelService->update($hotel, $request->all());
        Session::flash('success', "変更しました。 !");
        return view('admin.hotel.complete', compact('hotel'));
    }

    public function create(StoreHotelRequest $request): RedirectResponse
    {
        $hotel = $this->hotelService->create($request->all());
        return redirect()->route('adminHotelEditPage', ['hotel_id' => $hotel->hotel_id])->with('success', '作成しました。');
    }

    public function delete(Request $request): RedirectResponse
    {
        $hotel = $this->hotelService->findById($request->hotel_id);
        if (false === $this->hotelService->canDeleteHotel($hotel)) {
            return redirect()->route('adminHotelSearchPage')->with('error', 'ホテルは既に予約があるため、削除できません。');
        }
        $this->hotelService->delete($hotel);
        return redirect()->route('adminHotelSearchPage')->with('success', 'ホテルを削除しました。');
    }
}
