<?php

namespace App\Widgets;

use App\Models\Scan;
use Arrilot\Widgets\AbstractWidget;

class KotakSuara extends AbstractWidget
{
    public $reloadTimeout = 5;

    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $kotak = Scan::where('scan',3)->count();
        return view('widgets.kotak_suara', [
            'config' => $this->config,
            'kotak' => $kotak
        ]);
    }
}
