    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="float: left">Add Products</h4>
                            <a href="#" style="float: right" class="btn btn-dark" data-toggle="modal"
                                data-target="#addproduct">
                                <i class="fas fa-plus"></i>Add New Products</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-left">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Alert Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td style="cursor: pointer" data-toggle="tooltip" data-placement="right"
                                                title="Click to view Detail"
                                                wire:click="ProductDetails({{ $product->id }})">
                                                {{ $product->product_name }}</td>
                                            <td>{{ $product->brand }}</td>
                                            <td>{{ number_format($product->price, 2) }}</td>
                                            <td>{{ $product->quantity }}</td>

                                            <td>
                                                @if ($product->alert_stock >= $product->quantity)
                                                    <span class="badge badge-danger">Low Stock
                                                        >{{ $product->alert_stock }}</span>
                                                @else
                                                    <span class="badge badge-success">{{ $product->alert_stock }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal"
                                                        data-target="#editproduct{{ $product->id }}"><i
                                                            class="fas fa-edit"></i>Edit</a>
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#deleteproduct{{ $product->id }}"
                                                        class="btn btn-sm btn-danger"><i
                                                            class="fas fa-trash"></i>DEl</a>
                                                </div>
                                            </td>


                                        </tr>
                                        {{-- Modal od Edit product Detail --}}


                                        {{-- edit modal --}}
                                        @include('products.edit')



                                        <div class="modal right fade" id="deleteproduct{{ $product->id }}"
                                            data-backdrop="static" data-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="staticBackdropLabel">Delete product
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>

                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="{{ route('products.destroy', $product->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <p>Are you sure want to delete this
                                                                {{ $product->product_name }} ?</p>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-info"
                                                                    data-dismiss="modal">Cancel</button>

                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </div>

                                                    </div>
                                                    </form>
                                                </div>
                                            </div>


                                        </div>
                                    @endforeach

                                    {{-- {{ $products->links('pagination::bootstrap-5') }} --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Search details</h4>
                                </div>
                                <div class="card-body">
                                    @include('products.product_detail')
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
