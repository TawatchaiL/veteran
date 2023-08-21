<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cases;
use Dompdf\Dompdf;
class PDFcasesController extends Controller
{
    //
    public function pdf()
    {
    $cases = Cases::all();
    $pdf = new Dompdf();
    $pdf->loadHtml(view('reportcase.pdf', ['Cases' => $cases])->render());

    // (Optional) Set paper size and orientation
    $pdf->setPaper('A4', 'portrait');

    // Render the PDF
    $pdf->render();

    // Stream the PDF to the browser
    return $pdf->stream('report.pdf');
    }
}
