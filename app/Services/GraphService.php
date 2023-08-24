<?php

namespace App\Services;


class GraphService
{
    public $options     = [];
    private $datasets   = [];

    public function __construct()
    {
        $this->datasets = ['name' => 'Graph',];
        $this->options = [
            'name' => 'Graph',
        ];
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
