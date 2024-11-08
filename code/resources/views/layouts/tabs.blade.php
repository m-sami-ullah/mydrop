<ul class="nav nav-tabs">
    <li class=" {{ request()->routeis("customers.edit")?"active":"" }} "><a href="{{ route('customers.edit',['customer'=>$customer->id]) }}">Basic Info</a></li>
    <li class=" {{ request()->routeis("customers.addresses.*") && !request()->routeis("customers.addresses.boxes.*")?"active":"" }} "><a href="{{ route('customers.addresses.index',['customer'=>$customer->id]) }}">Addresses</a></li>
    @if (request()->routeis("customers.addresses.boxes.*"))
	    <li class="{{ request()->routeis("customers.addresses.boxes.*")?"active":"" }}"><a href="javascript::return">Boxes</a></li>
    @endif

</ul>