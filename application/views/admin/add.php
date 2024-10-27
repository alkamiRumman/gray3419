<style>
	.form-group {
		margin-bottom: 10px;
	}

	.box-primary {
		background-color: #f9f9f9;
		border-radius: 10px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}

	.box-header h3 {
		margin: 0;
		padding: 0;
	}

	.box-footer {
		padding-top: 20px;
	}

	.input-group-addon {
		background-color: #f1f1f1;
	}

	.img-thumbnail {
		margin-top: 10px;
	}

	.text-danger {
		color: #d9534f;
	}

	.box-title {
		font-size: 1.5em;
		font-weight: bold;
	}

	.btn-primary {
		background-color: #337ab7;
		border-color: #2e6da4;
	}

	.btn-success {
		background-color: #5cb85c;
		border-color: #4cae4c;
	}

	.table {
		margin-bottom: 0;
	}

	.table td, .table th {
		vertical-align: middle;
	}

	.numeric-input {
		max-width: 160px;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Add New</b></h3>
				<a href="<?= admin_url('details') ?>" class="btn btn-sm btn-primary pull-right">Accident Details</a>
			</div>
			<form id="form" action="<?= admin_url('save') ?>" method="post" enctype="multipart/form-data">
				<div class="box-body">
					<div class="row">
						<div class="form-group col-md-2">
							<label for="accidentDate">Accident Date <b class="text-danger">*</b></label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" name="accidentDate" id="accidentDate"
									   value="<?= date('d M Y') ?>" required>
							</div>
						</div>
						<div class="form-group col-md-2">
							<label for="accidentTime">Accident Time <b class="text-danger">*</b></label>
							<input class="form-control" type="time" name="accidentTime" id="accidentTime"
								   value="<?= date('H:i') ?>" required>
						</div>
						<div class="form-group col-md-3">
							<label for="vehicleLicPlate">Vehicle LIC. Plate No<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="vehicleLicPlate" id="vehicleLicPlate"
								   placeholder="Enter Vehicle LIC Plate Number" required>
						</div>
						<div class="form-group col-md-3">
							<label for="chassisNo">Vehicle VIN./Chassis No.<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="chassisNo" id="chassisNo"
								   placeholder="Enter Chassis Number" required>
						</div>
						<div class="form-group col-md-2">
							<label for="licensePlateClass">Vehicle License Plate Class</label>
							<select class="form-control" name="licensePlateClass" id="licensePlateClass">
								<option value="">Select Plate Class</option>
								<option value="A - Motor Cycle">A - Motor Cycle</option>
								<option value="A1 - Quad Bike">A1 - Quad Bike</option>
								<option value="A2 - Scooter">A2 - Scooter</option>
								<option value="B - Private Motor Vehicle">B - Private Motor Vehicle</option>
								<option value="C - Light Public Service Vehicle(Up to 17 Passengers)">C - Light Public
									Service Vehicle(Up to 17 Passengers)
								</option>
								<option value="C1 - Light Public Service Vehicle(Over 17 Passengers)">C1 - Light Public
									Service Vehicle(Over 17 Passengers)
								</option>
								<option value="D - Light Goods Vehicle (GROSS Weight Up to 7000Kgs)">D - Light Goods
									Vehicle (GROSS Weight Up to 7000Kgs)
								</option>
								<option value="D1 - Heavy Goods Vehicle (GROSS Weight Exceeding 7000Kgs)">D1 - Heavy
									Goods Vehicle (GROSS Weight Exceeding 7000Kgs)
								</option>
								<option value="E - Trailer/Tractor">E - Trailer/Tractor</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="locationOfAccident">Place/Location of Accident </label>
							<input class="form-control" type="text" name="locationOfAccident" id="locationOfAccident"
								   placeholder="Location">
						</div>
						<div class="form-group col-md-3">
							<label for="policeId">Select Police Officer</label>
							<select style="width: 100%" id="policeId" name="policeId"
									class="form-control selectPolice"></select>
						</div>
						<div class="form-group col-md-3">
							<label for="roadCondition">Road Condition </label>
							<input class="form-control" type="text" name="roadCondition" id="roadCondition"
								   placeholder="Road Condition">
						</div>
						<div class="form-group col-md-3">
							<label for="vehicleOwner">Vehicle Owner </label>
							<input class="form-control" type="text" name="vehicleOwner" id="vehicleOwner"
								   placeholder="Vehicle Owner Name">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="driverName">Driver at Time of Accident</label>
							<input class="form-control" type="text" name="driverName" id="driverName"
								   placeholder="Driver Name">
						</div>
						<div class="form-group col-md-2">
							<label for="driverOccupation">Occupation of Driver </label>
							<input class="form-control" type="text" name="driverOccupation" id="driverOccupation"
								   placeholder="Driver Occupation">
						</div>
						<div class="form-group col-md-2">
							<label for="annualPremium">Annual Premium </label>
							<input class="form-control" type="number" step="any" name="annualPremium" id="annualPremium"
								   placeholder="($)">
						</div>
						<div class="form-group col-md-2">
							<label for="deductible">Deductible/Excess </label>
							<input class="form-control" type="number" step="any" name="deductible" id="deductible"
								   placeholder="($)">
						</div>
						<div class="form-group col-md-3">
							<label for="insurerId">Insurer</label>
							<select style="width: 100%" id="insurerId" name="insurerId"
									class="form-control selectInsurer"></select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-2">
							<label for="annualPremiumInsurer">Annual Premium </label>
							<input class="form-control" type="number" step="any" name="annualPremiumInsurer"
								   id="annualPremiumInsurer" placeholder="($)">
						</div>
						<div class="form-group col-md-5">
							<label for="accidentDetails">Details Of Accident</label>
							<input class="form-control" type="text" name="accidentDetails" id="accidentDetails">
						</div>
						<div class="form-group col-md-5">
							<label for="ownDamageDetails">Details Of Own Damage</label>
							<input class="form-control" type="text" name="ownDamageDetails" id="ownDamageDetails">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label for="damageDiagram">Vehicle Damage Diagram</label>
							<input class="form-control" type="text" name="damageDiagram" id="damageDiagram">
						</div>
						<div class="form-group col-md-4">
							<label for="partialDamage">Partial Damage of Total led</label>
							<input class="form-control" type="text" name="partialDamage" id="partialDamage">
						</div>
						<div class="form-group col-md-3">
							<label for="acceptLiability">Did This Driver Accept Liability?</label>
							<select class="form-control" name="acceptLiability" id="acceptLiability">
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="policeOpinion">Police Opinion</label>
							<input class="form-control" type="text" name="policeOpinion" id="policeOpinion">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<table class="table">
								<tbody>
								<tr>
									<td><label for="conviction">Charge/Conviction regarding this accident </label></td>
									<td><input class="form-control numeric-input" type="number" step="any"
											   name="conviction" id="conviction" placeholder="($)"></td>
								</tr>
								<tr>
									<td><label for="ownDamagePayout">Own Damage Payout by insurer</label></td>
									<td><input class="form-control numeric-input" type="number" step="any"
											   name="ownDamagePayout" id="ownDamagePayout" placeholder="($)"></td>
								</tr>
								<tr>
									<td><label for="thirdPartyPayout">Third Party Property Payout</label></td>
									<td><input class="form-control numeric-input" type="number" step="any"
											   name="thirdPartyPayout" id="thirdPartyPayout" placeholder="($)"></td>
								</tr>
								<tr>
									<td><label for="thirdPartyBodilyPayout">Third Party Bodily Injury Payout by
											insurer</label></td>
									<td><input class="form-control numeric-input" type="number" step="any"
											   name="thirdPartyBodilyPayout" id="thirdPartyBodilyPayout"
											   placeholder="($)"></td>
								</tr>
								<tr>
									<td><label for="thirdPartyDeathPayout">Third Party Death Payout by insurer</label>
									</td>
									<td><input class="form-control numeric-input" type="number" step="any"
											   name="thirdPartyDeathPayout" id="thirdPartyDeathPayout"
											   placeholder="($)"></td>
								</tr>
								<tr>
									<td><label for="totalThirdPartyPayout">Total Third Party Payout by insurer</label>
									</td>
									<td><input class="form-control" type="number" step="any"
											   name="totalThirdPartyPayout" id="totalThirdPartyPayout" readonly></td>
								</tr>
								<tr>
									<td><label for="total">Total Claim Paid for Own Damage and Third Party
											Damage</label></td>
									<td><input class="form-control" type="number" step="any" name="total" id="total"
											   readonly></td>
								</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-6">
							<label>Vehicle Owner ID</label>
							<input type="file" name="ownerId" id="ownerId">
							<div class="card-body" style="margin-top: 10px">
								<img width="250" class="img-responsive img-thumbnail center-block" id="preview"
									 src="<?= base_url('images/noImage.png') ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="form-group col-md-12 text-center">
							<button type="submit" class="btn btn-success">Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$("#accidentDate").datepicker({
		changeMonth: true,
		changeYear: true,
		maxDate: 0,
		dateFormat: 'dd M yy'
	});
	$(document).on('input', ".numeric-input", function () {
		// Convert input values to floats, defaulting to 0 if NaN
		var conviction = parseFloat($('#conviction').val()) || 0;
		var ownDamagePayout = parseFloat($('#ownDamagePayout').val()) || 0;
		var thirdPartyPayout = parseFloat($('#thirdPartyPayout').val()) || 0;
		var thirdPartyBodilyPayout = parseFloat($('#thirdPartyBodilyPayout').val()) || 0;
		var thirdPartyDeathPayout = parseFloat($('#thirdPartyDeathPayout').val()) || 0;

		// Ensure all values are non-negative
		if (conviction < 0 || ownDamagePayout < 0 || thirdPartyPayout < 0 || thirdPartyBodilyPayout < 0 || thirdPartyDeathPayout < 0) {
			return;
		}

		// Calculate total third party payout and overall total
		var totalThirdParty = thirdPartyPayout + thirdPartyBodilyPayout + thirdPartyDeathPayout;
		var amount = conviction + ownDamagePayout + totalThirdParty;

		// Set the calculated values in the respective fields
		$('#totalThirdPartyPayout').val(totalThirdParty.toFixed(2));
		$('#total').val(amount.toFixed(2));
	});

	$(document).ready(function () {
		$(".selectPolice").select2({
			placeholder: "Select Police Officer",
			ajax: {
				url: '<?= admin_url("getPoliceSearch") ?>',
				dataType: 'json',
				type: "POST",
				quietMillis: 50,
				allowClear: true,
				data: function (params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function (response) {
					console.log(response);
					return {
						results: response
					};
				}
			}
		});

		$(".selectInsurer").select2({
			placeholder: "Select Insurer",
			ajax: {
				url: '<?= admin_url("getInsurerSearch") ?>',
				dataType: 'json',
				type: "POST",
				quietMillis: 50,
				allowClear: true,
				data: function (params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function (response) {
					console.log(response);
					return {
						results: response
					};
				}
			}
		});

		$("#form").submit(function (submitEvent) {
			var filename = $("#ownerId").val();
			var extension = filename.replace(/^.*\./, '');

			if (extension == filename) {
				extension = '';
			} else {
				extension = extension.toLowerCase();
			}
			switch (extension) {
				case 'jpg':
				case 'jpeg':
				case 'png':
				case '':
					break;

				default:
					alert('Image format does not match!');
					submitEvent.preventDefault();
			}

		});
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#preview').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]); // convert to base64 string
		}
	}

	$("#ownerId").change(function () {
		readURL(this);
	});
</script>
