<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 30/11/2015
 * Time: 12:33 AM
 */

namespace Trogue\Http\Controllers;


use Trogue\User;

class UsuarioController extends Controller{



    public function login(){

        $data = \Input::all();

        if (\Auth::attempt(['dni' => $data['dni'], 'password' => $data['password']]))
        {
            return redirect()->intended('home');
        }

       else{
           return \Redirect::route('home')->with(array('Error' => 'Proveedor Registrado'));
       }


    }

    public function outLogin()
    {
        \Auth::logout();

        return redirect()->intended('home');
    }


    public function registerUser(){

        $user = new User();

        $user->dni ='12345678';
        $user->tipo = 'control';
        $user->password = bcrypt('1234');

        $user->save();

        dd($user);



    }


}