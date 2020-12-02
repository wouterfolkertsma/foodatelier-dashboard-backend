<?php


namespace App\Interfaces;

use Illuminate\View\View;

interface Renderable
{
    /**
     * @return View
     */
    public function render();
}