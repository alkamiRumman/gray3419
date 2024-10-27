<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Add New Member</b></h3>
			</div>
			<div class="box-body">
				<form role="form" action="<?= admin_url('saveUser') ?>" method="post" autocomplete="off">
					<div class="row">
						<div class="form-group col-md-3">
							<label for="name"> Name <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="name" id="name"
								   placeholder="Enter Member Name" required>
						</div>
						<div class="form-group col-md-3">
							<label for="username"> Username <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="username" id="username"
								   placeholder="Enter Username" required>
						</div>
						<div class="form-group col-md-2">
							<label for="type"> Type <b class="text-danger">*</b></label>
							<select class="form-control" name="type" id="type" required>
								<option value="">Select Type</option>
								<option value="Police">Police</option>
								<option value="Insurers">Insurers</option>
								<option value="Traffic Court">Traffic Court</option>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label for="password"> Password <b class="text-danger">*</b></label>
							<input type="password" class="form-control" name="password" id="password"
								   placeholder="Password" required>
						</div>
						<div class="form-group col-md-2">
							<label for="password1"> Confirm Password </label>
							<input type="password" class="form-control" name="password1" id="password1"
								   placeholder="Retype password">
						</div>
					</div>

					<div class="box-footer">
						<div class="row">
							<div class="form-group col-md-12">
								<button type="submit" id="submit" class="btn btn-success pull-right">Save</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>User List</b></h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dtr-inline"
						   style="width: 100% !important;" id="item-list">
						<thead>
						<tr>
							<th>Name<br></th>
							<th>Username<br></th>
							<th>Type<br></th>
							<th>Join At</th>
							<th style="padding-right: 30px">Actions</th>
						</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var checkEmail = 0;
	$('#username').on('keyup', function () {
		var email = $('#username').val();
		if (email != '') {
			$.ajax({
				url: "<?php echo admin_url('fetch_email'); ?>",
				method: "POST",
				data: {email: email},
				success: function (data) {
					if (data == 1) {
						checkEmail = 1;
					} else {
						checkEmail = 0;
					}
				}
			});
		}
	});

	var status = 0;
	$('#password, #password1').on('keyup', function () {
		var password = $('#password').val();
		if (password == $('#password1').val()) {
			status = 0;
		} else {
			status = 1;
		}
	});

	$('#submit').on('click', function (e) {
		if (status == 1) {
			toastr.error('Password doesn\'t match!');
			e.preventDefault();
		}
		if (checkEmail == 1) {
			toastr.error('Username already exist!');
			e.preventDefault();
		}
	});
	var Table, selectedIDs = [];
	window.onload = function () {
		Table = $('#item-list').DataTable({
			serverSide: true,
			order: [[0, "ASC"]],
			// destroy: true,
			stateSave: true,
			"columnDefs": [
				{
					"render": function (data, type, row) {
						return moment(data).format('D MMM YYYY hh:mm:ss A');
					}, "targets": 3, 'sType': 'date'
				}
			],
			'aoColumns': [{mData: "name"}, {mData: "username"}, {mData: "type"}, {mData: "createAt"}, {
				mData: "actions",
				bSortable: false
			}],
			"aLengthMenu": [[25, 50, 100, 200, 500, 1000], [25, 50, 100, 200, 500, 1000]],
			"iDisplayLength": 100,
			'bProcessing': true,
			"language": {
				processing: '<div><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading Please Wait...</span></div>'
			},
			'bServerSide': true,
			'sAjaxSource': '<?= admin_url('getUsers') ?>',
			'fnServerData': function (sSource, aoData, fnCallback) {
				$.ajax({
					'dataType': 'json',
					'type': 'POST',
					'url': sSource,
					'data': aoData,
					'success': function (d, e, f) {
						console.log(d);
						fnCallback(d, e, f);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log(jqXHR);
						if (jqXHR.jqXHRstatusText)
							alert(jqXHR.jqXHRstatusText);
					}
				});
			},
			"fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
				// console.log(nRow);
			},
			dom: '<"top"B<"pull-right"f>>irtlp',
			// dom: 'lfrtip',
		});
	}
</script>
