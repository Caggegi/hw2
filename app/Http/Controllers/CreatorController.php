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

class CreatorController extends BaseController{
  public function newVideo(){
    $json_=array("risposta"=>"errore");
    if(session('id') != null && request('titolo') != null && request('copertina') != null
        && request('descrizione') != null && request('src') != null){
      if(strpos(request('src'), 'youtube') != ""){
        $id = "";
        $start_id = strpos(request('src'),'v=');
        if($start_id == '') $json_["risposta"]='url_esterno';
        else{
          $start_id = $start_id + 2;
          $end_id = strpos(request('src'),"&");
          if($end_id == "") $end_id = 11;
          else $end_id = $end_id-$start_id;
          for($i=0; $i<$end_id; $i++)
              $id.=request('src')[$start_id+$i];
          $video = new Video;
          $video->titolo = request('titolo');
          $video->descrizione = request('descrizione');
          $video->immagine = request('copertina');
          $video->creator = session('id');
          $video->src = $id;
          $video->tipo = request('tipo');
          $video->save();
          $json_["risposta"]='video_caricato';
          $json_["titolo"]=request('titolo');
          $json_["copertina"]=request('copertina');
          $json_["descrizione"]=request('descrizione');
        }
      } else $json_["risposta"]='url_esterno';
        echo json_encode($json_);
    } else{
        $json_["risposta"]='errore';
        echo json_encode($json_);
  }
}

public function getVideos($crid){
  $videos = Video::select('titolo', 'immagine', 'descrizione')
                 ->where('creator', $crid)->get();
  return json_encode($videos);
}

}
?>
