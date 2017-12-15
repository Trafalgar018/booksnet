<?php
namespace App\Controllers;

use App\Controllers\Auth\AuthController;
use App\Controllers\Auth\RegisterController;
use App\Models\Book;
use App\Models\User;

class HomeController extends BaseController {

    /**
     * Ruta / donde se muestra la página de inicio del proyecto.
     *
     * @return string Render de la página
     */
    public function getIndex(){

        $books = new BooksController();

        return $books->getIndex();
    }

    public function getContacto(){
        return 'Contac Information';
    }

    public function getLogin(){
        $auth = new AuthController();

        return $auth->getLogin();
    }

    public function postLogin(){
        $auth = new AuthController();

        return $auth->postLogin();
    }

    public function getRegistro(){
        $register = new RegisterController();

        return $register->getRegister();
    }

    public function postRegistro(){
        $register = new RegisterController();

        return $register->postRegister();
    }

    public function getLogout(){
        $auth = new AuthController();

        return $auth->getLogout();
    }

    public function get404($route){
        $webInfo = [
            'title' => $route
        ];
        return $this->render("404.twig",[$webInfo]);
    }
}












