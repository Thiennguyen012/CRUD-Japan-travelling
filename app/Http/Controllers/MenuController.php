<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $restaurant;
    private $menu;
    public function __construct(Restaurant $restaurant, Menu $menu)
    {
        $this->restaurant = $restaurant;
        $this->menu = $menu;
    }

    public function getMenuByResID($restaurant_id): View
    {
        $restaurant = $this->restaurant->where('restaurant_id', $restaurant_id)->first();
        // $restaurant_name = $restaurant->restaurant_name;
        $menu = $this->menu->where('restaurant_id', $restaurant->restaurant_id)->get();
        return view('user.menu.listMenu', compact('menu', 'restaurant'));
    }
}
