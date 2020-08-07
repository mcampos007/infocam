<?php

namespace App\Http\Controllers\Admin;
use App\Exports\RemitoExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cart;

class CartController extends Controller
{
    //
    public function vercart($id)
    {
        $remito = Cart::find($id);
        return view('admin.remitos.index')->with(compact('remito'));
        
    }

    public function excel()
    {
        return Excel::download(new RemitoExport, 'remito.xlsx');
    }
}
