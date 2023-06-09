@php
    $setting = DB::table('settings')->first();   
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.home')}}" class="brand-link">
        <img src="" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> {{ Auth::user()->name }} </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                @if (Auth::user()->category==1)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Category
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('category.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('subcategory.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('childcategory.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Child Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('brand.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Brand</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('warehouse.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Warehouse</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                
                @if(Auth::user()->product==1)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Product
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('product.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('product.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(Auth::user()->offer==1)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Offer<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('cupon.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cupon</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('campaign.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>E Campaign</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->order==1)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Orders<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.order.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->blog==1)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Blogs<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.blog.category')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.blog.category')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Blogs</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->pickup==1)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Pickup Point<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('pickuppoint.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pickup Point</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->ticket==1)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Ticket<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('ticket.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ticket</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->contact==1)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Contact Message<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('ticket.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Message</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->report==0)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Reports<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('report.order.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Order Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customer Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stock Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ticket Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->setting==1)
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('seo.setting')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SEO Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('website.setting')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Website Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('page.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Page Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('smtp.setting')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SMTP Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('payment.gateway')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payment Gateway</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                
                @if(Auth::user()->userrole==1)
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            User Role
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('create.role')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('manage.role')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Role</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                
                <li class="nav-header">
                    Profile
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.password.change') }}" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Change Password</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Logout</p>
                    </a>
                </li>
            </ul>
            
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
