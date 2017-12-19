<?php
/**
 * Created by PhpStorm.
 * User: trafalgar
 * Date: 19/12/17
 * Time: 18:05
 */

namespace App\Controllers;
use App\Models\Invitacion;
use Illuminate\Database\Eloquent\Model;
use Sirius\Validation\Validator;

class InvitacionesController extends BaseController {

    public function getInvitacion(){

        $invitations = array_fill_keys(["email","used"], "");

        return $this->render('invitaciones.twig',[
            'email' => $invitations,
            'used'  => 0
        ]);
    }

    public function postInvitaciones(){
        $errors = [];
        $validator = new Validator();
        $validator->add('email:Email', 'required', [], 'El {label} es obligatorio');
        $validator->add('email:Email', 'email', [], 'No es un email válido');

        if($validator->validate($_POST)){
            $invitations['email'] = htmlspecialchars(trim($_POST['email']));
            $invitations['used']  = 0;

                $invitations = new Invitacion([
                    'email'        => $invitations['email'],
                    'used'         => $invitations['used']


                ]);
                $invitations->save();

            header('Location: ' . BASE_URL);
        }else{
            $errors = $validator->getMessages();
        }
        return $this->render('invitaciones.twig', ['errors' => $errors]);

    }


}