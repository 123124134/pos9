<div class="col-lg-12">
    <div class="row">
        <div class="col-md-8">
            <div class="card">

                {{-- @livewire('order') --}}
                <div class="card-header">
                    <h4 style="float: left">Order Products</h4>
                    <a href="#" style="float: right" class="btn btn-dark" data-toggle="modal"
                        data-target="#addproduct">
                        <i class="fas fa-plus"></i>Add New Products</a>
                </div>
            
                    <div class="card-body">
                        <div class="my-2">
                            <form wire:submit.prevent="InserttoCard">
                                <input type="text" name="" wire:model="product_code" id=""
                                    class="form-control" placeholder="Enter Product Code">
                            </form>
                        </div>
                        <div class="alert alert-success"> {{ $message }}</div>


                        @if (session()->has('success'))
                            <div class="alert alert-success">{{ session('success') }}
                            </div>
                        @elseif (session()->has('info'))
                            <div class="alert alert-info">{{ session('info') }}</div>
                        @elseif (session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        {{-- {{$productIncart}} --}}
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Dis (%)</th>
                                    <th colspan="6">Total </th>
                                    <th>
                                        {{-- <a href="#" class="btn btn-sm btn-success add_more"><i
                                                class="fas fa-plus-circle"></i></a> --}}
                                    </th>
                                </tr>

                            </thead>
                            <tbody class="addMoreProduct">
                                @foreach ($productIncart as $key => $cart)
                                    <tr>
                                        <td class="no">{{ $key + 1 }}</td>

                                        <td width="30%">
                                            <input type="text" class="form-control"
                                                value="{{ $cart->product->product_name }}">
                                        </td>
                                        <td width="18%">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <button wire:click.prevent="IncrementQty({{ $cart->id }})"
                                                        class="btn btn-sm btn-success" style="width:25px;"> + </button>
                                                </div>
                                                <div class="col-md-4 text-center" style="background-color: gray">
                                                    <label for="">{{ $cart->product_qty }}</label>
                                                </div>
                                                <div class="col-md-3 " style="background-color: gray">
                                                    <button wire:click.prevent="DecrementQty({{ $cart->id }})"
                                                        class="btn btn-sm btn-danger"> - </button>
                                                </div>
                                            </div>

                                        </td>

                                        <td>
                                            <input type="number" value="{{ $cart->product->price }}" id="price"
                                                class="form-control ">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number"
                                                value="{{ $cart->product_qty * $cart->product->price }}"
                                                class="form-control total_amount">

                                        </td>
                                        <td><a href="#" wire:click="removeProduct({{ $cart->id }})"
                                                class="btn btn-sm btn-danger "><i class="fas fa-times"></i></a> </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

            </div>
        </div>





        <div class="col-md-4">

            <form action="{{ route('orders.store') }}" method="POST">

                @csrf

            @foreach ($productIncart as $key => $cart)
            <input type="hidden" class="form-control" value="{{ $cart->product->id }}" name="product_id[]">


            <input type="hidden" name="quantity[]" value="{{ $cart->product_qty }}">


            <input type="hidden" name="price[]" value="{{ $cart->product->price }}" id="price"
                class="form-control price">

            <input type="hidden" name="discount[]" class="form-control discount">

            <input type="hidden" name="product_amount[]" value="{{ $cart->product_qty * $cart->product->price }}"
                class="form-control total_amount">
        @endforeach

            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Total <b class="total">{{ $productIncart->sum('product_price') }}</b></h4>
                            <input name="amount" class="total">
                        </div>

                        <div class="card-body">
                            <div class="btn-group">
                                <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-dark"><i
                                        class="fas fa-print"></i> Print</button>

                                <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-primary"><i
                                        class="fas fa-print"></i> Histroy</button>

                                <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-danger"><i
                                        class="fas fa-print"></i> Report</button>
                            </div>
                            <div class="panel">
                                <div class="row">
                                    <table class="table table-striped">
                                        <tr>
                                            <td>
                                                <label for="">Customer Name</label>
                                                <input type="text" name="customer_name" class="form-control">

                                            </td>
                                            <td>
                                                <label for="">Customer Phone</label>


                                                <input type="number" name="customer_phone" class="form-control">

                                            </td>
                                        </tr>
                                    </table>
                                    <td> Payment Method
                                        <div>
                                            <span class="radio-item">
                                                <input type="radio" name="payment_method" id="payment_method"
                                                    class="true" value="cash">
                                                <label for="payment_method"><i
                                                        class="fas fa-money-bill text-success"></i> Cash</label>
                                            </span>

                                            <span class="radio-item">
                                                <input type="radio" name="payment_method" id="payment_method"
                                                    class="true" value="bank transfer">
                                                <label for="payment_method"><i
                                                        class="fas fa-university text-danger"></i> Bank
                                                    Transfer</label>
                                            </span>

                                            <span class="radio-item">
                                                <input type="radio" name="payment_method" id="payment_method"
                                                    class="true" value="credit Card">
                                                <label for="payment_method"><i
                                                        class="fas fa-credit-card text-info"></i> Credit
                                                    Card</label>
                                            </span>

                                    </td><br>

                                    <td>
                                        Payment
                                        <input type="number" wire:model="pay_money" name="paid_amount"
                                            id="paid_amount" class="form-control">
                                    </td>

                                    <td>
                                        Returning Changing
                                        <input type="number" wire:model="balance" readonly name="balance"
                                            id="balance" class="form-control">
                                    </td>
                                    <td>
                                        <button class="btn-primary btn-lg btn-block mt-3">Save</button>
                                    </td>
                                    <td>
                                        <button class="btn-danger btn-lg btn-block mt-2">Calculator</button>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a href="#" class="text-danger"><i
                                                    class="fas fa-sign-out-alt"></i></a>
                                        </div>
                                    </td>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
        </div>



        {{-- modal of adding new product --}}


        <div class="modal right fade" id="addproduct" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('products.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" name="product_name" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Brand</label>
                                <input type="text" name="brand" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" name="price" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Quantity</label>
                                <input type="number" name="quantity" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Alert Stock</label>
                                <input type="number" name="alert_stock" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" id="" cols="30" rows="2" class="form-control"></textarea>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary btn-block">Save Product</button>
                            </div>

                    </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
