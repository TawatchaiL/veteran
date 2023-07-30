<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\FileUpload;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;


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

        // Check if the file already exists, and delete it if it does
        $filePath = public_path('stamps/' . $filename);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Save the manipulated image as a PNG file with a transparent background
        $image->save($filePath, 100, 'png');
    }

    public static function createTransparentRectangleImageWithText($width, $height, $borderWidth, $borderColor, $filename, $borderMargin, $lineSpacing, $lineMarginLeft, $lineMarginRight)
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

        // Function to add text above a line
        $addTextToLine = function ($image, $x1, $x2, $y, $text) {
            $fontPath = public_path('fonts/YourFont.ttf'); // Replace 'YourFont.ttf' with your desired font file path
            $fontSize = 14; // Adjust the font size as needed
            $image->text($text, ($x1 + $x2) / 2, $y - $fontSize, function ($font) use ($fontPath, $fontSize) {
                $font->file($fontPath);
                $font->size($fontSize);
                $font->color('#000000'); // Set the text color
                $font->align('center');
            });
        };

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
            $addTextToLine($image, $x, $x2, $yTop, 'Top Line');
            $x += 2 * $dotLength; // Adjust the spacing between each dotted segment as needed
        }

        // Center dotted line
        // (similar process for drawing line and adding text as above)

        // Bottom dotted line
        // (similar process for drawing line and adding text as above)

        // Check if the file already exists, and delete it if it does
        $filePath = public_path('stamps/' . $filename);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Save the manipulated image as a PNG file with a transparent background
        $image->save($filePath, 100, 'png');
    }

    public static function addTextAtCenterOfLine($image, $x1, $x2, $y, $text) {
        $fontPath = public_path('fonts/THSarabunNew.ttf'); // Replace with the actual path to your TrueType font file
        $fontSize = 18; // Adjust the font size as needed
        $fontColor = [0, 0, 255]; // RGB color for the font (black in this example)

        // Calculate the width of the text
        $textWidth = imagettfbbox($fontSize, 0, $fontPath, $text);
        $textWidth = $textWidth[2] - $textWidth[0];

        // Calculate the X coordinate to center the text
        $textX = ($x1 + $x2) / 2 - $textWidth / 2;

        // Set the Y coordinate for the text (offset from the line)
        $textY = $y - 10;

        // Load the image as a TrueType font
        imagettftext($image->getCore(), $fontSize, 0, $textX, $textY, imagecolorallocate($image->getCore(), $fontColor[0], $fontColor[1], $fontColor[2]), $fontPath, $text);
    }


    public static function createTransparentRectangleImageWithText2($width, $height, $borderWidth, $borderColor, $filename, $borderMargin, $lineSpacing, $lineMarginLeft, $lineMarginRight)
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


        // Add the text for the top dotted line
        $textForTopLine = 'มานนท์ เหลี่ยมวิเศษ';
        self::addTextAtCenterOfLine($image, $lineX1Top, $lineX2Top, $yTop, $textForTopLine);
        $textForCenterLine = 'Center Line Text';
        $textForBottomLine = 'Bottom Line Text';
        self::addTextAtCenterOfLine($image, $lineX1Center, $lineX2Center, $yCenter, $textForCenterLine);
        self::addTextAtCenterOfLine($image, $lineX1Bottom, $lineX2Bottom, $yBottom, $textForBottomLine);

        // Check if the file already exists, and delete it if it does
        $filePath = public_path('stamps/' . $filename);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Save the manipulated image as a PNG file with a transparent background
        $image->save($filePath, 100, 'png');
    }
}
