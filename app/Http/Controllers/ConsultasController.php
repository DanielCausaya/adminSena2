<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class ConsultasController extends Controller
{
    public function consultasCategory(){

        return "hola desde consultas category";

    }

    public function consultasProduct(){


    $products = Product::with(['user.profile'])->get();
         return $products;

    }
}