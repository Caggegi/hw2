<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\UserCollection;

class Favourite extends Model{

  public function spectator(){
    return $this->belongsTo("App\Models\Spectator", 'spectator');
  }

  public function video(){
    return $this->belongsTo("App\Models\Video", 'video');
  }

}

?>
