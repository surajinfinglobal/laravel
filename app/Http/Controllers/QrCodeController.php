<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function index(){
         $qrCode = QrCode::size(200)->generate('http://127.0.0');
          return view('qrcode', compact('qrCode'));
    }
}
