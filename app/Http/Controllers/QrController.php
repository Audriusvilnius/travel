<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;

class QrController extends Controller
{
    public function generateQrCode($data)
{
    $renderer = new Png();
    $writer = new Writer($renderer);
    $qrCode = $writer->writeString($data);

    return response($qrCode)->header('Content-Type', 'image/png');
}
}