<style>
    #sidebar ul.lead{
        border-bottom: 1px solid #47748b;
         width: fit-content;
         }
         #sidebar ul li a{
            padding: 10px;
            font-size: 1.1em;
            display: block;
            width: 30vh;
            color: #008B8B;
         }
         #sidebar ul li a:hover{
            color: #fff;
            background: #008B8B;
            text-decoration: none  !important;

         }


         #sidebar ul li a i{
            margin-right: 10px;

         }
         #sidebar ul li.active>a, a[aria-expanded="true"]{
          color: #fff;
          background: #008B8B;
         }

</style>
<nav class="active" id="sidebar">
<ul class="list-unstyled lead">
     <li class="active">
        <a href=""><i class="fas fa-home fa-lg"></i> Home</a>
     </li>
     <li>
        <a href=""><i class="fas fa-box fa-lg"></i> Orders</a>
     </li>
     <li>
        <a href=""><i class="fas fa-money-bill"></i> Transactions</a>
     </li>
      <li>
        <a href=""><i class="fas fa-truck fa-lg "></i>Products</a>
     </li>

     <li>
      <a href="{{route('sections.index')}}"><i class="fas fa-truck fa-lg "></i>Sections</a>
   </li>

</ul>


</nav>