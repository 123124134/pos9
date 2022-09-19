<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Picqer;

class ProductController extends Controller
{
  public function index()
  {
    $products = product::paginate(5);
    return view('products.index', ['products' => $products]);
  }

  public function GetProductBarcodes()
  {
    $product = product::select('barcode', 'product_code')->get();
    return view('products.barcode', compact('product'));
  }

  public function store(Request $request)
  {
    // return $request->all();

    // product code section
    $products = new Product;
    $product_code = $request->product_code;

    //  image section

    if ($request->hasFile('product_image')) {
    
      $file = $request->file('product_image');
      $file->move(public_path() . '/products/images', $file->getClientOriginalName());
      $product_image = $file->getClientOriginalName();
      $products->product_image = $product_image;
    }

    // Barcode Image Section
   if($request->product_code != '' && $request->product_code != $products->product_code ){

    $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
    file_put_contents(
      'products/barcodes/' . $product_code . '.jpg',
      $generator->getBarcode(
        $product_code,
        $generator::TYPE_CODE_128,
        3,
        50
      )
    );


   }

    
      $products->barcode = $product_code . '.jpg';
    
    // Product::create($request->all());
    $products->product_name = $request->product_name;
    $products->product_code = $product_code;
    $products->quantity = $request->quantity;
    $products->price = $request->price;
    $products->brand = $request->brand;
    $products->alert_stock = $request->alert_stock;
    $products->description = $request->description;
    $products->save();

    return redirect()->back()->with('success', 'Product Created Successfully');
  }

  public function update(Request $request, product $product, $id)
  {
    $product = Product::find($id);

     
  
    if ($request->hasFile('product_image')) {
      if ($product->product_image != '') {
        $proImage_path = public_path() . '/products/images/' . $product->product_image;
        unlink($proImage_path);
      }
      $file = $request->file('product_image');
      $file->move(public_path() . '/products/images', $file->getClientOriginalName());
      $product_image = $file->getClientOriginalName();
      $product->product_image = $product_image;
    

    }
    $product_code = $product->product_code;
    $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
    file_put_contents(
      'products/barcodes/' . $product_code . '.jpg',
      $generator->getBarcode(
        $product_code,
        $generator::TYPE_CODE_128,
        3,
        50
      )
    );
 
    $product->barcode = $product_code . '.jpg';

    // Product::create($request->all());
    $product->product_name = $request->product_name;
    $product->product_code = $product_code;
    $product->quantity = $request->quantity;
    $product->price = $request->price;
    $product->brand = $request->brand;
    $product->alert_stock = $request->alert_stock;
    $product->description = $request->description;
    $product->barcode = $product_code . '.jpg';
    $product->save();

    // $new = $product::find($id);
    // $product->update($request->all());
    return redirect()->back()->with('success', 'Product Updated Successfully!');
    
  }

  public function destroy(Product $product, $id)

  {


    $product = $product::find($id);

    $product->delete();
    return redirect()->back()->with('success', 'Product Deleted Successfully');
  }
}
