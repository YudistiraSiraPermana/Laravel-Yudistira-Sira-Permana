<?php

namespace App\Exports;

use App\Models\Modelmhs;
use Maatwebsite\Excel\Concerns\FromCollection;

class MahasiswaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Modelmhs::all();
    }
}
