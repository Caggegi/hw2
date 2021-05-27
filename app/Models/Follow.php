<?php

namespace App\Models;

class Follow extends Model{

  public function spectators(){
    return $this->hasMany("Spectator");
  }

  public function creators(){
    return $this->hasMany("Creator");
  }

}

?>
