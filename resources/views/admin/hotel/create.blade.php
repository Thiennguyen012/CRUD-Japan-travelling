<!-- base view -->
@extends('common.admin.base')

<!-- CSS per page -->
@section('custom_css')
    @vite('resources/scss/admin/home.scss')
    @vite('resources/scss/admin/hotel.scss')
@endsection

<!-- main contents -->
@section('main_contents')
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">ホテル追加</h2>
        <hr>
        <div class="search-hotel-name">
            <div class="content-area">
                <form action="{{ route('adminHotelCreateProcess') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="hotel_name">ホテル名:</label>
                        <input type="text" class="form-control" id="hotel_name" placeholder="ホテル名" name="hotel_name">
                        @error('hotel_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="prefecture_id">都道府県:</label>
                        <select class="form-select" name="prefecture_id" id="prefecture_id">
                            @foreach ($prefectures as $prefecture)
                                <option value="{{$prefecture->prefecture_id}}">{{$prefecture->prefecture_name}}</option>
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
                            <img id="image_preview" class="d-none image_preview" src="" alt="" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">検索</button>
                </form>
            </div>
        </div>
        <hr>
    </div>
    @yield('search_results')
@endsection
@section('page_js')
    @vite('resources/js/admin/hotel-edit.js')
@endsection

