<?php

namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;
use App\Models\Inzerat;
use App\Models\Kategoria;

/**
 * Class HomeController
 * Handles actions related to the home page and other public actions.
 *
 * This controller includes actions that are accessible to all users, including a default landing page and a contact
 * page. It provides a mechanism for authorizing actions based on user permissions.
 *
 * @package App\Controllers
 */
class HomeController extends BaseController
{
    /**
     * Authorizes controller actions based on the specified action name.
     *
     * In this implementation, all actions are authorized unconditionally.
     *
     * @param string $action The action name to authorize.
     * @return bool Returns true, allowing all actions.
     */
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    /**
     * Displays the default home page.
     *
     * This action serves the main HTML view of the home page.
     *
     * @return Response The response object containing the rendered HTML for the home page.
     */
    public function index(Request $request): Response
{
    $kategorie = Kategoria::getAll(null, [], 'nazov ASC');

    // filter podľa kategórie (hodnota z GET sa berie len ak je to číslo)
    $kategoriaId = $request->get('kategoria');
    $where = null;
    $params = [];
    if (is_string($kategoriaId) && ctype_digit($kategoriaId)) {
        $where = 'kategoriaId = ?';
        $params = [(int)$kategoriaId];
    } else {
        $kategoriaId = null;
    }

    $inzeraty = Inzerat::getAll($where, $params, 'datum DESC');
    return $this->html(compact('kategorie', 'inzeraty', 'kategoriaId'));
}

    /**
     * Displays the contact page.
     *
     * This action serves the HTML view for the contact page, which is accessible to all users without any
     * authorization.
     *
     * @return Response The response object containing the rendered HTML for the contact page.
     */
    public function contact(Request $request): Response
    {
        return $this->html();
    }
}
