<?php

namespace App\Controllers;

use App\Models\Inzerat;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class InzeratController extends BaseController
{
    public function index(Request $request): Response
    {
        return $this->html();
    }

    //read
    public function zobrazit(Request $request): Response
    {
        $inzeraty = Inzerat::getAll(null, [], 'datum DESC');
        return $this->html(compact('inzeraty'));
    }

    //create
    public function pridat(Request $request): Response
    {
        $inzerat = new Inzerat();
        $chyba = null;

        if ($request->isPost()) {
            $chyba = $this->naplnitUlozit($request, $inzerat);
            if ($chyba === null) {
                return $this->redirect($this->url('inzerat.zobrazit'));
            }
        }
        return $this->html(compact('inzerat', 'chyba'), 'formular');
    }

    //update
    public function upravit(Request $request): Response
    {
        $inzerat = Inzerat::getOne($request->get('id'));
        if ($inzerat === null) {
            throw new HttpException(404, 'Inzerát nebol nájdený');
        }
        $chyba = null;
        if ($request->isPost()) {
            $chyba = $this->naplnitUlozit($request, $inzerat);
            if ($chyba === null) {
                return $this->redirect($this->url('inzerat.zobrazit'));
            }
        }
        return $this->html(compact('inzerat', 'chyba'), 'formular');
    }

    //delete
    public function vymazat(Request $request): Response
    {
        if ($request->isPost()) {
            $inzerat = Inzerat::getOne($request->post('id'))?->delete();
        }
        return $this->redirect($this->url('inzerat.zobrazit'));
    }

    //naplni model z formulara a ulozi ho do DB, vrati chybu ak sa vyskytne
    private function naplnitUlozit(Request $request, Inzerat $inzerat): ?string
    {
        $inzerat->setFromRequest($request);
        $inzerat->cena = str_replace(',', '.', $inzerat->cena);

        if (trim((string)$inzerat->nazov) === '' || !is_numeric($inzerat->cena) || $inzerat->cena < 0) {
            return 'Neplatné údaje. Názov nesmie byť prázdny a cena musí byť kladné číslo.';
        }
        if (!in_array($inzerat->stav, ['aktivny', 'ukonceny'], true)) {
            $inzerat->stav = 'aktivny';
        }
        if ($inzerat->id === null) {
            $inzerat->datum = date('Y-m-d H:i:s');
            $inzerat->stav = 'aktivny';
        }
        $inzerat->save();
        return null;
    }


}