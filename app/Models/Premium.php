<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\UserCollection;

class Premium extends Model{

  protected $table="premiums";

  public function spectator(){
    return $this->belongsTo("App\Models\Spectator", 'spectator');
  }

  public function creator(){
    return $this->belongsTo("App\Models\Creator", 'creator');
  }

  public function subscriptions(){
    return $this->hasOne("App\Models\Subscription");
  }

}

?>
