<body class="hold-transition skin-green sidebar-collapse sidebar-mini">
<div class="wrapper">
	<header class="main-header">
		<!-- Logo -->
		<a class="logo">
			<span class="logo-mini"><b><?= SHORTNAME ?></b></span>
			<span class="logo-lg"><b><?= currentUserType() ?> | </b><?= currentUserType() == 'MDA' ? getSession()->username : getSession()->name ?></span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top" style="background-color: forestgreen">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">

					<!-- Messages: style can be found in dropdown.less-->
					<li class="dropdown messages-menu">
						<a class="dropdown-toggle" data-toggle="dropdown">
							<b><?= COMPANY ?></b>
						</a>
					</li>
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?= base_url('assets/adminLte/dist/img/noImage.png') ?>" class="user-image"
								 alt="User Image">
							<span class="hidden-xs"><?= getSession()->name ?></span>
						</a>
						<ul class="dropdown-menu">
							<li class="user-header skin-green">
								<img src="<?= base_url('assets/adminLte/dist/img/noImage.png') ?>" class="img-circle"
									 alt="User Image">
								<p style="color: black">
									<?= getSession()->name ?>
									<small>Joined Since
										- <?= date('d F Y', strtotime(getSession()->createAt)) ?></small>
								</p>
							</li>
							<li class="user-footer">
								<div class="pull-left">
									<a onclick="loadPopup('<?= login_url('profile') ?>')"
									   class="btn btn-default btn-flat">Profile</a>
								</div>
								<div class="pull-right">
									<a href="<?= login_url('logout') ?>" class="btn btn-default btn-flat">Sign out</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?= base_url('assets/adminLte/dist/img/noImage.png') ?>" style="border-radius: 50%;"
						 class="user-image" alt="User Image">
				</div>
				<div class="pull-left info">
					<p style="color: white"><?= getSession()->name ?></p>
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<div class="sideMenu">
				<ul class="sidebar-menu" data-widget="tree">
					<?php if (isAdmin()) { ?>
						<li class="float-left">
							<a href="<?= admin_url('index') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span>
							</a>
						</li>
						<li><a href="<?= admin_url('users') ?>"><i class="fa fa-user-circle"></i><span>Users</span></a>
						</li>
						<li><a href="<?= admin_url('add') ?>"><i
										class="fa fa-cart-plus"></i><span>Add Details</span></a>
						</li>
						<li><a href="<?= admin_url('details') ?>"><i class="fa fa-car"></i><span>Accident Details</span></a>
						</li>
					<?php } else if (isPolice()) { ?>
						<li class="float-left <?= $this->uri->segment(2) == 'index' ? 'active' : '' ?>">
							<a href="<?= police_url('index') ?>"><i class="fa fa-dashboard"></i>
								<span>Dashboard</span> </a>
						</li>
						<li><a href="<?= police_url('add') ?>"><i
										class="fa fa-cart-plus"></i><span>Add Details</span></a>
						</li>
						<li><a href="<?= police_url('details') ?>"><i
										class="fa fa-car"></i><span>Accident Details</span></a>
						</li>
					<?php } else if (isInsurers()) { ?>
						<li class="float-left <?= $this->uri->segment(2) == 'index' ? 'active' : '' ?>">
							<a href="<?= insurer_url('index') ?>"><i class="fa fa-dashboard"></i>
								<span>Dashboard</span> </a>
						</li>
						<li><a href="<?= insurer_url('details') ?>"><i
										class="fa fa-car"></i><span>Accident Details</span></a>
						</li>
					<?php } else if (isTraffic()) { ?>
						<li class="float-left <?= $this->uri->segment(2) == 'index' ? 'active' : '' ?>">
							<a href="<?= traffic_url('index') ?>"><i class="fa fa-dashboard"></i>
								<span>Dashboard</span> </a>
						</li>
					<?php } ?>
					<li>
						<a href="<?= login_url('logout') ?>"><i class="fa fa-power-off"></i> <span>Sign out</span></a>
					</li>
				</ul>
			</div>
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content">

