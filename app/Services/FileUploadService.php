<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\FileUpload;

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
}
