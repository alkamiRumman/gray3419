<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<a href="<?= police_url('details') ?>">
							<div class="small-box bg-orange">
								<div class="inner">
									<h3><?= $totalAccident ?></h3>
									<p>Total Accident</p>
								</div>
								<div class="icon">
									<i class="fa fa-car"></i>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3">
						<a href="<?= police_url('details') ?>">
							<div class="small-box bg-red-active">
								<div class="inner">
									<h3><?= $todayAccident ?></h3>
									<p>Today's Accident</p>
								</div>
								<div class="icon">
									<i class="fa fa-car"></i>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Accident Vehicle Details</b></h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dtr-inline"
						   style="width: 99% !important;" id="item-list">
						<thead>
						<tr>
							<th>Accident Date</th>
							<th>Accident Time</th>
							<th>Place/Location of Accident</th>
							<th>Vehicle LIC. Plate No</th>
							<th>Vehicle VIN./Chassis No</th>
							<th>Vehicle License Plate Class</th>
							<th>Vehicle Owner</th>
							<th>Driver at Time of Accident</th>
							<th>Occupation of Driver</th>
							<th>Insurer Name</th>
							<th>Did This Driver Accept Liability?</th>
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
	var Table = [];
	window.onload = function () {
		Table = $('#item-list').DataTable({
			serverSide: true,
			order: [[0, "DESC"], [3, "ASC"]],
			// destroy: true,
			// stateSave: true,
			"columnDefs": [
				{
					"render": function (data, type, row) {
						return moment(data).format('DD MMM YYYY');
					}, "targets": 0, 'sType': 'date'
				},
				{
					"render": function (data, type, row) {
						return moment(data, "HH:mm").format('hh:mm:ss A');
					}, "targets": 1, 'sType': 'date'
				}
			],
			'aoColumns': [{mData: "accidentDate"}, {mData: "accidentTime"}, {mData: "locationOfAccident"}, {mData: "vehicleLicPlate"}, {mData: "chassisNo"}, {mData: "licensePlateClass"},
				{mData: "vehicleOwner"}, {mData: "driverName"}, {mData: "driverOccupation"}, {mData: "name"}, {mData: "acceptLiability"}],
			"aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, 'ALL']],
			"iDisplayLength": 25,
			'bProcessing': true,
			"language": {
				processing: '<div><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading Please Wait...</span></div>'
			},
			'bServerSide': true,
			'sAjaxSource': '<?= police_url('getVehicleDetails') ?>',
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
			buttons: [
				{
					extend: 'copy',
					exportOptions: {
						columns: ':not(:last-child)',
					}
				}, {
					extend: 'excel',
					exportOptions: {
						columns: ':visible(:not(:last-child))',
					}
				}, {
					extend: 'csv',
					exportOptions: {
						columns: ':visible(:not(:last-child))',
					}
				},
				{
					extend: 'colvis',
					text: 'Column Visibility',
					collectionLayout: 'three-column'
				}
			],
			dom: '<"top"B<"pull-right"f>>irtlp',
			// dom: 'lfrtip',
		});
	}
</script>
