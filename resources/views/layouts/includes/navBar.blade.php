<style>
.btn-outline{
    border-color: #008B8B;
    color: #008B8B; 
}
.btn-outline:hover{
    background: #008B8B;
    color: #fff; 
}
</style>
@if(!auth()->user())

@else
<a href="#" data-toggle="modal" data-target="#staticBackdrop" class="btn btn-outline  rounded-pill" ><i class="fa fa-list"></i></a>
<a href="#" class="btn btn-outline rounded-pill"><i class="fas fa-list"></i></a>
<a href="{{route('users.index')}}" class="btn btn-outline rounded-pill"><i class="fas fa-user"></i> Users</a>
<a href="{{ route('products.index') }}" class="btn btn-outline rounded-pill"><i class="fas fa-box"></i> Products</a>
<a href="{{ route('orders.index') }}" class="btn btn-outline rounded-pill"><i class="fas fa-desktop"></i> Cashire</a>
<a href="#" class="btn btn-outline rounded-pill"><i class="fas fa-file"></i> Report</a>
<a href="#" class="btn btn-outline rounded-pill"><i class="fas fa-money-bill"></i> Transactions</a>
<a href="#" class="btn btn-outline rounded-pill"><i class="fas fa-bar-chart"></i> Supplier</a>
<a href="#" class="btn btn-outline rounded-pill"><i class="fas fa-user-group"></i> Coustmers</a>
<a href="#" class="btn btn-outline rounded-pill"><i class="fas fa-truck fa-lg"></i> Incoming</a>

@endif