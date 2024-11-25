<nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
    <a href="/" class="navbar-brand p-0">
        <h1 class="m-0"><img src="{{ asset('2.png') }}" alt="FEMCAS logo" width="70"></i>FEMCAS</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="/" class="nav-item nav-link active">Home</a>
            <a href="#" class="nav-item nav-link">Our Services</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">About Us</a>
                <div class="dropdown-menu m-0">
                    <a href="#" class="dropdown-item">Our Story</a>
                    <a href="#" class="dropdown-item">Executive Team</a>
                </div>
            </div>
            <a href="contact.html" class="nav-item nav-link">Contact Us</a>
        </div>
        <butaton type="button" class="btn text-secondary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i
                class="fa fa-search"></i></butaton>
        <a href="{{ route('login') }}" class="btn btn-secondary py-2 px-4 ms-3">Login to your Account</a>
    </div>
</nav>
