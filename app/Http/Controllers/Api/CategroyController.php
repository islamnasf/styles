<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategroyController extends Controller
{
    public function showCategory(){
        return Category::all();
    }
}
