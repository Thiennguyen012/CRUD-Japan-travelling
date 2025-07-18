<!-- base view -->
@extends('common.admin.base')

<!-- CSS per page -->
@section('custom_css')
    @vite('resources/scss/admin/hotel.scss')
@endsection

<!-- main contents -->
@section('main_contents')
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">ホテル編集</h2>
        <hr>
        <div class="search-hotel-name">
            <div class="content-area">
                @if (session('success'))
                <div class="alert-wrapper">
                    <div class="alert-success">{{ session('success') }}</div>
                </div>
                @endif
                <div id="form_edit">
                    <form action="{{ route('adminHotelEditProcess', ['hotel_id' => $hotel->hotel_id]) }}" method="post" enctype="multipart/form-data" id="hotel_update">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="hotel_name">ホテル名:</label>
                            <input type="text" class="form-control" id="hotel_name" placeholder="ホテル名" name="hotel_name" value="{{old('hotel_name', $hotel->hotel_name)}}">
                            @error('hotel_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="prefecture_id">都道府県:</label>
                            <select class="form-select" name="prefecture_id" id="prefecture_id">
                                @foreach ($prefectures as $prefecture)
                                    <option value="{{$prefecture->prefecture_id}}" @if(old('prefecture_id', $hotel->prefecture_id) == $prefecture->prefecture_id) selected @endif>
                                        {{$prefecture->prefecture_name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('prefecture_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="image">イメージ画像:</label>
                            <br>
                            <div class="position-relative icon-upload" id="icon-upload">
                                <img src="/assets/img/icon/image-upload.png" alt="" srcset="" class="w-100">
                                <input type="file" class="image d-none" id="image" placeholder="ホテル名" name="image" accept=".jpg, .jpeg, .png">
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <img id="image_preview" class="@if(!$hotel->file_path) d-none @endif image_preview" src="/assets/img/{{$hotel->file_path}}" alt="" />
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" id="js_confirm">Confirm</button>
                    </form>
                </div>

                <div id="form_confirm" class="d-none">
                    @include('admin.hotel.confirm')
                </div>
            </div>
        </div>
        <hr>
    </div>
@endsection
@section('page_js')
    @vite('resources/js/admin/hotel-edit.js')
@endsection
