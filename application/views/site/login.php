<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= SHORTNAME ?> | Log in</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="icon" href="<?= base_url('public/favicon.ico') ?>" type="image/x-icon"/>
	<link rel="stylesheet"
		  href="<?= base_url('assets/adminLte/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet"
		  href="<?= base_url('assets/adminLte/bower_components/font-awesome/css/font-awesome.min.css') ?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?= base_url('assets/adminLte/bower_components/Ionicons/css/ionicons.min.css') ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/adminLte/dist/css/AdminLTE.min.css') ?>">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?= base_url('assets/adminLte/plugins/iCheck/square/blue.css') ?>">
	<!-- Google Font -->
	<link rel="stylesheet"
		  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<link rel="stylesheet" type="text/css"
		  href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		<!--		<img src="-->
		<? //= base_url('images/logo_removebg.png') ?><!--" height="200" style="margin-top: 0">-->
		<h3><b><?= COMPANY ?></b></h3>
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body" style="border: 2px solid #605CA8;border-radius: 25px;">
		<p class="login-box-msg">login to start your sessions</p>

		<form action="<?= login_url('verify') ?>" method="post">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" name="password" id="password" minlength="3"
					   placeholder="Password" required>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-4 pull-right">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div>
			</div>
		</form>

		<table class="table table-bordered" style="margin-top:10px">
			<tr id="admin">
				<td>admin@admin.com</td>
				<td>123</td>
				<td>Admin</td>
			</tr>
			<tr id="police">
				<td>police@gmail.com</td>
				<td>123</td>
				<td>Police</td>
			</tr>
			<tr id="insurer">
				<td>insurer@gmail.com</td>
				<td>123</td>
				<td>Insurer</td>
			</tr>
			<tr id="traffic">
				<td>traffic@gmail.com</td>
				<td>123</td>
				<td>Traffic Court</td>
			</tr>

		</table>
	</div>
</div>

<script src="<?= base_url('assets/adminLte/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src=" <?= base_url('assets/adminLte/plugins/iCheck/icheck.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
	setTimeout(function () {
		$('.alert').hide('fast');
	}, 3000);
	toastr.options = {
		"debug": false,
		"positionClass": "toast-bottom-right",
		"onclick": null,
		"fadeIn": 300,
		"fadeOut": 1000,
		"timeOut": 5000,
		"extendedTimeOut": 1000
	}
	<?php if($this->session->flashdata('success')){ ?>
	toastr.success("<?php echo $this->session->flashdata('success'); ?>");
	<?php }else if($this->session->flashdata('danger')){  ?>
	toastr.error("<?php echo $this->session->flashdata('danger'); ?>");
	<?php }else if($this->session->flashdata('warning')){  ?>
	toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
	<?php }else if($this->session->flashdata('info')){  ?>
	toastr.info("<?php echo $this->session->flashdata('info'); ?>");
	<?php } ?>

	$(function () {
		$('#admin').on('click', function () {
			$('#username').val('admin@admin.com');
			$('#password').val('123');
		})
		$('#insurer').on('click', function () {
			$('#username').val('insurer@gmail.com');
			$('#password').val('123');
		})
		$('#police').on('click', function () {
			$('#username').val('police@gmail.com');
			$('#password').val('123');
		})
		$('#traffic').on('click', function () {
			$('#username').val('traffic@gmail.com');
			$('#password').val('123');
		})
	});
</script>
</body>
</html>
