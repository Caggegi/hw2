<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model{

  public function spectators(){
    return $this->hasMany("Spectator");
  }

  public function creators(){
    return $this->hasMany("Creator");
  }

}

?>
