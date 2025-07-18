<?php

namespace App\Http\Controllers\Api;

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
    protected $prefecture;
    protected $hotel;
    // tạo constructor
    public function __construct(Prefecture $prefecture, Hotel $hotel)
    {
        $this->prefecture = $prefecture;
        $this->hotel = $hotel;
    }

    /**
     * Display a listing of the resource.
     */
    // show list của hotel dựa vào prefecture
    public function index()
    {
        $hotel = $this->hotel->with('prefecture')->get();

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
        $hotel = $this->hotel->fill($request->all());
        $hotel->save();
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
        if (!$id) {
            return response()->json([
                'success' => false,
                'error' => 'No Hotel ID provided!',
            ]);
        }
        $hotel = $this->hotel->where('hotel_id', $id)->first();
        if (!$hotel) {
            return response()->json([
                'success' => false,
                'error' => 'No Hotel Id matched with ' . $id,
            ]);
        }
        return response()->json([
            'success' => 'true',
            'message' => 'Detail of Hotel ID: ' . $id,
            'data' => $hotel,
        ]);
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
    public function update(StoreHotelRequest $request, string $id)
    {
        $hotel = $this->hotel->where('hotel_id', $id)->first();
        // nếu dùng ->get() thì tức là mảng hotel vẫn tồn tại nhưng số phần tử là 0
        // dùng ->first() trả về object nếu không có bản ghi thì sẽ trả về null
        if (!$hotel) {
            return response()->json([
                'success' => false,
                'error' => 'Hotel not Found!'
            ]);
        }
        // lấy dữ liệu đã qua validate
        $validated_data = $request->validated();

        // cập nhật dữ liệu
        // lúc này biến hotel đã có giá trị rồi
        $hotel->update($validated_data);

        // cập nhật quan hệ với các class khác
        // cụ thể là với prefecture vì hotel belong to prefecture
        $hotel->load('prefecture');
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
        $hotel = $this->hotel->where('hotel_id', $id)->first();
        if (!$hotel) {
            return response()->json([
                'success' => false,
                'error' => 'Hotel not Found!'
            ]);
        } else {
            $hotel->delete();
            return response()->json([
                'success' => true,
                'message' => 'Hotel id ' . $id . ' has been deleted successfully!',
            ]);
        }
    }
    // các function customize
    public function getHotelByPrefName($prefecture_name)
    {
        if (!$prefecture_name) {
            return response()->json([
                'success' => false,
                'error' => 'No prefecture name provided',
            ], 400);
        }

        $prefecture = $this->prefecture->where('prefecture_name_alpha', $prefecture_name)->first();

        if (!$prefecture) {
            return response()->json([
                'success' => false,
                'error' => 'No prefecture matched with ' . $prefecture_name,
            ], 404);
        }

        $hotels = $this->hotel->where('prefecture_id', $prefecture->prefecture_id)->with('prefecture')->get();

        return response()->json([
            'success' => true,
            'message' => 'List hotel of ' . $prefecture_name,
            'prefecture' => $prefecture,
            'data' => $hotels,
            'count' => $hotels->count(),
        ], 200);
    }
}
