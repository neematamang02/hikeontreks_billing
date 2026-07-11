<div id="sideNav" class="col-auto u-sidebar-navigation-v1 u-sidebar-navigation--dark">
	<ul id="sideNavMenu" class="u-sidebar-navigation-v1-menu u-side-nav--top-level-menu g-min-height-100vh mb-0">
	<!-- Dashboards -->
	<li class="u-sidebar-navigation-v1-menu-item u-side-nav--has-sub-menu u-side-nav--top-level-menu-item u-side-nav-opened has-active">
		<a class="media u-side-nav--top-level-menu-link u-side-nav--hide-on-hidden g-px-15 g-py-12" href="#" data-hssm-target="#subMenu1">
			<span class="d-flex align-self-center g-pos-rel g-font-size-18 g-mr-18">
				<i class="hs-admin-server"></i>
			</span>
			<span class="media-body align-self-center">Ticket</span>
			<span class="d-flex align-self-center u-side-nav--control-icon">
			<i class="hs-admin-angle-right"></i>
			</span>
			<span class="u-side-nav--has-sub-menu__indicator"></span>
		</a>

		<!-- Dashboards: Submenu-1 -->
		<ul id="subMenu1" class="u-sidebar-navigation-v1-menu u-side-nav--second-level-menu mb-0" style="display: block;">
			<!-- Dashboards v1 -->
			<li class="u-sidebar-navigation-v1-menu-item u-side-nav--second-level-menu-item">
				<a class="media u-side-nav--second-level-menu-link g-px-15 g-py-12 {{ request()->is('ticket/create')?'active' : '' }}" href="{{ route('ticket.create') }}">
					<span class="d-flex align-self-center g-mr-15 g-mt-minus-1">
					<i class="hs-admin-infinite"></i>
					</span>
					<span class="media-body align-self-center">Create Ticket</span>
				</a>
			</li>
			<!-- End Dashboards v1 -->

			<!-- Dashboards v2 -->
			<li class="u-sidebar-navigation-v1-menu-item u-side-nav--second-level-menu-item">
				<a class="media u-side-nav--second-level-menu-link g-px-15 g-py-12 {{ request()->is('ticket')?'active' : '' }}" href="{{ route('ticket.index') }}">
					<span class="d-flex align-self-center g-mr-15 g-mt-minus-1">
					<i class="hs-admin-blackboard"></i>
					</span>
					<span class="media-body align-self-center">View Tickets</span>
				</a>
			</li>
			<!-- End Dashboards v2 -->
		</ul>
		<!-- End Dashboards: Submenu-1 -->
	</li>
	@if (Auth::user()->can('add-users'))
	<li class="u-sidebar-navigation-v1-menu-item u-side-nav--has-sub-menu u-side-nav--top-level-menu-item u-side-nav-opened has-active">
		<a class="media u-side-nav--top-level-menu-link u-side-nav--hide-on-hidden g-px-15 g-py-12" href="#" data-hssm-target="#subMenu1_user">
			<span class="d-flex align-self-center g-pos-rel g-font-size-18 g-mr-18">
				<i class="fa fa-users"></i>
			</span>
			<span class="media-body align-self-center">User</span>
			<span class="d-flex align-self-center u-side-nav--control-icon">
			<i class="hs-admin-angle-right"></i>
			</span>
			<span class="u-side-nav--has-sub-menu__indicator"></span>
		</a>

		<!-- Dashboards: Submenu-1 -->
		
			<ul id="subMenu1_user" class="u-sidebar-navigation-v1-menu u-side-nav--second-level-menu mb-0" style="display: block;">
				<!-- Dashboards v1 -->
				<li class="u-sidebar-navigation-v1-menu-item u-side-nav--second-level-menu-item">
					<a class="media u-side-nav--second-level-menu-link g-px-15 g-py-12 " href="{{ route('user.create') }}">
						<span class="d-flex align-self-center g-mr-15 g-mt-minus-1">
						<i class="fa fa-plus-circle"></i>
						</span>
						<span class="media-body align-self-center">Create User</span>
					</a>
				</li>
				<!-- End Dashboards v1 -->

				<!-- Dashboards v2 -->
				<li class="u-sidebar-navigation-v1-menu-item u-side-nav--second-level-menu-item">
					<a class="media u-side-nav--second-level-menu-link g-px-15 g-py-12 " href="{{ route('user.index') }}">
						<span class="d-flex align-self-center g-mr-15 g-mt-minus-1">
						<i class="fa fa-list"></i>
						</span>
						<span class="media-body align-self-center">User List </span>
					</a>
				</li>
				<!-- End Dashboards v2 -->
			</ul>
		<!-- End Dashboards: Submenu-1 -->
	</li>
	@endif

	<!-- End Dashboards -->

	</ul>
</div>
<!-- End Sidebar Nav -->