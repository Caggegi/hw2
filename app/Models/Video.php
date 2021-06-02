<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model{

  public function creator(){
    return $this->belongsTo("Creator");
  }

}

?>
