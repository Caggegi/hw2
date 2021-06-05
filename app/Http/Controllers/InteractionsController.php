<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

use App\Models\Spectator;
use App\Models\Creator;
use App\Models\Premium;
use App\Models\Follower;
use App\Models\Video;
use App\Models\Favourite;
use App\Models\Subscription;

class InteractionsController extends BaseController{

  public function favouritesManager(){
    if(session('id') != null && request('azione') != null){
      $video = request('video_id');
      if(request('azione') == 'aggiungi'){
        $add = new Favourite;
        $add->spectator = session('id');
        $add->video = $video;
        $add->save();
        return 'query ok';
      } else{
        $remove = Favourite::where('spectator', session('id'))
                           ->where('video', $video)
                           ->first();
        $remove->delete();
      }
    }
    return 'query non completata: '.request('azione');
  }

  public function infoManager(){
    if(session('id') != null){
      $n_c = explode(" ",request('nome'));
      $user = Spectator::find(session('id'));
      if(session('type') === 'creator')
        $user = Creator::find(session('id'));
      $user->name = $n_c[0];
      $user->surname = $n_c[1];
      $user->email = request('email');
      $user->profile_pic = request('image');
      $user->save();
      Session::put('name',$user->name);
      Session::put('surname',$user->surname);
      Session::put('email',$user->email);
      Session::put('profile_pic',$user->profile_pic);
      return json_encode("{'query':'done'}");
    }
    return json_encode("{'query':'unknown user'}");
  }

  public function subscribe(){
    if(request('creator') != null){
      $follower = new Follower;
      $follower->creator = request('creator');
      $follower->spectator = session('id');
      $follower->save();
    }
  }

  public function unsubscribe(){
    if(request('creator') != null){
      $follower = Follower::where('creator', request('creator'))
                          ->where('spectator', session('id'))->first();
      $follower->delete();
    }
  }

  public function support(){
    if(request('creator') != null){
      $supporter = new Subscription;
      $supporter->creator = request('creator');
      $supporter->premium = session('id');
      $supporter->save();
    }
  }

  public function unsupport(){
    if(request('creator') != null){
      $supporter = Subscription::where('creator', request('creator'))
                          ->where('premium', session('id'))->first();
      $supporter->delete();
    }
  }

}
