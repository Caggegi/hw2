<?php

namespace App\Models;

class Video extends Model{

  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'titolo',
      'immagine',
      'descrizione',
      'tipo',
      'src',
  ];

  public function creator(){
    return $this->belongsTo("Creator");
  }

}

?>
