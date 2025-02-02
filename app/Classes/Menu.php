<?php

namespace App\Classes;

use App\Enums\SliderTypeEnum;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Menu
{
    public function getMenu(): array
    {
        $current_route_name = Route::currentRouteName();
        $response[] = ['label' => __('message.home'), 'icon' => 'pi-home',
            'href' => \route('dashboard.home'),
            'active' => $current_route_name == 'home'
        ];


        return $response;
    }



}
