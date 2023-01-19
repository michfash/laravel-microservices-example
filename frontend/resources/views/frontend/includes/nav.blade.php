<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <a href="{{ route('frontend.index') }}" class="navbar-brand">Home</a>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="{{ route('frontend.orders') }}" class="nav-link">Order</a></li>
            <li class="nav-item"><a href="{{ route('frontend.products') }}" class="nav-link">Product</a></li>
            <li class="nav-item"><a href="{{ route('frontend.users') }}" class="nav-link">User</a></li>
        </ul>
    </div>
</nav>
