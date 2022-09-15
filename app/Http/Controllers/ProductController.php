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
    $product =product::select('barcode','product_code')->get();
    return view('products.barcode',compact('product'));
  }

  public function store(Request $request)
  {
    // return $request->all();

    // product code section

    $product_code = rand(106897532, 100000000);

    $redcolor = '255,0,0';
    $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
     file_put_contents('products/barcodes/'.$product_code.'.jpg',
      $generator->getBarcode(
      $product_code,
      $generator::TYPE_STANDARD_2_5,
      2,
      60
    )

     );


    Product::create($request->all());
    $products = new Product;
    $products->product_name = $request->product_name;
    $products->product_code = $request->$product_code;
    $products->quantity = $request->quantity;
    $products->price = $request->price;
    $products->brand = $request->brand;
    $products->alert_stock = $request->alert_stock;
    $products->description = $request->description;
    $products->barcode = $product_code.'jpg';
    $products->save();

    return redirect()->back()->with('success', 'Product Created Successfully');
  }

  public function update(Request $request, product $product, $id)
  {
    $product_code = rand(106897532, 100000000);

    $redcolor = '255,0,0';
    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();

    $barcodes = $generator->getBarcode(
      $product_code,
      $generator::TYPE_STANDARD_2_5,
      2,
      60
    );

    // Product::create($request->all());
    $product = Product:: find($id);
    $product->product_name = $request->product_name;
    $product->product_code = $product_code;
    $product->quantity = $request->quantity;
    $product->price = $request->price;
    $product->brand = $request->brand;
    $product->alert_stock = $request->alert_stock;
    $product->description = $request->description;
    $product->barcode = $barcodes;
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
