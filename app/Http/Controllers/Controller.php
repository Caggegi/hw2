<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

use App\Models\Spectator;
use App\Models\Creator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(){
      $usr_id = session('user_id');
      $user=Spectator::find($usr_id);
      if(isset($user)){
        return view('hw2')->with('profile_pic', $user->profile_pic)
                          ->with('nome', $user->name)
                          ->with('cognome', $user->surname)
                          ->with('email', $user->email);
      } else{
        return view('hw2')->with('profile_pic', 'https://raw.githubusercontent.com/Caggegi/mhw3/main/img/icons/account-circle-outline.svg')
                          ->with('nome', 'Welcome')
                          ->with('cognome', 'Stranger')
                          ->with('email', 'Register or log in now!');
      }
    }

    public function display_login(){
      if(session('id') != null)
        Session::flush();
      return view('signup');
    }
}
