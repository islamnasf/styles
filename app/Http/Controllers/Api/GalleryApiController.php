<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class GalleryApiController extends Controller
{
   public function showGallery($sub){
    $subCategory=SubCategory::with('gallery')->where('id',$sub)->first();
    return $subCategory ;
   }
}
