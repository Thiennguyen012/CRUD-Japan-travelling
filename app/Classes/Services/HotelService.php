<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IHotelRepository;
use App\Classes\Services\Interfaces\IHotelService;
use App\Http\Requests\Admin\StoreHotelRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\Hotel;
use App\Classes\Repository\PrefectureRepository;

/**
 * Implement HotelService
 */
class HotelService implements IHotelService
{
    private $hotelRepository;

    public function __construct(IHotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    /**
     * @inheritdoc
     */
    public function create(array $data): Hotel
    {
        if (!empty($data['image'])) {
            $data['file_path'] = $this->storeHotelImage($data['image']);
        }
        $hotel = $this->hotelRepository->create($data);
        return $hotel;
    }

    /**
     * @inheritdoc
     */
    public function update(Hotel $hotel, array $data): bool
    {
        if (!empty($data['image'])) {
            $data['file_path'] = $this->storeHotelImage($data['image']);
        }
        return $this->hotelRepository->update($hotel, $data);
    }

    /**
     * @inheritdoc
     */
    public function findById(?int $hotelId = null): Hotel|ModelNotFoundException
    {
        $hotel = $this->hotelRepository->findById($hotelId);
        return $hotel;
    }

    /**
     * @inheritdoc
     */
    public function canDeleteHotel(Hotel $hotel): bool
    {
        return !$hotel->bookings()->exists();
    }

    /**
     * @inheritdoc
     */
    public function delete(Hotel $hotel): void
    {
        $this->hotelRepository->delete($hotel);
    }

    private function storeHotelImage(UploadedFile $file): string
    {
        $imagePath = $file->store('hotel', 'asset_path');
        return $imagePath;
    }

    public function listHotel()
    {
        $condition = [];
        $hotel = $this->hotelRepository->find($condition);
        return $hotel;
    }
    public function newHotel(StoreHotelRequest $request)
    {
        $hotel = $this->hotelRepository->create($request->all());
        return $hotel;
    }
    public function updateById(StoreHotelRequest $request, int $id)
    {
        $hotel = $this->hotelRepository->findOne(['hotel_id' => $id]);
        if (!$hotel) return null;
        $hotel->update($request->all());

        return $hotel;
    }
    public function getHotelByPrefName(string $prefecture_name)
    {
        $prefecture = app(PrefectureRepository::class)->findOne(['prefecture_name_alpha' => $prefecture_name]);
        if (!$prefecture) return null;
        $hotel = $this->hotelRepository->find(['prefecture_id' => $prefecture->prefecture_id]);
        return $hotel;
    }
}
