<?php

namespace App\Services;

use App\Models\Hotel;

class HotelService
{
public function test(){
    return 'TEST';
}
public function get(){
    
    return Hotel::all()->sortBy('title');

}

}