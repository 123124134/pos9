@extends('layouts.app')
<style>
    .modal.right .modal-dialog {
        top: 0;
        right: 0;
        margin-right: 19vh;
    }

    .modal.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate3d(25%, 0, 0);
        transform: translate3d(25%, 0, 0);

    }
</style>

@section('content')
    
        {{-- modal of adding new product --}}
@livewire('products')

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

                        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" name="product_name" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Product Code</label>
                                <input type="text" name="product_code" id="" class="form-control">
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

                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" name="product_image" id="" cols="30" rows="2"
                                    class="form-control">
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary btn-block">Save Product</button>
                            </div>

                    </div>
                    </form>
                </div>
            </div>


        </div>
    @endsection
