<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-box"></i> Catalog</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('product') }}'><i class='nav-icon la la-circle'></i> Product</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('category') }}'><i class='nav-icon la la-circle'></i> Category</a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-boxes"></i> Purchase</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('purchase-order') }}'><i class='nav-icon la la-circle'></i> Purchase Order</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('supplier') }}'><i class='nav-icon la la-circle'></i> Supplier</a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-boxes"></i> Inventory</a>
    <ul class="nav-dropdown-items">
    </ul>
</li>

<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>
