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
            $this->options['chart_id'] = $arg['chart_id'];
            $this->options['chart_title'] = $arg['chart_title'];
            $this->options['chart_name'] = strtolower(Str::slug($arg['chart_title'], '_'));
            $this->options['color'] = $this->options['color'];
            $this->datasets[] = ['data' => $this->options['data']];
        }
        //dd($this->datasets);
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
