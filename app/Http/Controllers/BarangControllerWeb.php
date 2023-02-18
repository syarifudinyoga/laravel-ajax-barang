<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangControllerWeb extends Controller
{
    public function viewData(){
        return view('barang');
    }
}
