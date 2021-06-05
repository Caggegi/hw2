<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

use App\Models\Spectator;
use App\Models\Creator;
use App\Models\Premium;
use App\Models\Video;
use App\Models\Follower;
use App\Models\Subscription;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(){
      if(session('id') != null){
        if(session('type') === 'spectator'){
          $user=Spectator::find(session('id'));
          $premium = Premium::where('id', $user->id)->first();
          $abbonamento = 'not_premium';
          if(isset($premium->id))
            $abbonamento = $premium->tipo;
          return view('hw2')->with('profile_pic', $user->profile_pic)
                            ->with('nome', $user->name)
                            ->with('cognome', $user->surname)
                            ->with('email', $user->email)
                            ->with('abbonamento', $abbonamento);
        } else {
          return view('upload');
        }
      } else{
        return view('hw2')->with('profile_pic', 'https://raw.githubusercontent.com/Caggegi/mhw3/main/img/icons/account-circle-outline.svg')
                          ->with('nome', 'Welcome')
                          ->with('cognome', 'Stranger')
                          ->with('email', 'Register or log in now!')
                          ->with('abbonamento', 'not_premium');
      }
    }

    public function display_login(){
      return view('signup')->with('_token', csrf_token());
    }

    public function logout(){
          Session::flush();
          return redirect('login');
    }

    public function videoPage($id, $src){
      $video = Video::where('id', $id)
                    ->where('src', $src)->first();
      $support = null;
      if($is_premium = Premium::where('id',session('id'))
                              ->exists()){
          if(Subscription::where('premium', session('id'))->exists()){
            $s = Subscription::where('premium', session('id'))->first();
            $support = $s->creator;
          } else $support = null;
      }
      $is_subscribed = Follower::where('spectator', session('id'))
                               ->where('creator', $video->creator)
                               ->exists();
      $creator = Creator::find($video->creator);
      return view('video-content')->with('videoid', $id)->with('videosrc', $src)
                  ->with('titolo', $video->titolo)->with('descrizione',$video->descrizione)
                  ->with('pubblicazione', $video->created_at)
                  ->with('creator', $creator->username)
                  ->with('creator_pic', $creator->profile_pic)
                  ->with('creator_id', $video->creator)
                  ->with('is_subscribed', $is_subscribed)
                  ->with('is_premium', $is_premium)
                  ->with('support', $support);
    }

    public function display_joinus(){
      return view('join_us')->with('error','no_error');
    }

    public function joinus(){
      $user=Spectator::find(session('id'));
      if($user->password == hash('sha256', request('pass'))){
        $premium = new Premium;
        $premium -> id=session('id');
        $premium -> tipo = request('tipo_abbonamento');
        $costo=-1;
        $mensile=-2;
        if($premium->tipo=='settimanale'){
          $costo = 2.99;
          $mensile = $costo*4;
        } else if($premium->tipo=='mensile'){
            $costo = 8.99;
            $mensile = $costo;
        } else if($premium->tipo=='annuale'){
            $costo = 96.00;
            $mensile = $costo/12;
        }
        $premium->costo = $costo;
        $premium->mensile = $mensile;
        $premium->save();
        return view('hw2')->with('profile_pic', $user->profile_pic)
                          ->with('nome', $user->name)
                          ->with('cognome', $user->surname)
                          ->with('email', $user->email)
                          ->with('abbonamento', $premium->tipo);
      }
      else return view('join_us')->with('error','pass_error');
    }

    public function leave_us(){
      $premium = Premium::find(session('id'));
      if($premium != null){
        $premium->delete();
        return view('leave_us');
      } else return redirect('join_us');
    }
}
