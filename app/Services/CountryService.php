<?php

namespace App\Services;

use App\Models\Country;

class CountryService
{
// public function test(){
//     return 'TEST';
// }
public function getService()
{
    return Country::all()->sortBy('title');
 
}

}