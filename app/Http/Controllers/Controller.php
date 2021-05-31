<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Spectator;
use App\Models\Creator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(){
      $user=Spectator::find(1);
      if(isset($user)){
        return view('hw2')->with('profile_pic', $user->profile_pic)
                          ->with('nome', $user->name)
                          ->with('cognome', $user->surname)
                          ->with('email', $user->email);
      } else{
        return view('hw2')->with('profile_pic', '')
                          ->with('nome', 'ciao')
                          ->with('cognome', 'ciaos')
                          ->with('email', 'skdjna@gmial.com');
      }
    }

}
