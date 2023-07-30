<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\FileUpload;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;
use setasign\FpdiProtection\FpdiProtection;
use setasign\Fpdi\Tcpdf\Fpdi;



class FileUploadService
{
    public static function fileStore(Request $request)
    {
        $filecount = count($request->file('file'));
        $newname = "";
        for ($i = 0; $i <= ($filecount - 1); $i++) {
            $image = $request->file('file')[$i];

            $imageName = $image->getClientOriginalName();
            $oldfile = FileUpload::where('oldname', $imageName)->get();
            if (!is_array($oldfile)) {

                $newname = Str::random(40) . "_" . $imageName;
                $image->move(public_path('file_upload'), $newname);

                $imageUpload = new FileUpload();
                $imageUpload->filename = $newname;
                $imageUpload->oldname = $imageName;
                $imageUpload->save();
            }
        }
        return $newname;
        //return response()->json(['success' => $newname]);
    }

    public static function fileGetName(Request $request)
    {

        $filename =  $request->get('name');
        $oldfile = FileUpload::where('oldname', $filename)->get();
        if ($oldfile) {
            $path = public_path() . '/file_upload/' . $oldfile[0]->filename;
            if (file_exists($path)) {
                return $oldfile[0]->filename;
            }
        } else {
            return 'none';
        }
    }

    public static function fileDestroy(Request $request)
    {

        $filename =  $request->get('name');
        $oldfile = FileUpload::where('oldname', $filename)->get();
        if ($oldfile) {
            $path = public_path() . '/file_upload/' . $oldfile[0]->filename;
            if (file_exists($path)) {
                unlink($path);
                FileUpload::where('oldname', $filename)->delete();
            }
            return $filename;
        } else {
            return 'none';
        }
    }


    public static function addTextAtCenterOfLine($image, $x1, $x2, $y, $text)
    {
        $fontPath = public_path('fonts/THSarabunNew Bold.ttf'); // Replace with the actual path to your TrueType font file
        $fontSize = 12; // Adjust the font size as needed
        $fontColor = [0, 0, 255]; // RGB color for blue font (0, 0, 255)

        // Calculate the width of the text
        $textWidth = imagettfbbox($fontSize, 0, $fontPath, $text);
        $textWidth = $textWidth[2] - $textWidth[0];

        // Calculate the X coordinate to center the text
        $textX = ($x1 + $x2) / 2 - $textWidth / 2;

        // Set the Y coordinate for the text (offset from the line)
        $textY = $y - 5; // Decrease the offset value to move the text closer to the dotted line

        // Load the image as a TrueType font
        imagettftext($image->getCore(), $fontSize, 0, $textX, $textY, imagecolorallocate($image->getCore(), $fontColor[0], $fontColor[1], $fontColor[2]), $fontPath, $text);
    }


    public static function createTransparentRectangleImageWithText($width, $height, $borderWidth, $borderColor, $filename, $borderMargin, $lineSpacing, $lineMarginLeft, $lineMarginRight, $stampText)
    {
        // Calculate the dimensions for the frame inside the image with the margin
        $frameX1 = $borderWidth + $borderMargin; // X coordinate of top-left corner
        $frameY1 = $borderWidth + $borderMargin; // Y coordinate of top-left corner
        $frameX2 = $width - $borderWidth - $borderMargin; // X coordinate of bottom-right corner
        $frameY2 = $height - $borderWidth - $borderMargin; // Y coordinate of bottom-right corner

        // Create a new canvas with a transparent background
        $image = Image::canvas($width, $height, null);

        // Draw a rectangle with a transparent fill and border
        $image->rectangle($frameX1, $frameY1, $frameX2, $frameY2, function ($draw) use ($borderWidth, $borderColor) {
            //$draw->background('transparent'); // Set the rectangle fill to transparent
            $draw->border($borderWidth, $borderColor); // Set the border width and color
        });



        // Calculate the y-coordinate for the top, center, and bottom lines
        $yTop = $frameY1 + $lineSpacing;
        $yCenter = ($frameY1 + $frameY2) / 2;
        $yBottom = $frameY2 - $lineSpacing;

        // Draw the three dotted lines inside the frame with adjustable thickness
        $lineThickness = 1; // Adjust the line thickness as needed
        $dotLength = 4; // Adjust the length of each dotted segment as needed

        // Top dotted line
        $lineX1Top = $frameX1 + $lineMarginLeft;
        $lineX2Top = $frameX2 - $lineMarginRight;
        $x = $lineX1Top;
        $xPositions = [];
        while ($x < $lineX2Top) {
            $x2 = min($x + $dotLength, $lineX2Top);
            $image->rectangle($x, $yTop, $x2, $yTop + $lineThickness, function ($draw) use ($borderColor) {
                $draw->background($borderColor);
            });
            $xPositions[] = [$x, $x2];
            $x += 2 * $dotLength; // Adjust the spacing between each dotted segment as needed
        }

        // Center dotted line
        $lineX1Center = $frameX1 + $lineMarginLeft;
        $lineX2Center = $frameX2 - $lineMarginRight;
        $x = $lineX1Center;
        while ($x < $lineX2Center) {
            $x2 = min($x + $dotLength, $lineX2Center);
            $image->rectangle($x, $yCenter, $x2, $yCenter + $lineThickness, function ($draw) use ($borderColor) {
                $draw->background($borderColor);
            });
            $x += 2 * $dotLength; // Adjust the spacing between each dotted segment as needed
        }

        // Bottom dotted line
        $lineX1Bottom = $frameX1 + $lineMarginLeft;
        $lineX2Bottom = $frameX2 - $lineMarginRight;
        $x = $lineX1Bottom;
        while ($x < $lineX2Bottom) {
            $x2 = min($x + $dotLength, $lineX2Bottom);
            $image->rectangle($x, $yBottom, $x2, $yBottom + $lineThickness, function ($draw) use ($borderColor) {
                $draw->background($borderColor);
            });
            $x += 2 * $dotLength; // Adjust the spacing between each dotted segment as needed
        }


        $textForTopLine = $stampText;
        self::addTextAtCenterOfLine($image, $lineX1Top, $lineX2Top, $yTop, $textForTopLine);
        $textForCenterLine = $stampText;
        $textForBottomLine = $stampText;
        self::addTextAtCenterOfLine($image, $lineX1Center, $lineX2Center, $yCenter, $textForCenterLine);
        self::addTextAtCenterOfLine($image, $lineX1Bottom, $lineX2Bottom, $yBottom, $textForBottomLine);
        // Check if the file already exists, and delete it if it does
        $filePath = public_path('stamps/' . $filename . '.png'); // Modify the file extension to PNG
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Save the manipulated image as a PNG file with a transparent background
        $image->save($filePath, 100, 'png');

        return $filePath; // Return the path to the saved image
    }

    private static function addStampToPDF($filePath, $imagePath, $x, $y)
    {
        // Load the contents of the PDF file
        $pdfContent = file_get_contents($filePath);

        // Convert the image to an Intervention Image object
        $imageData = file_get_contents($imagePath);
        $interventionImage = Image::make($imageData);

        // Encode the Intervention Image as base64 data
        $dataUrl = $interventionImage->encode('data-url')->encoded;

        // Generate the HTML for the image stamp with absolute positioning
        $html = '<div style="position: absolute; top: ' . $y . 'px; left: ' . $x . 'px;"><img src="' . $dataUrl . '" /></div>';

        // Include the dompdf library
        require_once base_path('vendor/dompdf/dompdf/autoload.inc.php');

        // Create a new Dompdf instance
        $dompdf = new \Dompdf\Dompdf();

        // Load the PDF content with the image stamp HTML
        $dompdf->loadHtml($pdfContent . $html);

        // (Optional) Set additional configuration options for dompdf if needed
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        // Get the PDF content
        $pdfWithStamp = $dompdf->output();

        return $pdfWithStamp;
    }


    public static function stampPDFWithImage($filePath, $stampText, $x, $y)
    {
        // Check if the file exists
        if (!file_exists($filePath)) {
            return false; // Return false or handle the error if the file doesn't exist
        }

        // Create an instance of FPDI with TCPDF and FPDI Protection
        //$pdf = new FpdiProtection();
        $pdf = new Fpdi();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        // Set the protection key if the PDF is password-protected (optional)
        // $pdf->setProtectionKey('your_password_here');

        // Add a page to the PDF
        //$pdf->AddPage();

        // Set the source file (the PDF to be stamped)
        $pagecount = $pdf->setSourceFile($filePath);

        // Import the first page from the source PDF
        //$importedPage = $pdf->importPage(1);

        // Use the imported page as a template
        //$pdf->useTemplate($importedPage, 0, 0);

        // Add the image stamp to the PDF
        $stampImagePath = self::createTransparentRectangleImageWithText(
            200,
            100,
            1,
            [0, 0, 255],
            'stamp_image',
            10,
            18,
            20,
            20,
            $stampText
        );

        //$stampImage = file_get_contents($stampImagePath);
        //$pdf->Image('@' . $stampImage, $x, $y, 0, 0, '', '', '', false, 300);



        // Add watermark to PDF pages
        for ($i = 1; $i <= $pagecount; $i++) {
            $tpl = $pdf->importPage($i);
            $size = $pdf->getTemplateSize($tpl);
            $pdf->addPage();
            $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);

            if ($i === 1) {
                //Put the watermark
                $stampImage = file_get_contents($stampImagePath);
                $pdf->Image('@' . $stampImage, $x, $y, 0, 0, '', '', '', false, 300);
            }
        }

        @unlink($stampImagePath);
        // Optionally, you can save the stamped PDF to a file
        //$stampedFileName = 'stamped_' . basename($filePath);
        //$stampedFilePath = public_path().'/stamps/' . $stampedFileName;
        //$pdf->Output($stampedFilePath, 'F');

        // Output the stamped PDF as a response
        $pdf->Output();
    }
}
