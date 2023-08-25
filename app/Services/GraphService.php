<?php

namespace App\Services;

use Illuminate\Support\Str;

class GraphService
{
    public $options     = [];
    private $datasets   = [];

    public function __construct()
    {
        foreach (func_get_args() as $arg) {
            $this->options = $arg;
            $this->options['chart_name'] = strtolower(Str::slug($arg['chart_title'], '_'));
            $this->datasets[] = ['data' => $this->options['data']];
        }
        //dd($this->datasets);
    }

    public static function render()
    {
        $options = [
            'name' => 'Graph',
        ];
        return $options;
        //return response()->json(['success' => $newname]);
    }


    public function renderHtml()
    {
        return view('graph::html', ['options' => $this->options]);
    }


    public function renderJs()
    {
        return view('graph::javascript', ['options' => $this->options, 'datasets' => $this->datasets]);
    }
}
