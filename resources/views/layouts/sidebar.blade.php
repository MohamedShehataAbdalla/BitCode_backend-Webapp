<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::user()->name }}</h4>
							<span class="mb-0 text-muted">{{ Auth::user()->email }}</span>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="slide">
						<a class="side-menu__item" href="{{ route('dashboard') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
								<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
								<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
							</svg>
                            <span class="side-menu__label">Dashboard</span></a>
					</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ route('ecommerce') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
								<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
								<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
							</svg>
                            <span class="side-menu__label">Search Products</span></a>
					</li>
					{{-- @can('الفواتير') --}}
					<li class="side-item side-item-category">Transactions</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
								<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
								<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
							</svg>
                            <span class="side-menu__label">Projects</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('invoices.create') }}">Add Project</a></li>
							{{-- @can('قائمة الفواتير') --}}
							<li><a class="slide-item" href="{{ route('invoices') }}">Projects List</a></li>
							{{-- @endcan
							@can('ارشيف الفواتير') --}}
							<li><a class="slide-item" href="{{ route('invoices.trash') }}">Projects Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
								<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
								<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
							</svg>
                            <span class="side-menu__label">Contracts</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('invoices.create') }}">Add Contract</a></li>
							{{-- @can('قائمة الفواتير') --}}
							<li><a class="slide-item" href="{{ route('invoices') }}">Contracts List</a></li>
							{{-- @endcan
							@can('ارشيف الفواتير') --}}
							<li><a class="slide-item" href="{{ route('invoices.trash') }}">Contracts Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
								<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
								<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
							</svg>
                            <span class="side-menu__label">Subscriptions</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('installments.create') }}"> Add Subscription</a></li>
							{{-- @can('قائمة الفواتير') --}}
							<li><a class="slide-item" href="{{ route('installments') }}"> Subscriptions List</a></li>
							{{-- @endcan
							@can('ارشيف الفواتير') --}}
							<li><a class="slide-item" href="{{ route('installments.trash') }}"> Subscriptions Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
							<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
						</svg>
							<span class="side-menu__label">Consultancies</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							{{-- @can('قائمة الفواتير') --}}
							<li><a class="slide-item" href="{{ route('customers') }}">Add Consultancy</a></li>
							{{-- @endcan
							@can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Consultancies List</a></li>
							{{-- @endcan --}}
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Consultancies Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
							<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
						</svg>
							<span class="side-menu__label">Requests</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							{{-- @can('قائمة الفواتير') --}}
							<li><a class="slide-item" href="{{ route('customers') }}">Add Request</a></li>
							{{-- @endcan
							@can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Requests List</a></li>
							{{-- @endcan --}}
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Requests Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
							<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
						</svg>
							<span class="side-menu__label">Meetings</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							{{-- @can('قائمة الفواتير') --}}
							<li><a class="slide-item" href="{{ route('customers') }}">Add Meeting</a></li>
							{{-- @endcan
							@can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Meetings List</a></li>
							{{-- @endcan --}}
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Meetings Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
							<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
						</svg>
							<span class="side-menu__label">Appointments</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							{{-- @can('قائمة الفواتير') --}}
							<li><a class="slide-item" href="{{ route('customers') }}">Add Appointment</a></li>
							{{-- @endcan
							@can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Appointments List</a></li>
							{{-- @endcan --}}
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Appointments Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
							<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
						</svg>
							<span class="side-menu__label">Contacts</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							{{-- @can('قائمة الفواتير') --}}
							<li><a class="slide-item" href="{{ route('customers') }}">Add Contact</a></li>
							{{-- @endcan
							@can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Contacts List</a></li>
							{{-- @endcan --}}
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Contacts Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>

					<li class="side-item side-item-category"> Basic Data</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
							<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
						</svg>
							<span class="side-menu__label">Customers</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Customers List</a></li>
							{{-- @endcan --}}
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Customers Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
							<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
						</svg>
							<span class="side-menu__label">Companies</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Companies List</a></li>
							{{-- @endcan --}}
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Companies Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
							<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
						</svg>
							<span class="side-menu__label">Services</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Services List</a></li>
							{{-- @endcan --}}
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Services Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
							<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
						</svg>
							<span class="side-menu__label">Categories</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Categories List</a></li>
							{{-- @endcan --}}
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Categories Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
							<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
						</svg>
							<span class="side-menu__label">Capabilities</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Capabilities List</a></li>
							{{-- @endcan --}}
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Capabilities Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
							<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
						</svg>
							<span class="side-menu__label">Development Tools</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Tools List</a></li>
							{{-- @endcan --}}
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Tools Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
							<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
						</svg>
							<span class="side-menu__label">Stages</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Stages List</a></li>
							{{-- @endcan --}}
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Stages Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
							<path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
						</svg>
							<span class="side-menu__label">Plans</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Add Plan</a></li>
							{{-- @endcan --}}
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Plans List</a></li>
							{{-- @endcan --}}
							{{-- @can('الفواتير المدفوعة') --}}
							<li><a class="slide-item" href="{{ route('customers.trash') }}"> Plans Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					{{-- @endcan
					<li class="side-item side-item-category">التقارير</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 12c0 4.08 3.06 7.44 7 7.93V4.07C7.05 4.56 4 7.92 4 12z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86zm2-15.86c1.03.13 2 .45 2.87.93H13v-.93zM13 7h5.24c.25.31.48.65.68 1H13V7zm0 3h6.74c.08.33.15.66.19 1H13v-1zm0 9.93V19h2.87c-.87.48-1.84.8-2.87.93zM18.24 17H13v-1h5.92c-.2.35-.43.69-.68 1zm1.5-3H13v-1h6.93c-.04.34-.11.67-.19 1z"/></svg><span class="side-menu__label">التقارير</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('invoice_reports') }}">تقارير الفواتير</a></li>
							<li><a class="slide-item" href="{{ route('customer_reports') }}">تقارير العملاء</a></li>
							<li><a class="slide-item" href="{{ route('employee_reports') }}">تقارير الموظفين</a></li>
							<li><a class="slide-item" href="{{ route('product_reports') }}">تقارير المنتجات</a></li>
							<li><a class="slide-item" href="{{ route('stocked_products_reports') }}">تقارير المخزون</a></li>
						</ul>
					</li>
					{{-- @can('الاعدادات') --}}
					<li class="side-item side-item-category">Settings</li>
                    <li class="slide">
						<a class="side-menu__item" href="{{ route('settings') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" >
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
                                <path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
                            </svg>
                            <span class="side-menu__label">Settings</span>
                        </a>

					</li>
					{{-- @endcan --}}
					{{-- @can('المستخدمين') --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" >
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
							<path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
						</svg>
							<span class="side-menu__label">Employees</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							{{-- @can('قائمة المستخدمين') --}}
							<li><a class="slide-item" href="{{ route('employees') }}"> Employees List</a></li>
							{{-- @endcan
							@can('صلاحيات المستخدمين') --}}
							<li><a class="slide-item" href="{{ route('employees.trash') }}"> Employees Trashed</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					{{-- @endcan --}}
					{{-- @can('المستخدمين') --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" >
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
							<path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
						</svg>
							<span class="side-menu__label">Users</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							{{-- @can('قائمة المستخدمين') --}}
							<li><a class="slide-item" href="{{ route('users') }}"> Users List</a></li>
							{{-- @endcan
							@can('صلاحيات المستخدمين') --}}
							<li><a class="slide-item" href="{{ route('users.trash') }}"> Users Trashed</a></li>
							<li><a class="slide-item" href="{{ route('roles') }}"> Permissions List</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					{{-- @endcan --}}

				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
