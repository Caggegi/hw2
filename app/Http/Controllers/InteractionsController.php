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
}
