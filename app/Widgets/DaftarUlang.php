<?php

namespace App\Widgets;

use App\Models\Scan;
use Arrilot\Widgets\AbstractWidget;

class DaftarUlang extends AbstractWidget
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
        $daftar = Scan::where('scan',1)->count();
        return view('widgets.daftar_ulang', [
            'config' => $this->config,
            'daftar' => $daftar
        ]);
    }
}
