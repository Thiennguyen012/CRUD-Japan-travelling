<?php

namespace App\Http\Controllers\Api;

use App\Classes\Services\PrefectureService;
use App\Classes\Services\HotelService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHotelRequest;
use App\Models\Hotel;
use App\Models\Prefecture;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelController extends Controller
{
    protected $prefectureService;
    protected $hotelService;
    // tạo constructor inject service vào
    public function __construct(PrefectureService $prefectureService, HotelService $hotelService)
    {
        $this->prefectureService = $prefectureService;
        $this->hotelService = $hotelService;
    }

    /**
     * Display a listing of the resource.
     */
    // show list của hotel dựa vào prefecture
    public function index()
    {
        $hotel = $this->hotelService->listHotel();

        return response()->json([
            'success' => true,
            'message' => 'All hotels retrieved successfully',
            'count' => $hotel->count(),
            'data' => $hotel,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHotelRequest $request)
    {
        // pass qua request, thêm dữ liệu mới 
        $hotel = $this->hotelService->newHotel($request);
        return response()->json([
            'success' => true,
            'message' => 'New Hotel has been added successfully!',
            'data' => $hotel,
        ]);
    }

    /**
     * Display the specified resource.
     */
    // show data cua hotel voi id truyen vao
    public function show(string $id)
    {
        try {
            $hotel = $this->hotelService->findById($id);

            return response()->json([
                'success' => true,
                'message' => 'Detail of Hotel ID: ' . $id,
                'data' => $hotel,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Hotel with ID ' . $id . ' not found!',
                'message' => 'Please provide a valid hotel ID'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // Dùng phương thức PUT/PATCH
    // update thông tin của 1 hotel
    public function update(StoreHotelRequest $request, int $id)
    {
        $hotel = $this->hotelService->updateById($request, $id);
        // nếu dùng ->get() thì tức là mảng hotel vẫn tồn tại nhưng số phần tử là 0
        // dùng ->first() trả về object nếu không có bản ghi thì sẽ trả về null

        if (!$hotel) {
            return response()->json([
                'success' => false,
                'error' => 'Hotel not Found!'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Hotel with ID: ' . $id . ' has been updated successfully!',
            'data' => $hotel,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Lấy hotel object trước
            $hotel = $this->hotelService->findById($id);

            // Kiểm tra xem có thể xóa không (nếu có booking thì không được xóa)
            if (!$this->hotelService->canDeleteHotel($hotel)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Cannot delete hotel because it has existing bookings!',
                    'message' => 'Please remove all bookings first'
                ], 400);
            }

            // Gọi hàm delete với hotel object
            $this->hotelService->delete($hotel);

            return response()->json([
                'success' => true,
                'message' => 'Hotel ID ' . $id . ' has been deleted successfully!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Hotel with ID ' . $id . ' not found!',
                'message' => 'Please provide a valid hotel ID'
            ], 404);
        }
    }
    // các function customize
    public function getHotelByPrefName($prefecture_name)
    {
        $hotel = $this->hotelService->getHotelByPrefName($prefecture_name);
        if (!$hotel) {
            return response()->json([
                'success' => false,
                'error' => 'Not found any restaurant in prefecture name ' . $prefecture_name,
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'List hotel of ' . $prefecture_name,
            'data' => $hotel,
            'count' => $hotel->count(),
        ], 200);
    }
}
