<div class="collapse navbar-collapse" id="sidenav-collapse-main">
    <!-- Collapse header -->
    <div class="navbar-collapse-header d-md-none">
        <div class="row">
        <div class="col-6 collapse-brand">
            <a href="./index.html">
            <img src="./assets/img/brand/blue.png">
            </a>
        </div>
        <div class="col-6 collapse-close">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
            <span></span>
            <span></span>
            </button>
        </div>
        </div>
    </div>
    <!-- Navigation -->
    <ul class="navbar-nav">
        <li class="nav-item  class=" active" ">
        <a class=" nav-link active " href="{{ url('/')}}"> <i class="ni ni-tv-2 text-primary"></i> Dashboard
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link " href="{{ url('/category/list')}}">
            <i class="ni ni-align-left-2 text-blue"></i> Category
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link " href="{{ url('/subcategory/list')}}">
            <i class="ni ni-align-left-2 text-orange"></i> Sub-Category
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link " href="{{ url('/subsubcategory/list')}}">
            <i class="ni ni-align-left-2 text-yellow"></i> Sub-Sub-Category
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link " href="{{ url('/designations/list')}}">
            <i class="ni ni-tie-bow text-red"></i> Designation
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ url('/persons/list')}}">
            <i class="ni ni-single-02 text-info"></i> Person
        </a>
        </li>
    </ul>
</div>