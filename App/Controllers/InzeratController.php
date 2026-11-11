<?php

namespace App\Controllers;

use App\Models\Inzerat;
use App\Models\Kategoria;
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
        $kategorie = Kategoria::getAll(null, [], 'nazov ASC');
        return $this->html(compact('inzerat', 'chyba', 'kategorie'), 'formular');
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
        $kategorie = Kategoria::getAll(null, [], 'nazov ASC');
        return $this->html(compact('inzerat', 'chyba', 'kategorie'), 'formular');
    }

    //delete
    public function vymazat(Request $request): Response
    {
        if ($request->isPost()) {
            Inzerat::getOne($request->post('id'))?->delete();
        }
        return $this->redirect($this->url('inzerat.zobrazit'));
    }

    //naplni model z formulara a ulozi ho do DB, vrati chybu ak sa vyskytne
    private function naplnitUlozit(Request $request, Inzerat $inzerat): ?string
    {
        $inzerat->setFromRequest($request);
        $inzerat->cena = str_replace(',', '.', (string)$inzerat->cena);

        if (trim((string)$inzerat->nazov) === '') {
            return 'Názov inzerátu nesmie byť prázdny.';
        }
        if (!is_numeric($inzerat->cena) || $inzerat->cena < 0.01 || $inzerat->cena > 1000000) {
            return 'Cena musí byť v rozmedzí 0,01 € až 1 000 000 €.';
        }

        // prepojenie na kategóriu (1:N), kategória je povinná a vyberá sa zo zoznamu
        $kategoriaId = $request->post('kategoriaId');
        if (!is_string($kategoriaId) || !ctype_digit($kategoriaId) || Kategoria::getOne((int)$kategoriaId) === null) {
            return 'Vyberte platnú kategóriu.';
        }
        $inzerat->kategoriaId = (int)$kategoriaId;

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