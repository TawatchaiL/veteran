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
use Illuminate\Support\Facades\Log;



class FileUploadService
{
    public static function getLogoDataURL()
    {
        $logoPath = public_path('images/logo.png');
        $logoData = file_get_contents($logoPath);
        $dataURL = 'data:image/png;base64,' . base64_encode($logoData);

        return response()->json(['dataURL' => $dataURL]);
    }

    public static function getLogoDataURLBase64()
    {
        $logoPath = public_path('images/logo.png');
        $logoData = file_get_contents($logoPath);
        $dataURL = 'data:image/png;base64,' . base64_encode($logoData);

        return $dataURL;
    }

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

                $fileType = $image->getClientMimeType();

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
            $spath = public_path() . '/stamps/' . $oldfile[0]->filename;
            if (file_exists($spath)) {
                unlink($spath);
            }
            return $filename;
        } else {
            return 'none';
        }
    }
}
