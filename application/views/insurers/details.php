<style>
	.box-info {
		background-color: #f9f9f9;
		border-radius: 10px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}

	.box-header h3 {
		margin: 0;
		padding: 0;
	}

	.box-title {
		font-size: 1.5em;
		font-weight: bold;
	}

</style>
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Accident Details</b></h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dtr-inline"
						   style="width: 100% !important;" id="item-list">
						<thead>
						<tr>
							<th>Accident Date</th>
							<th>Accident Time</th>
							<th>Vehicle LIC. Plate No</th>
							<th>Vehicle VIN./Chassis No</th>
							<th>Vehicle License Plate Class</th>
							<th>Place/Location of Accident</th>
							<th>Occupation of Driver</th>
							<th>Annual Premium</th>
							<th>Deductible/Excess</th>
							<th>Insurer Annual Premium</th>
							<th>Details Of Own Damage</th>
							<th>Vehicle Damage Diagram</th>
							<th>Partial Damage Of Total led</th>
							<th>Own Damage Payout by insurer</th>
							<th>Third Party Property Payout</th>
							<th>Third Party Bodily Injury Payout by insurer</th>
							<th>Third Party Death Payout by insurer</th>
							<th>Total Third Party Payout by insurer</th>
							<th>Total Claim Paid</th>
							<th>Create At</th>
							<th>Action</th>
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
			order: [[0, "DESC"]],
			// destroy: true,
			stateSave: true,
			"columnDefs": [
				{
					"render": function (data, type, row) {
						return moment(data).format('DD MMM YYYY');
					}, "targets": 0, 'sType': 'date'
				}, {
					"render": function (data, type, row) {
						return moment(data).format('DD MMM YYYY hh:mm:ss A');
					}, "targets": 19, 'sType': 'date'
				}
			],
			'aoColumns': [{mData: "accidentDate"}, {mData: "accidentTime"}, {mData: "vehicleLicPlate"}, {mData: "chassisNo"}, {mData: "licensePlateClass"}, {mData: "locationOfAccident"},
				{mData: "driverOccupation"}, {mData: "annualPremium"}, {mData: "deductible"}, {mData: "annualPremiumInsurer"}, {mData: "ownDamageDetails"},
				{mData: "damageDiagram"}, {mData: "partialDamage"}, {mData: "ownDamagePayout"}, {mData: "thirdPartyPayout"}, {mData: "thirdPartyBodilyPayout"}, {mData: "thirdPartyDeathPayout"},
				{mData: "totalThirdPartyPayout"}, {mData: "total"},
				{mData: "createAt"}, {
					mData: "actions",
					bSortable: false
				}],
			"aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, 'ALL']],
			"iDisplayLength": 25,
			'bProcessing': true,
			"language": {
				processing: '<div><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading Please Wait...</span></div>'
			},
			'bServerSide': true,
			'sAjaxSource': '<?= insurer_url('getDetails') ?>',
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
					collectionLayout: 'four-column'
				}
			],
			dom: '<"top"B<"pull-right"f>>irtlp',
			// dom: 'lfrtip',
		});
	}
</script>
