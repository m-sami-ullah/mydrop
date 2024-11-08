<ul class="nav nav-tabs">
    <li class=" {{ request()->routeis("config.*")?"active":"" }} "><a href="{{ route('config.edit',['config'=>1]) }}">Home</a></li>
    <li class=" {{ request()->routeis("menu.links") ?"active":"" }} "><a href="{{ route('menu.links',['nav'=>1]) }}">Main Menu</a></li>
    <li class=" {{ request()->routeis("banners.*")?"active":"" }} "><a href="{{ route('banners.index') }}">Banners</a></li>
    <li class=" {{ request()->routeis("clients.*")?"active":"" }} "><a href="{{ route('clients.index') }}">Trusted Clients</a></li>
    <li class=" {{ request()->routeis("services.*")?"active":"" }} "><a href="{{ route('services.index') }}">Services</a></li>
    <li class=" {{ request()->routeis("faqs.*")?"active":"" }} "><a href="{{ route('faqs.index') }}">FAQ</a></li>
    <li class=" {{ request()->routeis("testimonials.*")?"active":"" }} "><a href="{{ route('testimonials.index') }}">Testimonials</a></li>
    <li class=" {{ request()->routeis("socials.*")?"active":"" }} "><a href="{{ route('socials.index') }}">Social Media</a></li>
    {{-- <li class=" {{ request()->routeis("menu.links") ?"active":"" }} "><a href="{{ route('menu.links',['nav'=>2]) }}">Footer Menu</a></li> --}}
</ul>