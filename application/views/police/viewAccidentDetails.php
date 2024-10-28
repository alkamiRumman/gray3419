<div class="modal fade in" id="modal-default" style="display: block; overflow: auto;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-sm btn-primary pull-right printButton" id="Print">Print</button>
				<button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal" aria-label="Close">
					Close
				</button>
				<h4 class="modal-title"><b> Accident Details</b></h4>
			</div>
			<div class="modal-body" id="printThis">
				<div class="panel panel-body">
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<table class="table no-border table-sm">
								<tr>
									<th>Accident Date</th>
									<td><?= date('d M Y', strtotime($accidentDetails->accidentDate)) ?></td>
								</tr>
								<tr>
									<th>Accident Time</th>
									<td><?= date('h:i A', strtotime($accidentDetails->accidentTime)) ?></td>
								</tr>
								<tr>
									<th>Accident Location</th>
									<td><?= $accidentDetails->locationOfAccident ?></td>
								</tr>
								<tr>
									<th>Road Condition</th>
									<td><?= $accidentDetails->roadCondition ?></td>
								</tr>
								<tr>
									<th>Accident Details</th>
									<td><?= $accidentDetails->accidentDetails ?></td>
								</tr>
								<tr>
									<th>Police Opinion</th>
									<td><?= $accidentDetails->policeOpinion ?></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<table class="table table-bordered table-striped table-sm" id="dynamicTable">
								<thead>
								<tr class="bg-info">
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
								<?php if ($vehicleDetails) {
									foreach ($vehicleDetails as $vehicleDetail) { ?>
										<tr>
											<td><?= $vehicleDetail->vehicleLicPlate ?></td>
											<td><?= $vehicleDetail->chassisNo ?></td>
											<td><?= $vehicleDetail->licensePlateClass ?></td>
											<td><?= $vehicleDetail->vehicleOwner ?></td>
											<td><?= $vehicleDetail->driverName ?></td>
											<td><?= $vehicleDetail->driverOccupation ?></td>
											<td><?= $vehicleDetail->insurer ?></td>
											<td><?= $vehicleDetail->acceptLiability ?></td>
										</tr>
									<?php }
								} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">
					Close
				</button>
			</div>
		</div>
	</div>
</div>
<style>
	td {
		font-weight: normal;
	}

	@media screen {
		#printSection {
			display: none;
		}
	}

	@media print {
		body * {
			visibility: hidden;
		}

		#dynamicTable thead tr {
			background-color: #D9EDF7 !important;
			color: #000 !important;
			-webkit-print-color-adjust: exact;
			print-color-adjust: exact;
		}

		#dynamicTable thead th {
			background-color: #D9EDF7 !important;
			color: #000 !important;
		}

		@page {
			size: A4;
			margin: 2cm;
		}

		#printSection, #printSection * {
			visibility: visible;
		}

		.page-break {
			page-break-before: always;
			content: "";
			display: block;
			height: 0;
		}

		.modal-body {
			width: 21cm;
			min-height: 29.7cm;
			margin: 0;
			background: white;
		}

		#printSection {
			position: absolute;
			left: 0;
			top: 0;
		}
	}
</style>
<script>
	document.getElementById("Print").onclick = function () {
		printElement(document.getElementById("printThis"));
	};

	function printElement(elem) {
		var domClone = elem.cloneNode(true);

		var $printSection = document.getElementById("printSection");

		if (!$printSection) {
			var $printSection = document.createElement("div");
			$printSection.id = "printSection";
			document.body.appendChild($printSection);
		}

		$printSection.innerHTML = "";
		$printSection.appendChild(domClone);
		window.print();
	}
</script>
