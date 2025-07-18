<!-- base view -->
@extends('common.user.base')

<!-- CSS per page -->
@section('custom_css')
    @vite('resources/scss/user/hotellist.scss')
@endsection

{{-- Main section --}}
@section('main_contents')
    <header class="g-header">
        <a href="{{ route('top') }}">THK VN HANOI TRAVEL</a>
    </header>
    
    <div class="container">
        <!-- Restaurant Header -->
        <div class="restaurant-header" style="display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    font-weight: bold;
    font-size: large;">
            <h1 class="restaurant-title">{{ $restaurant->restaurant_name }}</h1>
            <p class="restaurant-desc">{{ $restaurant->description }}</p>
            
        </div>

        <!-- Menu List -->
        <div class="hotellist_container">
            <h1>Menu Items</h1>
            
            @if($menu->count() > 0)
                @foreach($menu as $item)
                    <div class="hotellist_wrapper menu-item">
                        <div class="left_wrapper">
                            <img style="height:70%; width:auto" 
                                 src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&h=300&fit=crop" 
                                 alt="{{ $item->dish_name }}"
                                 class="menu-image">
                        </div>
                        <div class="right_wrapper">
                            <div class="menu-content">
                                <h3 class="hotel_title menu-name">{{ $item->dish_name }}</h3>
                                <p class="hotel_information menu-description">
                                    {{ $item->description }}
                                </p>
                                <div class="menu-price-section">
                                    <span class="menu-price">${{ number_format($item->price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-menu-message">
                    <h3>No menu items available</h3>
                    <p>This restaurant hasn't added their menu yet.</p>
                </div>
            @endif
            <div class="back-navigation">
            <a href="{{ route('restaurantList', ['prefecture_name_alpha' => 'tokyo']) }}" 
               style="font-weight:bold; font-size: large;">
                Back to Restaurant List
            </a>
        </div>
        </div>

        <!-- Back Button -->
        
    </div>

    <!-- Custom CSS for Menu List -->
    {{-- <style>
        .restaurant-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .restaurant-title {
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .restaurant-desc {
            font-size: 1.1em;
            margin-bottom: 20px;
            opacity: 0.9;
            line-height: 1.6;
        }

        .restaurant-info {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .info-item {
            background: rgba(255,255,255,0.2);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9em;
        }

        .menu-section-title {
            font-size: 2em;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
        }

        .hotellist_container {
            margin-bottom: 30px;
        }

        .menu-item {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .menu-image {
            border-radius: 8px;
            object-fit: cover;
        }

        .menu-content {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .menu-name {
            font-size: 1.4em;
            color: #2c3e50;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .menu-description {
            color: #7f8c8d;
            line-height: 1.5;
            margin-bottom: 15px;
            flex-grow: 1;
        }

        .menu-price-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .menu-price {
            font-size: 1.5em;
            font-weight: bold;
            color: #e74c3c;
        }

        .menu-badge {
            background: #27ae60;
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8em;
            font-weight: bold;
        }

        .no-menu-message {
            text-align: center;
            padding: 60px 20px;
            background: #f8f9fa;
            border-radius: 15px;
            color: #7f8c8d;
        }

        .no-menu-message h3 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .back-navigation {
            text-align: center;
            margin-top: 30px;
        }

        .back-button {
            display: inline-block;
            padding: 12px 25px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .back-button:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .restaurant-info {
                flex-direction: column;
                align-items: center;
            }

            .info-item {
                margin-bottom: 5px;
            }

            .menu-price-section {
                flex-direction: column;
                gap: 10px;
            }

            .restaurant-title {
                font-size: 2em;
            }
        }
    </style> --}}
@endsection