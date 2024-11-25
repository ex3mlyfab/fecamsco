<header class="main-nav">
    <div class="sidebar-user text-center">
        <img class="img-90 rounded-circle" src="{{  (auth()->user()->member()->exists()) ? asset(user_avatar(auth()->user()->member->avatar)) : asset('femcas-logo.png') }}" alt="" />
        <div class="badge-bottom">
            <x-badge :user="auth()->user()"></x-badge>
        </div>
        <a href="user-profile">
            <h6 class="mt-3 f-14 f-w-600">{{ auth()->user()->last_name . ' ' . auth()->user()->first_name }}</h6>
        </a>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Dashboard</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/dashboard') }}" href="javascript:void(0)"><i
                                data-feather="home"></i><span>Dashboard</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/dashboard') }};">
                            <li><a href="{{ route('home') }}" class="{{ routeActive('home') }}">Home</a></li>

                            <li><a href="{{  auth()->user()->member_status ? route('self-update.create') : route('member-register')  }}"
                                    class="{{ auth()->user()->member_status ? routeActive('self-update.create'):routeActive('member-register') }}">Membership</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/member-savings') }}" href="javascript:void(0)"><i
                                data-feather="database"></i><span>Savings</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/member-savings') }};">
                            <li><a href="{{ route('self-deposit.all', auth()->user()->id) }}" class="{{ routeActive('self-deposit.all') }}">My Savings Details</a>
                            </li>
                            <li><a href="{{ route('contributions.update', auth()->user()->id) }}" class="{{ routeActive('contributions.update') }}">My Monthly  Contribution</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/member-loans') }}" href="javascript:void(0)"><i
                                data-feather="credit-card"></i><span>Loans</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/member-loans') }};">
                            <li><a href="{{ route('self-loan.all', auth()->user()->id) }}" class="{{ routeActive('self-loan.all') }}">My Loan Details</a>
                            </li>
                            <li><a href="{{ route('self-loan.apply') }}" class="{{ routeActive('self-loan.apply') }}">Apply for Loan</a>
                            </li>

                        </ul>
                    </li>
                    @if (auth()->user()->roles()->exists())


                    <li class="sidebar-main-title">
                        <div>
                            <h6>Admin</h6>
                        </div>
                    </li>
                    @can('view-all-member')
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/admin') }}" href="javascript:void(0)"><i
                                data-feather="users"></i><span>Users</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/admin') }};">

                           <li>
                               <a href="{{ route('all.users') }}" class="{{ routeActive('all.users') }}">All
                                    Users</a>
                            </li>



                            <li><a href="{{route('members.list')}}" class="{{ routeActive('members.list') }}">Registered Users</a></li>

                        </ul>
                    </li> @endcan
                    @can('view-deposit')
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/savings') }}" href="javascript:void(0)"><i
                            class="icofont icofont-deal"></i><span>&nbsp;&nbsp;Savings</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/savings') }};">
                            <li><a href="{{ route('savings.all') }}" class="{{ routeActive('savings.all') }}">All
                                    Savings</a></li>


                        </ul>
                    </li>
                    @endcan


                    @can('view-loan')


                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/loans') }}" href="javascript:void(0)"><i
                            class="icofont icofont-growth"></i><span>&nbsp;&nbsp;Loans</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/loans') }};">
                            <li><a href="{{ route('all.loans') }}" class="{{ routeActive('all.loans') }}">All
                            <li><a href="{{ route('loan.apply') }}" class="{{ routeActive('loan.apply') }}">Apply for
                                    Loans</a></li>
                            <li><a href="{{ route('pending.loan') }}" class="{{ routeActive('pending.loan') }}">Approve Loans</a></li>


                        </ul>
                    </li>
                    @endcan
                    @can('view-deposit')
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/office') }}" href="javascript:void(0)"><i
                            class="icofont icofont-bank-alt"></i><span>&nbsp;&nbsp;Administration</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/office') }};">
                            <li><a href="{{ route('deposit.home') }}" class="{{ routeActive('deposit.home') }}">All
                                    CTSS Upload</a></li>
                            <li><a href="{{ route('ctls.home') }}" class="{{ routeActive('ctls.home') }}">All
                                    CTLS Upload</a></li>
                            <li><a href="{{ route('account-number') }}" class="{{ routeActive('account-number') }}">Bank Details</a></li>
                            <li><a href="{{ route('bankmandate.all') }}" class="{{ routeActive('bankmandate.all') }}">Bank Mandates
                            </a></li>
                            <li><a href="{{ route('bankmandatebatch.all') }}" class="{{ routeActive('bankmandatebatch.all') }}">Bank Mandates Batch
                            </a></li>

                            <li><a href="{{ route('loanplan.home') }}" class="{{ routeActive('loanplan.home') }}">All Transactions</a></li>
                            <li><a href="{{ route('add.user') }}" class="{{ routeActive('add.user') }}">Add New Member</a></li>


                        </ul>
                    </li>
                    @endcan
                    @can ('view-all-product')
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/shops') }}" href="javascript:void(0)"><i
                            class="fa fa-columns"></i><span> &nbsp;&nbsp;Goods/Services</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/shop') }};">
                            <li><a href="{{ route('product.all') }}" class="{{ routeActive('product.all') }}">All Product List</a></li>
                            <li><a href="{{ route('product.category') }}" class="{{ routeActive('product.category') }}">All
                                    Product Categories</a></li>
                            <li><a href="{{ route('product.create') }}" class="{{ routeActive('product.create') }}">Create New product</a></li>
                            <li><a href="{{ route('supplier.create') }}" class="{{ routeActive('supplier.create') }}">Create Supplier</a></li>
                            <li><a href="{{ route('supplier.all') }}" class="{{ routeActive('supplier.all') }}">All Suppliers</a></li>
                            <li><a href="{{ route('purchase-order.ceate') }}" class="{{ routeActive('purchase-order.ceate') }}">Create Purchase Order</a></li>
                            <li><a href="{{ route('purchase-order.all') }}" class="{{ routeActive('purchase-order.all') }}">All Purchase Orders</a></li>
                            <li><a href="{{ route('receive-order.all') }}" class="{{ routeActive('receive-order.all') }}">All Receive Orders</a></li>



                        </ul>
                    </li>
                    @endcan
                    @can('create-role')


                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/settings') }}" href="javascript:void(0)"><i
                                data-feather="paperclip"></i><span>App Settings</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/settings') }};">
                            <li><a href="{{ route('role.create') }}" class="{{ routeActive('role.create') }}">All
                                   Roles</a></li>
                            <li><a href="{{ route('permission.create') }}" class="{{ routeActive('permission.create') }}">Permissions</a></li>
                            <li><a href="{{ route('role.assign') }}" class="{{ routeActive('role.assign') }}">Assign Role to User</a></li>



                        </ul>
                    </li>
                    @endcan
                    @endif

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
</header>
