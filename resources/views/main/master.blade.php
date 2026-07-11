	<!DOCTYPE html>
	<html lang="en">

	<head>
	<!-- Title -->
	<title>HikeOnTreks | Billing</title>

	<!-- Required Meta Tags Always Come First -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<!-- Favicon -->
	<link rel="shortcut icon" href="../../favicon.ico">
	<!-- Google Fonts -->
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans%3A400%2C300%2C500%2C600%2C700%7CPlayfair+Display%7CRoboto%7CRaleway%7CSpectral%7CRubik">
	<!-- CSS Global Compulsory -->
	<link rel="stylesheet" href="/assets/vendor/bootstrap/bootstrap.min.css">
	<!-- CSS Global Icons -->
	<link rel="stylesheet" href="/assets/vendor/icon-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/assets/vendor/icon-line/css/simple-line-icons.css">
	<link rel="stylesheet" href="/assets/vendor/icon-etlinefont/style.css">
	<link rel="stylesheet" href="/assets/vendor/icon-line-pro/style.css">
	<link rel="stylesheet" href="/assets/vendor/icon-hs/style.css">

	<link rel="stylesheet" href="/assets/assets/vendor/hs-admin-icons/hs-admin-icons.css">

	<link rel="stylesheet" href="/assets/vendor/animate.css">
	<link rel="stylesheet" href="/assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.min.css">

	<link rel="stylesheet" href="/assets/assets/vendor/flatpickr/dist/css/flatpickr.min.css">
	<link rel="stylesheet" href="/assets/assets/vendor/bootstrap-select/css/bootstrap-select.min.css">

	<link rel="stylesheet" href="/assets/assets/vendor/chartist-js/chartist.min.css">
	<link rel="stylesheet" href="/assets/assets/vendor/chartist-js-tooltip/chartist-plugin-tooltip.css">
	<link rel="stylesheet" href="/assets/vendor/fancybox/jquery.fancybox.min.css">

	 <link rel="stylesheet" href="/assets/assets/vendor/bootstrap-tagsinput/css/bootstrap-tagsinput.css">

	<link rel="stylesheet" href="/assets/vendor/hamburgers/hamburgers.min.css">

	<!-- CSS Unify -->
	<link rel="stylesheet" href="/assets/assets/css/unify-admin.css">

	<!-- CSS Customization -->
	<link rel="stylesheet" href="/assets/css/custom.css">
	</head>

	<body>
	<!-- Header -->
	<header id="js-header" class="u-header u-header--sticky-top">
		<div class="u-header__section u-header__section--admin-dark g-min-height-65">
		<nav class="navbar no-gutters g-pa-0">
			<div class="col-auto d-flex flex-nowrap u-header-logo-toggler g-py-12">
			<!-- Logo -->
			<a href="/" class="navbar-brand d-flex align-self-center g-hidden-xs-down g-line-height-1 py-0 g-mt-5">
				HikeOnTreks
			</a>
			<!-- End Logo -->

			<!-- Sidebar Toggler -->
			<a class="js-side-nav u-header__nav-toggler d-flex align-self-center ml-auto" href="#" data-hssm-class="u-side-nav--mini u-sidebar-navigation-v1--mini" data-hssm-body-class="u-side-nav-mini" data-hssm-is-close-all-except-this="true" data-hssm-target="#sideNav">
				<i class="hs-admin-align-left"></i>
			</a>
			<!-- End Sidebar Toggler -->
			</div>

			<!-- Top Search Bar -->
			{{-- <form id="searchMenu" class="u-header--search col-sm g-py-12 g-ml-15--sm g-ml-20--md g-mr-10--sm" aria-labelledby="searchInvoker" action="#!">
			<div class="input-group g-max-width-450--sm">
				<input class="form-control h-100 form-control-md g-rounded-4 g-pr-40" type="text" placeholder="Enter search keywords">
				<button type="submit" class="btn u-btn-outline-primary g-brd-none g-bg-transparent--hover g-pos-abs g-top-0 g-right-0 d-flex g-width-40 h-100 align-items-center justify-content-center g-font-size-18 g-z-index-2"><i class="hs-admin-search"></i>
				</button>
			</div>
			</form> --}}
			<!-- End Top Search Bar -->

			<!-- Messages/Notifications/Top Search Bar/Top User -->
			<div class="col-auto d-flex g-py-12 g-pl-40--lg ml-auto">
			

			
			

			

			<!-- Top User -->
			<div class="col-auto d-flex g-pt-5 g-pt-0--sm g-pl-10 g-pl-20--sm">
				<div class="g-pos-rel g-px-10--lg">
					<a id="profileMenuInvoker" class="d-block" href="#" aria-controls="profileMenu " aria-haspopup="true" aria-expanded="false" data-dropdown-event="click" data-dropdown-target="#profileMenu" data-dropdown-type="css-animation" data-dropdown-duration="300"
					data-dropdown-animation-in="fadeIn" data-dropdown-animation-out="fadeOut">
						<span class="g-pos-rel">
							<span class="u-badge-v2--xs u-badge--top-right g-hidden-sm-up g-bg-secondary g-mr-5"></span>
							<img class="g-width-30 g-width-40--md g-height-30 g-height-40--md rounded-circle g-mr-10--sm" src="/assets/assets/img-temp/130x130/img1.jpg" alt="Image description">
						</span>
						<span class="g-pos-rel g-top-2">
							<span class="g-hidden-sm-down">{{ auth()->user()->name }}</span>
							<i class="hs-admin-angle-down g-pos-rel g-top-2 g-ml-10"></i>
						</span>
					</a>

				<!-- Top User Menu -->
				<ul id="profileMenu" class="g-pos-abs g-left-0 g-width-100x--lg g-nowrap g-font-size-14 g-py-20 g-mt-17 rounded" aria-labelledby="profileMenuInvoker">
					<li class="mb-0">
						<a class="media g-color-primary--hover g-py-5 g-px-20" href="#">
							<span class="d-flex align-self-center g-mr-12">
								<i class="hs-admin-shift-right"></i>
							</span>
							<span class="media-body align-self-center logout_button">Sign Out</span>
						</a>
						<a class="media g-color-primary--hover g-py-5 g-px-20" href="{{route('change-password')}}">
							<span class="d-flex align-self-center g-mr-12">
								<i class="fa fa-key"></i>
							</span>
							<span class="media-body align-self-center ">Change Passowrd</span>
						<a class="media g-color-primary--hover g-py-5 g-px-20" href="{{route('ticket_activity_log')}}">
							<span class="d-flex align-self-center g-mr-12">
								<i class="fa fa-history"></i>
							</span>
							<span class="media-body align-self-center ">Activity Log</span>

						</a>
					</li>
				</ul>

				{{-- <ul id="changePassword" class="g-pos-abs g-left-0 g-width-100x--lg g-nowrap g-font-size-14 g-py-20 g-mt-17 rounded" aria-labelledby="profileMenuInvoker">
					<li class="mb-0">
						<a class="media g-color-primary--hover g-py-5 g-px-20" href="#">
							<span class="d-flex align-self-center g-mr-12">
								<i class="hs-admin-shift-right"></i>
							</span>
							<span class="media-body align-self-center logout_button">Sign Out</span>
						</a>
					</li>
				</ul> --}}

				

	

				
				<!-- End Top User Menu -->
				</div>
			</div>
			<!-- End Top User -->
			</div>
			<!-- End Messages/Notifications/Top Search Bar/Top User -->

			
		</nav>
		<form method="POST" action="{{ route('logout') }}" id="logout_form">
			@csrf
		</form>

		<!-- Top Activity Panel -->
		<div id="activityMenu" class="js-custom-scroll u-header-sidebar g-pos-fix g-top-0 g-left-auto g-right-0 g-z-index-4 g-width-300 g-width-400--sm g-height-100vh" aria-labelledby="activityInvoker">
			<div class="u-header-dropdown-bordered-v1 g-pa-20">
			<a id="activityInvokerClose" class="pull-right g-color-lightblue-v2" href="#" aria-controls="activityMenu" aria-haspopup="true" aria-expanded="false" data-dropdown-event="click" data-dropdown-target="#activityMenu" data-dropdown-type="css-animation" data-dropdown-animation-in="fadeInRight"
			data-dropdown-animation-out="fadeOutRight" data-dropdown-duration="300">
				<i class="hs-admin-close"></i>
			</a>
			<h4 class="text-uppercase g-font-size-default g-letter-spacing-0_5 g-mr-20 g-mb-0">Activity</h4>
			</div>

			<!-- Activity Short Stat. -->
			<section class="g-pa-20">
			<div class="media align-items-center u-link-v5 g-color-white">
				<div class="media-body align-self-center g-line-height-1_3 g-font-weight-300 g-font-size-40">
				624 <span class="g-font-size-16">+3%</span>
				</div>

				<div class="d-flex align-self-center g-font-size-25 g-line-height-1 g-color-secondary ml-auto">$49,000</div>

				<div class="d-flex align-self-center g-ml-8">
				<svg class="g-fill-white-opacity-0_5" width="12px" height="20px" viewBox="0 0 12 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<g transform="translate(-21.000000, -751.000000)">
					<g transform="translate(0.000000, 64.000000)">
						<g transform="translate(20.000000, 619.000000)">
						<g transform="translate(1.000000, 68.000000)">
							<polygon points="6 20 0 13.9709049 0.576828937 13.3911999 5.59205874 18.430615 5.59205874 0 6.40794126 0 6.40794126 18.430615 11.4223552 13.3911999 12 13.9709049"></polygon>
						</g>
						</g>
					</g>
					</g>
				</svg>
				<svg class="g-fill-lightblue-v3" width="12px" height="20px" viewBox="0 0 12 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<g transform="translate(-33.000000, -751.000000)">
					<g transform="translate(0.000000, 64.000000)">
						<g transform="translate(20.000000, 619.000000)">
						<g transform="translate(1.000000, 68.000000)">
							<polygon transform="translate(18.000000, 10.000000) scale(1, -1) translate(-18.000000, -10.000000)" points="18 20 12 13.9709049 12.5768289 13.3911999 17.5920587 18.430615 17.5920587 0 18.4079413 0 18.4079413 18.430615 23.4223552 13.3911999 24 13.9709049"></polygon>
						</g>
						</g>
					</g>
					</g>
				</svg>
				</div>
			</div>

			<span class="g-font-size-16">Transactions</span>
			</section>
			<!-- End Activity Short Stat. -->

			<!-- Activity Bars -->
			<section class="g-pa-20 g-mb-10">
			<!-- Advertising Income -->
			<div class="g-mb-30">
				<div class="media u-link-v5  g-color-white g-mb-10">
				<span class="media-body align-self-center">Advertising Income</span>

				<span class="d-flex align-self-center">
			<svg class="g-fill-white-opacity-0_5" width="12px" height="20px" viewBox="0 0 12 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<g transform="translate(-21.000000, -751.000000)">
				<g transform="translate(0.000000, 64.000000)">
					<g transform="translate(20.000000, 619.000000)">
					<g transform="translate(1.000000, 68.000000)">
						<polygon points="6 20 0 13.9709049 0.576828937 13.3911999 5.59205874 18.430615 5.59205874 0 6.40794126 0 6.40794126 18.430615 11.4223552 13.3911999 12 13.9709049"></polygon>
					</g>
					</g>
				</g>
				</g>
			</svg>
			<svg class="g-fill-lightblue-v3" width="12px" height="20px" viewBox="0 0 12 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<g transform="translate(-33.000000, -751.000000)">
				<g transform="translate(0.000000, 64.000000)">
					<g transform="translate(20.000000, 619.000000)">
					<g transform="translate(1.000000, 68.000000)">
						<polygon transform="translate(18.000000, 10.000000) scale(1, -1) translate(-18.000000, -10.000000)" points="18 20 12 13.9709049 12.5768289 13.3911999 17.5920587 18.430615 17.5920587 0 18.4079413 0 18.4079413 18.430615 23.4223552 13.3911999 24 13.9709049"></polygon>
					</g>
					</g>
				</g>
				</g>
			</svg>
			</span>
				</div>

				<div class="progress g-height-4 g-bg-gray-light-v8 g-rounded-2">
				<div class="progress-bar g-bg-teal-v2 g-rounded-2" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
			<!-- End Advertising Income -->

			<!-- Projects Income -->
			<div class="g-mb-30">
				<div class="media u-link-v5  g-color-white g-mb-10">
				<span class="media-body align-self-center">Projects Income</span>
				<span class="d-flex align-self-center">
			<svg class="g-fill-red" width="12px" height="20px" viewBox="0 0 12 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<g transform="translate(-21.000000, -751.000000)">
				<g transform="translate(0.000000, 64.000000)">
					<g transform="translate(20.000000, 619.000000)">
					<g transform="translate(1.000000, 68.000000)">
						<polygon points="6 20 0 13.9709049 0.576828937 13.3911999 5.59205874 18.430615 5.59205874 0 6.40794126 0 6.40794126 18.430615 11.4223552 13.3911999 12 13.9709049"></polygon>
					</g>
					</g>
				</g>
				</g>
			</svg>
			<svg class="g-fill-white-opacity-0_5" width="12px" height="20px" viewBox="0 0 12 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<g transform="translate(-33.000000, -751.000000)">
				<g transform="translate(0.000000, 64.000000)">
					<g transform="translate(20.000000, 619.000000)">
					<g transform="translate(1.000000, 68.000000)">
						<polygon transform="translate(18.000000, 10.000000) scale(1, -1) translate(-18.000000, -10.000000)" points="18 20 12 13.9709049 12.5768289 13.3911999 17.5920587 18.430615 17.5920587 0 18.4079413 0 18.4079413 18.430615 23.4223552 13.3911999 24 13.9709049"></polygon>
					</g>
					</g>
				</g>
				</g>
			</svg>
			</span>
				</div>

				<div class="progress g-height-4 g-bg-gray-light-v8 g-rounded-2">
				<div class="progress-bar g-bg-lightblue-v3 g-rounded-2" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
			<!-- End Projects Income -->

			<!-- Template Sales -->
			<div>
				<div class="media u-link-v5  g-color-white g-mb-10">
				<span class="media-body align-self-center">Template Sales</span>
				<span class="d-flex align-self-center">
			<svg class="g-fill-white-opacity-0_5" width="12px" height="20px" viewBox="0 0 12 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<g transform="translate(-21.000000, -751.000000)">
				<g transform="translate(0.000000, 64.000000)">
					<g transform="translate(20.000000, 619.000000)">
					<g transform="translate(1.000000, 68.000000)">
						<polygon points="6 20 0 13.9709049 0.576828937 13.3911999 5.59205874 18.430615 5.59205874 0 6.40794126 0 6.40794126 18.430615 11.4223552 13.3911999 12 13.9709049"></polygon>
					</g>
					</g>
				</g>
				</g>
			</svg>
			<svg class="g-fill-lightblue-v3" width="12px" height="20px" viewBox="0 0 12 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<g transform="translate(-33.000000, -751.000000)">
				<g transform="translate(0.000000, 64.000000)">
					<g transform="translate(20.000000, 619.000000)">
					<g transform="translate(1.000000, 68.000000)">
						<polygon transform="translate(18.000000, 10.000000) scale(1, -1) translate(-18.000000, -10.000000)" points="18 20 12 13.9709049 12.5768289 13.3911999 17.5920587 18.430615 17.5920587 0 18.4079413 0 18.4079413 18.430615 23.4223552 13.3911999 24 13.9709049"></polygon>
					</g>
					</g>
				</g>
				</g>
			</svg>
			</span>
				</div>

				<div class="progress g-height-4 g-bg-gray-light-v8 g-rounded-2">
				<div class="progress-bar g-bg-darkblue-v2 g-rounded-2" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
			<!-- End Template Sales -->
			</section>
			<!-- End Activity Bars -->

			<!-- Activity Accounts -->
			<section class="g-pa-20">
			<h5 class="text-uppercase g-font-size-default g-letter-spacing-0_5 g-mb-10">My accounts</h5>

			<div class="media u-header-dropdown-bordered-v2 g-py-10">
				<div class="d-flex align-self-center g-mr-12">
				<span class="u-badge-v2--sm g-pos-stc g-transform-origin--top-left g-bg-teal-v2"></span>
				</div>

				<div class="media-body align-self-center">Credit Card</div>

				<div class="d-flex text-right">$12.240</div>
			</div>

			<div class="media u-header-dropdown-bordered-v2 g-py-10">
				<div class="d-flex align-self-center g-mr-12">
				<span class="u-badge-v2--sm g-pos-stc g-transform-origin--top-left g-bg-lightblue-v3"></span>
				</div>

				<div class="media-body align-self-center">Debit Card</div>

				<div class="d-flex text-right">$228.110</div>
			</div>

			<div class="media g-py-10">
				<div class="d-flex align-self-center g-mr-12">
				<span class="u-badge-v2--sm g-pos-stc g-transform-origin--top-left g-bg-darkblue-v2"></span>
				</div>

				<div class="media-body align-self-center">Savings Account</div>

				<div class="d-flex text-right">$128.248.000</div>
			</div>
			</section>
			<!-- End Activity Accounts -->

			<!-- Activity Transactions -->
			<section class="g-pa-20">
			<h5 class="text-uppercase g-font-size-default g-letter-spacing-0_5 g-mb-10">Transactions</h5>

			<!-- Transaction Item -->
			<div class="u-header-dropdown-bordered-v2 g-py-20">
				<div class="media g-pos-rel">
				<div class="d-flex align-self-start g-pt-3 g-mr-12">
					<i class="hs-admin-plus g-color-lightblue-v3"></i>
				</div>

				<div class="media-body align-self-start">
					<strong class="d-block g-font-size-17 g-font-weight-400 g-line-height-1">$240.00</strong>
					<p class="mb-0 g-mt-5">Addiction When Gambling Becomes</p>
				</div>

				<em class="d-flex align-items-center g-pos-abs g-top-0 g-right-0 g-font-style-normal g-color-lightblue-v2">
			<i class="hs-admin-time icon-clock g-font-size-default g-mr-8"></i> <small>5 Min ago</small>
			</em>
				</div>
			</div>
			<!-- End Transaction Item -->

			<!-- Transaction Item -->
			<div class="u-header-dropdown-bordered-v2 g-py-20">
				<div class="media g-pos-rel">
				<div class="d-flex align-self-start g-pt-3 g-mr-12">
					<i class="hs-admin-minus g-color-red"></i>
				</div>

				<div class="media-body align-self-start">
					<strong class="d-block g-font-size-17 g-font-weight-400 g-line-height-1">$126.00</strong>
					<p class="mb-0 g-mt-5">Make Myspace Your</p>
				</div>

				<em class="d-flex align-items-center g-pos-abs g-top-0 g-right-0 g-font-style-normal g-color-lightblue-v2">
			<i class="hs-admin-time icon-clock g-font-size-default g-mr-8"></i> <small>25 Nov 2017</small>
			</em>
				</div>
			</div>
			<!-- End Transaction Item -->

			<!-- Transaction Item -->
			<div class="u-header-dropdown-bordered-v2 g-py-20">
				<div class="media g-pos-rel">
				<div class="d-flex align-self-start g-pt-3 g-mr-12">
					<i class="hs-admin-plus g-color-lightblue-v3"></i>
				</div>

				<div class="media-body align-self-start">
					<strong class="d-block g-font-size-17 g-font-weight-400 g-line-height-1">$560.00</strong>
					<p class="mb-0 g-mt-5">Writing A Good Headline</p>
				</div>

				<em class="d-flex align-items-center g-pos-abs g-top-0 g-right-0 g-font-style-normal g-color-lightblue-v2">
			<i class="hs-admin-time icon-clock g-font-size-default g-mr-8"></i> <small>22 Nov 2017</small>
			</em>
				</div>
			</div>
			<!-- End Transaction Item -->

			<!-- Transaction Item -->
			<div class="u-header-dropdown-bordered-v2 g-py-20">
				<div class="media g-pos-rel">
				<div class="d-flex align-self-start g-pt-3 g-mr-12">
					<i class="hs-admin-plus g-color-lightblue-v3"></i>
				</div>

				<div class="media-body align-self-start">
					<strong class="d-block g-font-size-17 g-font-weight-400 g-line-height-1">$6.00</strong>
					<p class="mb-0 g-mt-5">Buying Used Electronic Equipment</p>
				</div>

				<em class="d-flex align-items-center g-pos-abs g-top-0 g-right-0 g-font-style-normal g-color-lightblue-v2">
			<i class="hs-admin-time icon-clock g-font-size-default g-mr-8"></i> <small>13 Oct 2017</small>
			</em>
				</div>
			</div>
			<!-- End Transaction Item -->

			<!-- Transaction Item -->
			<div class="u-header-dropdown-bordered-v2 g-py-20">
				<div class="media g-pos-rel">
				<div class="d-flex align-self-start g-pt-3 g-mr-12">
					<i class="hs-admin-plus g-color-lightblue-v3"></i>
				</div>

				<div class="media-body align-self-start">
					<strong class="d-block g-font-size-17 g-font-weight-400 g-line-height-1">$320.00</strong>
					<p class="mb-0 g-mt-5">Gambling Becomes A Problem</p>
				</div>

				<em class="d-flex align-items-center g-pos-abs g-top-0 g-right-0 g-font-style-normal g-color-lightblue-v2">
			<i class="hs-admin-time icon-clock g-font-size-default g-mr-8"></i> <small>27 Jul 2017</small>
			</em>
				</div>
			</div>
			<!-- End Transaction Item -->

			<!-- Transaction Item -->
			<div class="u-header-dropdown-bordered-v2 g-py-20">
				<div class="media g-pos-rel">
				<div class="d-flex align-self-start g-pt-3 g-mr-12">
					<i class="hs-admin-minus g-color-red"></i>
				</div>

				<div class="media-body align-self-start">
					<strong class="d-block g-font-size-17 g-font-weight-400 g-line-height-1">$28.00</strong>
					<p class="mb-0 g-mt-5">Baby Monitor Technology</p>
				</div>

				<em class="d-flex align-items-center g-pos-abs g-top-0 g-right-0 g-font-style-normal g-color-lightblue-v2">
			<i class="hs-admin-time icon-clock g-font-size-default g-mr-8"></i> <small>05 Mar 2017</small>
			</em>
				</div>
			</div>
			<!-- End Transaction Item -->

			<!-- Transaction Item -->
			<div class="u-header-dropdown-bordered-v2 g-py-20">
				<div class="media g-pos-rel">
				<div class="d-flex align-self-start g-pt-3 g-mr-12">
					<i class="hs-admin-plus g-color-lightblue-v3"></i>
				</div>

				<div class="media-body align-self-start">
					<strong class="d-block g-font-size-17 g-font-weight-400 g-line-height-1">$490.00</strong>
					<p class="mb-0 g-mt-5">Adwords Keyword Research For Beginners</p>
				</div>

				<em class="d-flex align-items-center g-pos-abs g-top-0 g-right-0 text-uppercase g-font-size-11 g-letter-spacing-0_5 g-font-style-normal g-color-lightblue-v2">
			<i class="hs-admin-time icon-clock g-font-size-default g-mr-8"></i> 09 Feb 2017
			</em>
				</div>
			</div>
			<!-- End Transaction Item -->

			<!-- Transaction Item -->
			<div class="u-header-dropdown-bordered-v2 g-py-20">
				<div class="media g-pos-rel">
				<div class="d-flex align-self-start g-pt-3 g-mr-12">
					<i class="hs-admin-minus g-color-red"></i>
				</div>

				<div class="media-body align-self-start">
					<strong class="d-block g-font-size-17 g-font-weight-400 g-line-height-1">$14.20</strong>
					<p class="mb-0 g-mt-5">A Good Autoresponder</p>
				</div>

				<em class="d-flex align-items-center g-pos-abs g-top-0 g-right-0 text-uppercase g-font-size-11 g-letter-spacing-0_5 g-font-style-normal g-color-lightblue-v2">
			<i class="hs-admin-time icon-clock g-font-size-default g-mr-8"></i> 09 Feb 2017
			</em>
				</div>
			</div>
			<!-- End Transaction Item -->
			</section>
			<!-- End Activity Transactions -->
		</div>
		<!-- End Top Activity Panel -->

		</div>
	</header>
	<!-- End Header -->


	<main class="container-fluid px-0 g-pt-65">
		<div class="row no-gutters g-pos-rel g-overflow-x-hidden">
		@include('main.sidebar_nav')
		

		@yield('main-section')
		
		
		</div>
	</main>

	<!-- JS Global Compulsory -->
	<script src="/assets/assets/vendor/jquery/jquery.min.js"></script>
	<script src="/assets/assets/vendor/jquery-migrate/jquery-migrate.min.js"></script>

	<script src="/assets/vendor/popper.js/popper.min.js"></script>
	<script src="/assets/vendor/bootstrap/bootstrap.min.js"></script>

	<script src="/assets/vendor/cookiejs/jquery.cookie.js"></script>


	<!-- jQuery UI Core -->
	<script src="/assets/vendor/jquery-ui/ui/widget.js"></script>
	<script src="/assets/vendor/jquery-ui/ui/version.js"></script>
	<script src="/assets/vendor/jquery-ui/ui/keycode.js"></script>
	<script src="/assets/vendor/jquery-ui/ui/position.js"></script>
	<script src="/assets/vendor/jquery-ui/ui/unique-id.js"></script>
	<script src="/assets/vendor/jquery-ui/ui/safe-active-element.js"></script>

	<!-- jQuery UI Helpers -->
	<script src="/assets/vendor/jquery-ui/ui/widgets/menu.js"></script>
	<script src="/assets/vendor/jquery-ui/ui/widgets/mouse.js"></script>

	<!-- jQuery UI Widgets -->
	<script src="/assets/vendor/jquery-ui/ui/widgets/datepicker.js"></script>

	<!-- JS Plugins Init. -->
	<script src="/assets/vendor/appear.js"></script>
	<script src="/assets/assets/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
	<script src="/assets/assets/vendor/flatpickr/dist/js/flatpickr.min.js"></script>
	<script src="/assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="/assets/assets/vendor/chartist-js/chartist.min.js"></script>
	<script src="/assets/assets/vendor/chartist-js-tooltip/chartist-plugin-tooltip.js"></script>
	<script src="/assets/assets/vendor/fancybox/jquery.fancybox.min.js"></script>

	<!-- JS Unify -->
	<script src="/assets/js/hs.core.js"></script>
	<script src="/assets/assets/js/components/hs.side-nav.js"></script>
	<script src="/assets/js/helpers/hs.hamburgers.js"></script>
	<script src="/assets/assets/js/components/hs.range-datepicker.js"></script>
	<script src="/assets/js/components/hs.datepicker.js"></script>
	<script src="/assets/js/components/hs.dropdown.js"></script>
	<script src="/assets/js/components/hs.scrollbar.js"></script>
	<script src="/assets/assets/js/components/hs.area-chart.js"></script>
	<script src="/assets/assets/js/components/hs.donut-chart.js"></script>
	<script src="/assets/assets/js/components/hs.bar-chart.js"></script>
	<script src="/assets/js/helpers/hs.focus-state.js"></script>
	<script src="/assets/assets/js/components/hs.popup.js"></script>

	<!-- JS Custom -->
	<script src="/assets/js/custom.js"></script>

	<!-- JS Plugins Init. -->
	<script>
		$(document).on('ready', function () {
		// initialization of custom select
		$('.js-select').selectpicker();
	
		// initialization of hamburger
		$.HSCore.helpers.HSHamburgers.init('.hamburger');
	
		// initialization of charts
		$.HSCore.components.HSAreaChart.init('.js-area-chart');
		$.HSCore.components.HSDonutChart.init('.js-donut-chart');
		$.HSCore.components.HSBarChart.init('.js-bar-chart');
	
		// initialization of sidebar navigation component
		$.HSCore.components.HSSideNav.init('.js-side-nav', {
			afterOpen: function() {
			setTimeout(function() {
				$.HSCore.components.HSAreaChart.init('.js-area-chart');
				$.HSCore.components.HSDonutChart.init('.js-donut-chart');
				$.HSCore.components.HSBarChart.init('.js-bar-chart');
			}, 400);
			},
			afterClose: function() {
			setTimeout(function() {
				$.HSCore.components.HSAreaChart.init('.js-area-chart');
				$.HSCore.components.HSDonutChart.init('.js-donut-chart');
				$.HSCore.components.HSBarChart.init('.js-bar-chart');
			}, 400);
			}
		});
	
		// initialization of range datepicker
		$.HSCore.components.HSRangeDatepicker.init('#rangeDatepicker, #rangeDatepicker2, #rangeDatepicker3');
	
		// initialization of datepicker
		$.HSCore.components.HSDatepicker.init('#datepicker', {
			dayNamesMin: [
			'SU',
			'MO',
			'TU',
			'WE',
			'TH',
			'FR',
			'SA'
			]
		});
	
		// initialization of HSDropdown component
		$.HSCore.components.HSDropdown.init($('[data-dropdown-target]'), {dropdownHideOnScroll: false});
	
		// initialization of custom scrollbar
		$.HSCore.components.HSScrollBar.init($('.js-custom-scroll'));
	
		// initialization of popups
		$.HSCore.components.HSPopup.init('.js-fancybox', {
			btnTpl: {
			smallBtn: '<button data-fancybox-close class="btn g-pos-abs g-top-25 g-right-30 g-line-height-1 g-bg-transparent g-font-size-16 g-color-gray-light-v3 g-brd-none p-0" title=""><i class="hs-admin-close"></i></button>'
			}
		});
		});


		$(document).on('click','.logout_button', function(){
			$('#logout_form').submit();
		})
	</script>

	@stack('js')	

	</body>

	</html>

