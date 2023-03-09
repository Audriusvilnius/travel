<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

        const SORT = [
            'asc_country'=> 'Country A-.',
            'desc_country'=>'Country Z-A',
            'asc_city'=>'City A-Z',
            'desc_city'=>'City Z-A',
            'asc_price'=>'Price 1-9',
            'dessc_price'=>'Price 9-1',
    ];

        const PER_PAGE = [
        'All',6, 12, 24, 48,
    ];
    
    public function countryHotel_name()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id','id');
    }
    

    public function deletePhoto()
    {
        $fileName = $this->photo;

        if(file_exists(public_path().$fileName) && $fileName!='/images/temp/noimage.jpg'){
            unlink(public_path().$fileName);
            $this->photo='/images/temp/noimage.jpg';
        }
        $this->save();
    }

    
}