<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model{

  public function spectator(){
    return $this->belongsTo("Spectator");
  }

  public function video(){
    return $this->belongsTo("Video");
  }

}

?>
