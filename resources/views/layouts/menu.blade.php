<li class="{{ Request::is('parameters*') ? 'active' : '' }}">
    <a href="{!! route('parameters.index') !!}"><i class="fa fa-edit"></i><span>Parameters</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('attributes*') ? 'active' : '' }}">
    <a href="{!! route('attributes.index') !!}"><i class="fa fa-edit"></i><span>Attributes</span></a>
</li>

<li class="{{ Request::is('products*') ? 'active' : '' }}">
    <a href="{!! route('products.index') !!}"><i class="fa fa-edit"></i><span>Products</span></a>
</li>

<li class="{{ Request::is('orders*') ? 'active' : '' }}">
    <a href="{!! route('orders.index') !!}"><i class="fa fa-edit"></i><span>Orders</span></a>
</li>

<li class="{{ Request::is('orderDetails*') ? 'active' : '' }}">
    <a href="{!! route('orderDetails.index') !!}"><i class="fa fa-edit"></i><span>Order Details</span></a>
</li>

<li class="{{ Request::is('categoryAttributes*') ? 'active' : '' }}">
    <a href="{!! route('categoryAttributes.index') !!}"><i class="fa fa-edit"></i><span>Category Attributes</span></a>
</li>

<li class="{{ Request::is('categoryProducts*') ? 'active' : '' }}">
    <a href="{!! route('categoryProducts.index') !!}"><i class="fa fa-edit"></i><span>Category Products</span></a>
</li>

<li class="{{ Request::is('categories*') ? 'active' : '' }}">
    <a href="{!! route('categories.index') !!}"><i class="fa fa-edit"></i><span>Categories</span></a>
</li>

<li class="{{ Request::is('images*') ? 'active' : '' }}">
    <a href="{!! route('images.index') !!}"><i class="fa fa-edit"></i><span>Images</span></a>
</li>

<li class="{{ Request::is('sections*') ? 'active' : '' }}">
    <a href="{!! route('sections.index') !!}"><i class="fa fa-edit"></i><span>Sections</span></a>
</li>

<li class="{{ Request::is('payments*') ? 'active' : '' }}">
    <a href="{!! route('payments.index') !!}"><i class="fa fa-edit"></i><span>Payments</span></a>
</li>

<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-edit"></i><span>Roles</span></a>
</li>

<li class="{{ Request::is('roleUsers*') ? 'active' : '' }}">
    <a href="{!! route('roleUsers.index') !!}"><i class="fa fa-edit"></i><span>Role Users</span></a>
</li>

<li class="{{ Request::is('countries*') ? 'active' : '' }}">
    <a href="{!! route('countries.index') !!}"><i class="fa fa-edit"></i><span>Countries</span></a>
</li>

<li class="{{ Request::is('zones*') ? 'active' : '' }}">
    <a href="{!! route('zones.index') !!}"><i class="fa fa-edit"></i><span>Zones</span></a>
</li>

<li class="{{ Request::is('cities*') ? 'active' : '' }}">
    <a href="{!! route('cities.index') !!}"><i class="fa fa-edit"></i><span>Cities</span></a>
</li>

<li class="{{ Request::is('locations*') ? 'active' : '' }}">
    <a href="{!! route('locations.index') !!}"><i class="fa fa-edit"></i><span>Locations</span></a>
</li>

<li class="{{ Request::is('addresses*') ? 'active' : '' }}">
    <a href="{!! route('addresses.index') !!}"><i class="fa fa-edit"></i><span>Addresses</span></a>
</li>

<li class="{{ Request::is('userAddresses*') ? 'active' : '' }}">
    <a href="{!! route('userAddresses.index') !!}"><i class="fa fa-edit"></i><span>User Addresses</span></a>
</li>

<li class="{{ Request::is('mailings*') ? 'active' : '' }}">
    <a href="{!! route('mailings.index') !!}"><i class="fa fa-edit"></i><span>Mailings</span></a>
</li>

{{--<li class="{{ Request::is('entities*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('entities.index') !!}"><i class="fa fa-edit"></i><span>Entities</span></a>--}}
{{--</li>--}}

<li class="{{ Request::is('sectionEntities*') ? 'active' : '' }}">
    <a href="{!! route('sectionEntities.index') !!}"><i class="fa fa-edit"></i><span>Section Entities</span></a>
</li>

<li class="{{ Request::is('imageEntities*') ? 'active' : '' }}">
    <a href="{!! route('imageEntities.index') !!}"><i class="fa fa-edit"></i><span>Image Entities</span></a>
</li>

