<!-- base view -->
@extends('common.user.base')

<!-- CSS per page -->
@section('custom_css')
    @vite('resources/scss/user/hotellist.scss')
@endsection

<!-- main contents -->
@section('main_contents')
    <header class="g-header">
        <a href="{{ route('top') }}">THK VN HANOI TRAVEL</a>
    </header>
    <div class="container">
        <div class="hotellist_container">
            @foreach ($restaurant as $item)
                <a href="{{ route('restaurantDetail', ['restaurant_id' => $item->restaurant_id]) }}" class="hotel_link">
                    <div class="hotellist_wrapper">
                        <div class="left_wrapper">
                            <img style="height:70%; width:auto" src="https://www.vietnamairlines.com/~/media/SEO-images/2025%20SEO/Traffic%20TA/MB/japanese-restaurants-hanoi/new-sake-is-one-of-the-oldest-and-most-reputable-japanese-restaurants-in-hanoi-with-a-cozy-design.jpg?la=en" alt="">
                        </div>
                        <div class="right_wrapper">
                            <p class="hotel_title">{{ $item->restaurant_name }}</p>
                            <p class="hotel_information">
                                {{ $item->description }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection