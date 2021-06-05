<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\UserCollection;

class Video extends Model{

  public function creator(){
    return $this->belongsTo("App\Models\Creator", 'creator');
  }

  public function Favourite(){
    return $this->hasMany("App\Models\Favourite");
  }

}

?>
