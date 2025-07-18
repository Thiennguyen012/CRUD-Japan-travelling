<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IHotelRepository;
use App\Classes\Services\Interfaces\IHotelService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\Hotel;

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
    public function create(array $data) : Hotel
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
    public function update(Hotel $hotel, array $data) : bool
    {
        if (!empty($data['image'])) {
            $data['file_path'] = $this->storeHotelImage($data['image']);
        }
        return $this->hotelRepository->update($hotel, $data);
    }

    /**
     * @inheritdoc
     */
    public function findById(?int $hotelId = null) : Hotel|ModelNotFoundException 
    {
        $hotel = $this->hotelRepository->findById($hotelId);
        return $hotel;
    }

    /**
     * @inheritdoc
     */
    public function canDeleteHotel(Hotel $hotel) : bool 
    {
        return !$hotel->bookings()->exists();
    }

    /**
     * @inheritdoc
     */
    public function delete(Hotel $hotel) : void 
    {
        $this->hotelRepository->delete($hotel);
    }

    private function storeHotelImage(UploadedFile $file) : string
    {
        $imagePath = $file->store('hotel', 'asset_path');
        return $imagePath;
    }
}
