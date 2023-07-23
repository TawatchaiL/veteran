<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRunningNumber extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'year',
    ];

    public static function pre_generate()
    {
        
        $number = 0;
        $year = date('Y');
        

        if (!BookRunningNumber::where('year', $year)->exists()) {
            BookRunningNumber::create([
                'number' => $number,
                'year' => $year,
            ]);
        }

        $running_number = BookRunningNumber::where('year', $year)->first();
  
        $running_number->number++;
        //$running_number->save();
        $number = $running_number->number;
        $number = str_pad($number, 6, '0', STR_PAD_LEFT);


        return  $number."/".date('Y')+543;


    }
    
    public static function generate()
    {
        
        $number = 0;
        $year = date('Y');
        

        if (!BookRunningNumber::where('year', $year)->exists()) {
            BookRunningNumber::create([
                'number' => $number,
                'year' => $year,
            ]);
        }

        $running_number = BookRunningNumber::where('year', $year)->first();
  
        $running_number->number++;
        $running_number->save();
        $number = $running_number->number;
        $number = str_pad($number, 6, '0', STR_PAD_LEFT);


        //return BookRunningNumber::date('y') . '' . $number;
        return  $number."/".date('Y')+543;


    }
}
