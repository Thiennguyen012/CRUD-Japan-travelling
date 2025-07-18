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
        <h2 class="title">検索画面</h2>
        <hr>
        <div class="search-hotel-name">
            @if (session('success'))
            <div class="alert-wrapper">
                <div class="alert-success">{{ session('success') }}</div>
            </div>
            @endif
            @if (session('error'))
            <div class="alert-wrapper">
                <div class="alert-error">{{ session('error') }}</div>
            </div>
            @endif

            <form action="{{ route('adminHotelSearchResult') }}" method="POST" class="row row-cols-lg-auto g-3 align-items-center">
                @csrf
                <div class="col-12">
                    <div class="mb-3">
                        <label for="hotel_name" class="form-label">ホテル名</label>
                        <input type="text" class="form-control" id="hotel_name" name="hotel_name" value="{{old('hotel_name', $var['hotel_name'])}}" placeholder="ホテル名">
                        @error('hotel_name')
                        <span class="text-danger position-absolute">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="mb-3">
                        <label for="customer_contact" class="form-label">都道府県</label>
                        <select name="prefecture_id" id="prefecture_id" class="form-select">
                            <option value="">-- 選択してください --</option>
                            @foreach ($prefectures as $prefecture)
                                <option value="{{$prefecture->prefecture_id}}" @if(old('prefecture_id', $var['prefecture_id']) == $prefecture->prefecture_id) selected @endif>{{$prefecture->prefecture_name}}</option>
                            @endforeach
                        </select>
                        @error('prefecture_id')
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
