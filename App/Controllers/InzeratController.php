<?php

namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Akcie súvisiace s inzerátmi.
 */
class InzeratController extends BaseController
{
    /**
     * Zobrazí detail inzerátu (pohľad App/Views/Inzerat/index.view.php).
     */
    public function index(Request $request): Response
    {
        return $this->html();
    }

    /**
     * Zobrazí zoznam inzerátov prihláseného používateľa (pohľad App/Views/Inzerat/moje.view.php).
     */
    public function moje(Request $request): Response
    {
        return $this->html();
    }
}