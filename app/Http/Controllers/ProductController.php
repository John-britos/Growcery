<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;
use App\Enums\ProductStatus;
use App\Enums\Enums\ProductStatusEnum;
use App\Http\Resources\ProductListResource;


class ProductController extends Controller
{
    public function home(){
        $products = Product::query()
            ->published()
            ->paginate(12);
        
        return Inertia::render('Home', [
            'products' => ProductListResource::collection($products),
        ]);
    }
    public function show(Product $product){
      
    }
}
