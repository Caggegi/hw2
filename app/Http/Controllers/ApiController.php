<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class ApiController extends BaseController
{
  public function imagePalette($category='pattern'){
    if($category == 'pattern')
      $pg=rand(1,10);
    else $pg=1;
    $json = Http::get('https://api.unsplash.com//search/photos/?',[
      "page"=>$pg,
      "query"=>$category,
      "orientation"=>"squarish",
      "content_filter"=>"high",
      "per_page"=>5,
      "client_id"=>env('UNSPLASH_KEY')
    ]);
    return $json;
  }
}
