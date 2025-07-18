<!-- base view -->
@extends('common.admin.base')

<!-- CSS per page -->
@section('custom_css')
    @vite('resources/scss/admin/search.scss')
    @vite('resources/scss/admin/result.scss')
@endsection

<!-- main containts -->
@section('main_contents')
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">予約情報検索</h2>
        <hr>
        <div class="search-hotel-name">
            @if (session('success'))
            <div class="alert-wrapper">
                <div class="alert-success">{{ session('success') }}</div>
            </div>
            @endif
            <form action="{{ route('adminBookingSearchResult') }}" method="POST" class="row row-cols-lg-auto g-3 align-items-center">
                @csrf
                <div class="col-12">
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">顧客名</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{$vars['customer_name']}}">
                        @error('customer_name')
                        <span class="text-danger position-absolute">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="mb-3">
                        <label for="customer_contact" class="form-label">顧客連絡先</label>
                        <input type="text" class="form-control" id="customer_contact" name="customer_contact" value="{{$vars['customer_contact']}}">
                        @error('customer_contact')
                        <span class="text-danger position-absolute">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="mb-3">
                        <label for="checkin_time" class="form-label">チェックイン日時</label>
                        <input type="datetime-local" class="form-control" id="checkin_time" name="checkin_time" value="{{$vars['checkin_time']}}">
                        @error('checkin_time')
                        <span class="text-danger position-absolute">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="mb-3">
                        <label for="checkout_time" class="form-label">チェックアウト日時</label>
                        <input type="datetime-local" class="form-control" id="checkout_time" name="checkout_time" value="{{$vars['checkout_time']}}">
                        @error('checkout_time')
                        <span class="text-danger position-absolute">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                  <div class="col-12">
                    <div class="mb-3">
                        <label for="" class="form-label">　</label>
                        <button type="submit" class="btn btn-primary form-control">検索</button>
                    </div>
                  </div>
            </form>
        </div>
        <hr>
    </div>
    @yield('search_results')
@endsection