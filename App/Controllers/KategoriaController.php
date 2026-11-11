<?php

namespace App\Controllers;

use App\Models\Kategoria;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class KategoriaController extends BaseController
{
    //read - zoznam kategórií
    public function index(Request $request): Response
    {
        $kategorie = Kategoria::getAll(null, [], 'nazov ASC');
        return $this->html(compact('kategorie'));
    }

    //create
    public function pridat(Request $request): Response
    {
        $kategoria = new Kategoria();
        $chyba = null;

        if ($request->isPost()) {
            $chyba = $this->naplnitUlozit($request, $kategoria);
            if ($chyba === null) {
                return $this->redirect($this->url('kategoria.index'));
            }
        }
        return $this->html(compact('kategoria', 'chyba'), 'formular');
    }

    //update
    public function upravit(Request $request): Response
    {
        $kategoria = Kategoria::getOne($request->get('id'));
        if ($kategoria === null) {
            throw new HttpException(404, 'Kategória nebola nájdená');
        }
        $chyba = null;

        if ($request->isPost()) {
            $chyba = $this->naplnitUlozit($request, $kategoria);
            if ($chyba === null) {
                return $this->redirect($this->url('kategoria.index'));
            }
        }
        return $this->html(compact('kategoria', 'chyba'), 'formular');
    }

    //delete (inzeráty ostanú, FK je ON DELETE SET NULL)
    public function vymazat(Request $request): Response
    {
        if ($request->isPost()) {
            Kategoria::getOne($request->post('id'))?->delete();
        }
        return $this->redirect($this->url('kategoria.index'));
    }

    //naplní model z formulára a uloží ho, vráti chybovú hlášku ak je vstup neplatný
    private function naplnitUlozit(Request $request, Kategoria $kategoria): ?string
    {
        $kategoria->setFromRequest($request);
        $kategoria->nazov = trim((string)$kategoria->nazov);

        if ($kategoria->nazov === '' || mb_strlen($kategoria->nazov) > 50) {
            return 'Názov kategórie je povinný (max. 50 znakov).';
        }
        $kategoria->save();
        return null;
    }
}