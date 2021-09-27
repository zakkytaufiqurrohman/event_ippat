<?php

namespace App\Widgets;

use App\Models\Scan;
use Arrilot\Widgets\AbstractWidget;

class SuratSuara extends AbstractWidget
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
        $surat = Scan::where('scan',2)->count();
        return view('widgets.surat_suara', [
            'config' => $this->config,
            'surat' => $surat
        ]);
    }
}
