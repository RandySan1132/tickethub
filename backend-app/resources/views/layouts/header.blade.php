<nav class="nav">
        <a href="{{ route('landing') }}" class="nav_logo">
            <img src="{{ asset('images/tickethub logo.png') }}" width="30" height="30" alt="TicketHub Logo">
        </a>
            <ul class="nav_item">
                <li class="nav_item">
                    <!-- <a href="/event" class="nav_link">EVENT</a>
                    <a href="/venue" class="nav_link">VENUES</a>
                    <a href="/blog" class="nav_link">BLOG</a>
                    <a href="/contact-us" class="nav_link">CONTACT</a> -->
                    <a href="{{ route('event') }}" class="nav_link">EVENT</a>
                    <a href="{{ route('blog') }}" class="nav_link">BLOG</a>
                    <a href="{{ route('contact-us') }}" class="nav_link">CONTACT</a>
                </li>
            </ul>
            <div class="search-cart">
                <input type="text" placeholder="Search events">
                <a href="{{ url('/search') }}">
                    <img src="{{ asset('images/search.png') }}" alt="Search">
                </a>
                <a href="{{ route('checkout') }}">
                    <img src="{{ asset('images/cart.png') }}" alt="Cart">
                </a>
                <a href="{{ route('login') }}">
                    <img src="{{ asset('images/people.png') }}" alt="Profile">
                </a>
            </div>
        </nav>