<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\UserCollection;

class Follower extends Model{

  public function spectator(){
    return $this->belongsTo("App\Models\Spectator", 'spectator');
  }

  public function creator(){
    return $this->belongsTo("App\Models\Creator", 'creator');
  }

}

?>
