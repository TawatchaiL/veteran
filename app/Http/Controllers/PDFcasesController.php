<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cases;
use PDF;
class PDFcasesController extends Controller
{
    //
    public function pdf()
    {
        $Cases = Cases::all();
        $pdf = PDF::loadView('reportcase.pdf',['Cases' => $Cases]);
        return @$pdf->stream();
    }
}
