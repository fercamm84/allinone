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

<li class="{{ Request::is('imageCategories*') ? 'active' : '' }}">
    <a href="{!! route('imageCategories.index') !!}"><i class="fa fa-edit"></i><span>Image Categories</span></a>
</li>

<li class="{{ Request::is('imageProducts*') ? 'active' : '' }}">
    <a href="{!! route('imageProducts.index') !!}"><i class="fa fa-edit"></i><span>Image Products</span></a>
</li>

<li class="{{ Request::is('sections*') ? 'active' : '' }}">
    <a href="{!! route('sections.index') !!}"><i class="fa fa-edit"></i><span>Sections</span></a>
</li>

<li class="{{ Request::is('sectionCategories*') ? 'active' : '' }}">
    <a href="{!! route('sectionCategories.index') !!}"><i class="fa fa-edit"></i><span>Section Categories</span></a>
</li>

<li class="{{ Request::is('sectionProducts*') ? 'active' : '' }}">
    <a href="{!! route('sectionProducts.index') !!}"><i class="fa fa-edit"></i><span>Section Products</span></a>
</li>

<li class="{{ Request::is('payments*') ? 'active' : '' }}">
    <a href="{!! route('payments.index') !!}"><i class="fa fa-edit"></i><span>Payments</span></a>
</li>

