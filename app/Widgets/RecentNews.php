<?php

namespace App\Widgets;

use App\Models\Data;
use App\Models\Pendaftar;
use Arrilot\Widgets\AbstractWidget;

class RecentNews extends AbstractWidget
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
        $pendaftars = Data::count();
        return view('widgets.recent_news', [
            'config' => $this->config,
            'pendaftars' => $pendaftars
        ]);
    }
}
