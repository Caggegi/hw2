<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\UserCollection;

class Subscription extends Model{

  public function premiums(){
    return $this->belongsTo("App\Models\Premium", 'premium');
  }

  public function creators(){
    return $this->belongsTo("App\Models\Creator", 'creator');
  }

}

?>
