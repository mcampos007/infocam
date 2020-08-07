<?php

namespace App\Exports;
use App\Cart;

use Maatwebsite\Excel\Concerns\FromCollection;

class RemitoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $remitos = Cart::all();
        return $remitos;
    }
}
