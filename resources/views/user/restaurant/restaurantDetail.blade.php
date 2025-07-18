<!-- base view -->
@extends('common.user.base')

<!-- CSS per page -->
@section('custom_css')
    @vite('resources/scss/user/hotedetail.scss')
@endsection

<!-- main contents -->
@section('main_contents')
    <header class="g-header">
        <a href="{{ route('top') }}">THK VN HANOI TRAVEL</a>
    </header>
    <div class="container">
        <div class="hotedetail_container">
            <img src="https://www.vietnamairlines.com/~/media/SEO-images/2025%20SEO/Traffic%20TA/MB/japanese-restaurants-hanoi/new-sake-is-one-of-the-oldest-and-most-reputable-japanese-restaurants-in-hanoi-with-a-cozy-design.jpg?la=en" alt="">
            <p class="hotel_title">{{ $restaurant_detail->restaurant_name }}</p>
            <p class="hotel_information">
                {{ $restaurant_detail->description }}
            </p>
            <a style="font-weight:bold; font-size:large;" href="{{ route('getMenu', $restaurant_detail->restaurant_id) }}">View the Restaurant's menu</a>
        </div>
    </div>
    
@endsection