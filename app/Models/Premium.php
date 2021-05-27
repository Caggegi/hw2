<?php

namespace App\Models;

class Premium extends Model{

  public function spectator(){
    return $this->hasOne("Spectator");
  }

  public function creator(){
    return $this->belongsTo("Creator");
  }

}

?>
