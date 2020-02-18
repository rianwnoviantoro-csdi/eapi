<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
  public function toArray($request) {
    return [
      'name'        => $this->name,
      'description' => $this->detail,
      'price'       => $this->price,
      'stock'       => $this->stock == 0 ? 'Out of Stock' : $this->stock,
      'discount'    => $this->discount,
      'finalPrice'  => round((1-($this->discount/100)) * $this->price, 2),
      'rating'      => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count()) : 'No rating yet',
      'href'        => [
        'reviews' => route('reviews.index', $this->id) 
      ]
    ];
  }
}
