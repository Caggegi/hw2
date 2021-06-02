<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Premium extends Model{

  protected $table="premiums";

  public function spectator(){
    return $this->hasOne("Spectator");
  }

  public function creator(){
    return $this->belongsTo("Creator");
  }

}

?>
