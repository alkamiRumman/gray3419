<div class="modal fade" id="remoteModal1" role="dialog" aria-hidden="true" data-backdrop="static"
	 data-keyboard="false" style="z-index: 999999"></div>
</section>
</body>
</html>

<script src="<?= base_url('assets/adminLte/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/datatables.net/js/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/datatable/js/tables/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/datatables.net-bs/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/datatable/js/tables/jquery.dataTables.yadcf.js') ?>"></script>
<!--<script src="--><? //= base_url('assets/adminLte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?><!--"></script>-->
<script src="<?= base_url('assets/adminLte/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/moment/min/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/fastclick/lib/fastclick.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/dist/js/adminlte.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/dist/js/demo.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/dist/js/select.min.js') ?>"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"/>

</body>
</html>
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
		var url = window.location;
		$('.treeview-menu li a[href="' + url + '"]').parent().addClass('active');
		$('.treeview-menu li a').filter(function () {
			return this.href == url;
		}).parent().parent().parent().addClass('active', 'text-danger');

		$(".sideMenu a").each(function () {
			if (url == (this.href)) {
				$(this).closest("li").addClass("active");
			}
		});
	});
</script>
