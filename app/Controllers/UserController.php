<?php
namespace App\Controllers;

use app\Models\User;

class UserController extends BaseController {

    /**
     * @return string
     */
    public function getIndex(){
        return 'User Index';
    }
}