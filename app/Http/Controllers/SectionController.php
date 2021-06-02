<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

use App\Models\Spectator;
use App\Models\Creator;
use App\Models\Premium;
use App\Models\Video;
use App\Models\Favourite;
use App\Models\Follower;

class SectionController extends BaseController {

  public function load($mode, $valore=''){
    $contents = array();
    if($mode!=null && $mode!='home'){
      if($mode == 'preferiti'){
        if(session('id')!=null){
          $contents = Video::join('creators', 'videos.creator', '=', 'creators.id')
                           ->join('favourites', 'videos.id', '=', 'favourites.video')
                           ->select('videos.titolo','videos.immagine','videos.descrizione',
                             'videos.src', 'videos.id', 'videos.tipo', 'creators.username')
                           ->where('favourites.spectator',session('id'))->get();
        }
      } else if($mode == 'recenti'){
          $contents = Video::join('creators', 'videos.creator', '=', 'creators.id')
                           ->select('videos.titolo','videos.immagine','videos.descrizione',
                               'videos.src', 'videos.id', 'videos.tipo', 'creators.username')
                           ->orderBy('videos.created_at','desc')->limit(10)->get();
      } else if($mode == 'tendenze'){
          $contents = Video::join('creators', 'videos.creator', '=', 'creators.id')
                           ->select('videos.titolo','videos.immagine','videos.descrizione',
                               'videos.src', 'videos.id', 'videos.tipo', 'creators.username')
                           ->orderBy('likes','desc')->limit(10)->get();
      } else if($mode == 'ricerca' && isset($valore)){
          $contents = Video::join('creators', 'videos.creator', '=', 'creators.id')
                           ->select('videos.titolo','videos.immagine','videos.descrizione',
                               'videos.src', 'videos.id', 'videos.tipo', 'creators.username')
                           ->where('titolo','like', '%'.$valore.'%')->get();
      }
    }
     else{
       $contents = Video::join('creators', 'videos.creator', '=', 'creators.id')
                        ->select('videos.titolo','videos.immagine','videos.descrizione',
                            'videos.src', 'videos.id', 'videos.tipo', 'creators.username')->get();
    }
    return json_encode($contents);
  }

  public function myCreators(){
    $my_creators = array();
    if(session('id') != null){
      $my_creators = Follower::join('creators','followers.creator', '=', 'creators.id')
                           ->select('creators.id','creators.username',
                                'creators.profile_pic','followers.created_at')
                           ->where('followers.spectator',session('id'))
                           ->orderBy('username')->get();
    }
    return json_encode($my_creators);
  }

}
