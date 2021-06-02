<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

use App\Models\Spectator;
use App\Models\Creator;
use App\Models\Premium;

class LoginController extends BaseController
{
  public function login(){
    $mode = request('mode');
    if($mode == 1){
      //signup
      if(request('type') == "creator")
        $rows = Creator::where('username', request('username'))->first();
      else
        $rows = Spectator::where('username', request('username'))->first();
      if(isset($rows))
        return view('signup')->with('_token', csrf_token())
                             ->with('errore','already_registered');
      else{
        if(request('type') == "creator"){
            $creator = new Creator;
            $creator->name = request('name');
            $creator->surname = request('surname');
            $creator->username = request('username');
            $creator->email = request('email');
            $creator->password = hash('sha256', request('password'));
            $creator->n_followers = 0;
            $creator->profile_pic = 'https://raw.githubusercontent.com/Caggegi/mhw3/main/img/icons/account-circle-outline.svg';
            $creator->save();
            $row = Creator::where('username', request('username'))
                         ->where('password', hash('sha256', request('password')))
                         ->first();
        } else{
            $spectator = new Spectator;
            $spectator->name = request('name');
            $spectator->surname = request('surname');
            $spectator->username = request('username');
            $spectator->email = request('email');
            $spectator->password = hash('sha256', request('password'));
            $spectator->profile_pic = 'https://raw.githubusercontent.com/Caggegi/mhw3/main/img/icons/account-circle-outline.svg';
            $spectator->save();
            $row = Spectator::where('username', request('username'))
                         ->where('password', hash('sha256', request('password')))
                         ->first();
        }
        Session::put('id',$row->id);
        Session::put('name',$row->name);
        Session::put('surname',$row->surname);
        Session::put('type','creator');
        Session::put('username',$row->username);
        Session::put('email',$row->email);
        Session::put('profile_pic',$row->profile_pic);
        $abbonamento = 'not_premium';
        return view('hw2')->with('abbonamento', $abbonamento);
      }
    } else{
      //login
      if(request('type') == "creator"){
          $rows = Creator::where('username', request('username'))->first();
          if(!isset($rows->id))
            return view('signup')->with('_token', csrf_token())
                                 ->with('errore','not_registered');
          else {
            $row = Creator::where('username', request('username'))
                          ->where('password', hash('sha256', request('password')))
                          ->first();
            if(!isset($row)) return view('signup')->with('_token', csrf_token())
                                 ->with('errore','wrong_psw');
            else{
              Session::put('id',$row->id);
              Session::put('name',$row->name);
              Session::put('surname',$row->surname);
              Session::put('type','creator');
              Session::put('username',$row->username);
              Session::put('email',$row->email);
              Session::put('profile_pic',$row->profile_pic);
              return view('upload');
            }
          }
      } else{
          $rows = Spectator::where('username', request('username'))->first();
          if(!isset($rows->id))
            return view('signup')->with('_token', csrf_token())
                                 ->with('errore','not_registered');
          else{
            $row = Spectator::where('username', request('username'))
                          ->where('password', hash('sha256', request('password')))
                          ->first();
            if(!isset($row)) return view('signup')->with('_token', csrf_token())
                                 ->with('errore','wrong_psw');
            else{
              Session::put('id',$row->id);
              Session::put('name',$row->name);
              Session::put('surname',$row->surname);
              Session::put('type','creator');
              Session::put('username',$row->username);
              Session::put('email',$row->email);
              Session::put('profile_pic',$row->profile_pic);
              $premium = Premium::where('id', $row->id)->first();
              $abbonamento = 'not_premium';
              if(isset($premium->id))
                $abbonamento = $premium->tipo;
              return view('hw2')->with('abbonamento', $abbonamento);
            }
          }
      }
    }
  }
}
?>
