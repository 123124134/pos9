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
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="float: left">Add Products</h4>
                            <a href="#" style="float: right" class="btn btn-dark" data-toggle="modal"
                                data-target="#addproduct">
                                <i class="fas fa-plus"></i>Add New Products</a>
                        </div>
                        <div class="card-body">
                            <div id="print">
                                <div class="row text-center">
                                    @foreach ($product as $code)
                                        <div class="col-md-4 col-sm-12 text-center">
                                            <div class="card">
                                                <div class="card-body ">
                                                    {!! $code->barcode !!}
                                                    <h4 class="text-center" style="padding:1em; margin-top:2em;">{{$code->product_code}}</h4>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- modal of adding new product --}}
    @endsection
