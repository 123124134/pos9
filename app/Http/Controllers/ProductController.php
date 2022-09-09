<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index()
  {
    $products = product::paginate(5);
    return view('products.index', ['products' => $products]);
  }

  public function store(Request $request)
  {
    Product::create($request->all());
    return redirect()->back()->with('success', 'Product Created Successfully');
  }

   public function update(Request $request, product $product,$id)
   {
    $new=$product::find($id); 
        $new->update($request->all());
     return redirect()->back()->with('success','Product Updated Successfully!');
   }

   public function destroy(Product $product,$id)
   
   {    

    
    $product=$product::find($id); 

    $product->delete();
     return redirect()->back()->with('success','Product Deleted Successfully');
   }
}
