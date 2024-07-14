<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use chillerlan\QRCode\QRCode;

class QRCodeController extends Controller
{
    public function preview(Request $request)
    {
        $data = 'https://example.com';

        $qr = (new QRCode)->render($data);


        print_r($qr);
    }
}
