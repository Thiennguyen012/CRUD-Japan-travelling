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
            @if (session('success'))
            <div class="alert-wrapper">
                <div class="alert-success">{{ session('success') }}</div>
            </div>
            @endif
            <div>ホテル名: {{$hotel->hotel_name}}</div><br>
            <div>都道府県: {{$hotel->prefecture->prefecture_name}}</div><br>
            <div>イメージ画像: @if(!$hotel->file_path) なし @endif</div><br>
            @if ($hotel->file_path)
                <img class="image_preview" src="/assets/img/{{$hotel->file_path}}" alt="" srcset="">
            @endif
        </div>
        <hr>
    </div>
@endsection
