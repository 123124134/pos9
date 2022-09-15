<?php

namespace App\Http\Livewire;

use App\Models\product;
use App\Models\Cart;
use Livewire\Component;

class Order extends Component
{
  public $orders, $products = [], $product_code, $message = '', $productIncart;
   
  public $pay_money = '' , $balance = '';



  public function mount()
  {
    $this->products = product::all();
    $this->productIncart = Cart::get();
    // dd($this->productIncart);
  }

  public function InserttoCard()
  {
    $countProduct = product::where('id', $this->product_code)->first();
    if (!$countProduct) {
      return $this->message = 'Product Not Found';
    }
    $countCartProduct = Cart::where('product_id', $this->product_code)->count();
    if ($countCartProduct > 0) {
      return $this->message = 'Product' . $countProduct->product_name  . 'already exist in cart please add quantity';
    }
    $add_to_cart = new Cart;
    $add_to_cart->product_id = $countProduct->id;
    $add_to_cart->product_qty = $countProduct->quantity;
    $add_to_cart->product_price = $countProduct->price;
    $add_to_cart->user_id = auth()->user()->id;
    $add_to_cart->save();

    $this->productIncart->prepend($add_to_cart);

    $this->product_code = ' ';
    return $this->message = "Product Added Successfully!";
    // dd( $countProduct);
  }

    public function IncrementQty($cartId)
    {
      $carts = Cart::find($cartId);
      $carts->increment('product_qty' , 1);
      $updatePrice =$carts->product_qty * $carts->product->price;

      $carts->update(['product_price' => $updatePrice]);
      $this->mount();
      
    
      
    }

    public function DecrementQty($cartId)
    {
      $carts = Cart::find($cartId);

      if($carts->product_qty==1){
         return session()->flash('info', 'product ' . $carts->product->product_name . '  Quantity can not be less than 1 add quantity or remove product in cart.');
      }
        $carts->decrement('product_qty' , 1);
        $updatePrice =$carts->product_qty * $carts->product->price;
  
        $carts->update(['product_price' => $updatePrice]);
        $this->mount();
        
       
      
    }

  public function removeProduct($cartId)
  {
    $deleteCart = Cart::find($cartId);
    $deleteCart->delete();

    $this->message = "Product Removed from Cart";
    $this->productIncart = $this->productIncart->except($cartId);
  }

  public function render()
  {
    if ($this->pay_money != ''){
      $totalAmount = $this->pay_money - $this->productIncart->sum('product_price');
      $this->balance = $totalAmount;
    }
 
    return view('livewire.order');
  }
}
