<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\FileUpload;
use Intervention\Image\Facades\Image;


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

    public static function createTransparentRectangleImage($width, $height, $borderWidth, $borderColor, $filename, $borderMargin)
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

        // Save the manipulated image as a PNG file with a transparent background
        $image->save(public_path('stamps/' . $filename), 100, 'png');
    }

    public static function createTransparentRectangleImage2($width, $height, $borderWidth, $borderColor, $filename, $borderMargin, $dotSpacing)
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

    // Calculate the number of dotted lines based on dotSpacing
    $numDots = floor(($frameX2 - $frameX1) / $dotSpacing);

    // Calculate the y-coordinate for the center of the image
    $yCenter = $height / 2;

    // Draw the dotted lines inside the frame
    for ($i = 0; $i < $numDots; $i++) {
        $x1 = $frameX1 + $i * $dotSpacing;
        $x2 = $x1 + $dotSpacing / 2; // Adjust the dotted line length as needed
        $image->line($x1, $yCenter, $x2, $yCenter, function ($draw) use ($borderColor) {
            $draw->color($borderColor);
        });
    }

    // Save the manipulated image as a PNG file with a transparent background
    $image->save(public_path('stamps/' . $filename), 100, 'png');
}

public static function createTransparentRectangleImage3($width, $height, $borderWidth, $borderColor, $filename, $borderMargin, $lineSpacing)
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

    // Draw the three lines inside the frame
    $lineX1 = $frameX1; // X coordinate of left end of the lines (same as the frame's left side)
    $lineX2 = $frameX2; // X coordinate of right end of the lines (same as the frame's right side)
    $lineThickness = 2; // Adjust the line thickness as needed

    $image->rectangle($lineX1, $yTop - $lineThickness / 2, $lineX2, $yTop + $lineThickness / 2, function ($draw) use ($borderColor) {
        $draw->background($borderColor); // Set the rectangle fill to the line color
    });

    $image->rectangle($lineX1, $yCenter - $lineThickness / 2, $lineX2, $yCenter + $lineThickness / 2, function ($draw) use ($borderColor) {
        $draw->background($borderColor); // Set the rectangle fill to the line color
    });

    $image->rectangle($lineX1, $yBottom - $lineThickness / 2, $lineX2, $yBottom + $lineThickness / 2, function ($draw) use ($borderColor) {
        $draw->background($borderColor); // Set the rectangle fill to the line color
    });

    // Save the manipulated image as a PNG file with a transparent background
    $image->save(public_path('stamps/' . $filename), 100, 'png');
}

public static function createTransparentRectangleImage4($width, $height, $borderWidth, $borderColor, $filename, $borderMargin, $lineSpacing, $lineMarginLeft, $lineMarginRight)
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

    // Draw the three dotted lines inside the frame with adjustable margins
    $lineThickness = 2; // Adjust the line thickness as needed

    // Top dotted line
    $lineX1Top = $frameX1 + $lineMarginLeft;
    $lineX2Top = $frameX2 - $lineMarginRight;
    $image->rectangle($lineX1Top, $yTop - $lineThickness / 2, $lineX2Top, $yTop + $lineThickness / 2, function ($draw) use ($borderColor) {
        $draw->background($borderColor); // Set the rectangle fill to the line color
    });

    // Center dotted line
    $lineX1Center = $frameX1 + $lineMarginLeft;
    $lineX2Center = $frameX2 - $lineMarginRight;
    $image->rectangle($lineX1Center, $yCenter - $lineThickness / 2, $lineX2Center, $yCenter + $lineThickness / 2, function ($draw) use ($borderColor) {
        $draw->background($borderColor); // Set the rectangle fill to the line color
    });

    // Bottom dotted line
    $lineX1Bottom = $frameX1 + $lineMarginLeft;
    $lineX2Bottom = $frameX2 - $lineMarginRight;
    $image->rectangle($lineX1Bottom, $yBottom - $lineThickness / 2, $lineX2Bottom, $yBottom + $lineThickness / 2, function ($draw) use ($borderColor) {
        $draw->background($borderColor); // Set the rectangle fill to the line color
    });

    // Save the manipulated image as a PNG file with a transparent background
    $image->save(public_path('stamps/' . $filename), 100, 'png');
}

public static function createTransparentRectangleImage5($width, $height, $borderWidth, $borderColor, $filename, $borderMargin, $lineSpacing, $lineMarginLeft, $lineMarginRight)
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
    $lineThickness = 2; // Adjust the line thickness as needed
    $dotLength = 4; // Adjust the length of each dotted segment as needed

    // Top dotted line
    $lineX1Top = $frameX1 + $lineMarginLeft;
    $lineX2Top = $frameX2 - $lineMarginRight;
    $x = $lineX1Top;
    while ($x < $lineX2Top) {
        $x2 = min($x + $dotLength, $lineX2Top);
        $image->rectangle($x, $yTop, $x2, $yTop + $lineThickness, function ($draw) use ($borderColor) {
            $draw->background($borderColor);
        });
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

    // Save the manipulated image as a PNG file with a transparent background
    $image->save(public_path('stamps/' . $filename), 100, 'png');
}
}
