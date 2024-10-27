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

	.table td, .table th {
		vertical-align: middle;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Add New</b></h3>
				<a href="<?= police_url('details') ?>" class="btn btn-sm btn-primary pull-right">Accident Details</a>
			</div>
			<form id="form" action="<?= police_url('save') ?>" method="post" enctype="multipart/form-data">
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
							<input class="form-control" type="time" name="accidentTime" value="<?= date('H:i') ?>"
								   id="accidentTime" required>
						</div>
						<div class="form-group col-md-3">
							<label for="locationOfAccident">Place/Location of Accident </label>
							<input class="form-control" type="text" name="locationOfAccident" id="locationOfAccident"
								   placeholder="Location">
						</div>
						<div class="form-group col-md-3">
							<label for="roadCondition">Road Condition </label>
							<input class="form-control" type="text" name="roadCondition" id="roadCondition"
								   placeholder="Road Condition">
						</div>
					</div>
					<hr>
					<div class="row dynamic">
						<div class="form-group col-md-3">
							<label for="vehicleLicPlate">Vehicle LIC. Plate No<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="vehicleLicPlate[]" id="vehicleLicPlate"
								   placeholder="Enter Vehicle LIC Plate Number" required>
						</div>
						<div class="form-group col-md-3">
							<label for="chassisNo">Vehicle VIN./Chassis No.<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="chassisNo[]" id="chassisNo"
								   placeholder="Enter Chassis Number" required>
						</div>
						<div class="form-group col-md-3">
							<label for="licensePlateClass">Vehicle License Plate Class</label>
							<select class="form-control" name="licensePlateClass[]" id="licensePlateClass">
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
						<div class="form-group col-md-3">
							<label for="vehicleOwner">Vehicle Owner </label>
							<input class="form-control" type="text" name="vehicleOwner[]" id="vehicleOwner"
								   placeholder="Vehicle Owner Name">
						</div>
						<div class="form-group col-md-3">
							<label for="driverName">Driver at Time of Accident + I.D. #</label>
							<input class="form-control" type="text" name="driverName[]" id="driverName"
								   placeholder="Driver Name + I.D. #">
						</div>
						<div class="form-group col-md-3">
							<label for="insurerId">Insurer </label>
							<select style="width: 100%" id="insurerId" name="insurerId[]"
									class="form-control selectInsurer"></select>
						</div>
						<div class="form-group col-md-3">
							<label for="acceptLiability">Did This Driver Accept Liability?</label>
							<select class="form-control" name="acceptLiability[]" id="acceptLiability">
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
						</div>
						<div class="form-group col-md-3">
							<br>
						</div>
						<div class="form-group col-md-2">
							<button type="button" class="btn btn-sm btn-danger remove-field"><i class="fa fa-trash"></i>
							</button>
						</div>
					</div>
					<hr>
					<button type="button" class="btn btn-md btn-success add-field">Add</button>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="accidentDetails">Details Of Accident</label>
							<textarea class="form-control" rows="3" name="accidentDetails"
									  id="accidentDetails"></textarea>
						</div>
						<div class="form-group col-md-6">
							<label for="policeOpinion">Police Opinion</label>
							<textarea class="form-control" rows="3" name="policeOpinion" id="policeOpinion"></textarea>
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
	$(document).on('click', '.add-field', function () {
		var fieldHTML = `<div class="row dynamic">
                            <div class="form-group col-md-3">
                                <label for="vehicleLicPlate">Vehicle LIC. Plate No<b class="text-danger">*</b></label>
                                <input class="form-control" type="text" name="vehicleLicPlate[]" id="vehicleLicPlate" placeholder="Enter Vehicle LIC Plate Number" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="chassisNo">Vehicle VIN./Chassis No.<b class="text-danger">*</b></label>
                                <input class="form-control" type="text" name="chassisNo[]" id="chassisNo" placeholder="Enter Chassis Number" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="licensePlateClass">Vehicle License Plate Class</label>
                                <select class="form-control" name="licensePlateClass[]" id="licensePlateClass">
                                    <option value="">Select Plate Class</option>
                                    <option value="A - Motor Cycle">A - Motor Cycle</option>
                                    <option value="A1 - Quad Bike">A1 - Quad Bike</option>
                                    <option value="A2 - Scooter">A2 - Scooter</option>
                                    <option value="B - Private Motor Vehicle">B - Private Motor Vehicle</option>
                                    <option value="C - Light Public Service Vehicle(Up to 17 Passengers)">C - Light Public Service Vehicle(Up to 17 Passengers)</option>
                                    <option value="C1 - Light Public Service Vehicle(Over 17 Passengers)">C1 - Light Public Service Vehicle(Over 17 Passengers)</option>
                                    <option value="D - Light Goods Vehicle (GROSS Weight Up to 7000Kgs)">D - Light Goods Vehicle (GROSS Weight Up to 7000Kgs)</option>
                                    <option value="D1 - Heavy Goods Vehicle (GROSS Weight Exceeding 7000Kgs)">D1 - Heavy Goods Vehicle (GROSS Weight Exceeding 7000Kgs)</option>
                                    <option value="E - Trailer/Tractor">E - Trailer/Tractor</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="vehicleOwner">Vehicle Owner </label>
                                <input class="form-control" type="text" name="vehicleOwner[]" id="vehicleOwner" placeholder="Vehicle Owner Name">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="driverName">Driver at Time of Accident + I.D. #</label>
                                <input class="form-control" type="text" name="driverName[]" id="driverName" placeholder="Driver Name + I.D. #">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="insurerId">Select Insurer</label>
                                <select style="width: 100%" id="insurerId" name="insurerId[]" class="form-control selectInsurer"></select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="acceptLiability">Did This Driver Accept Liability?</label>
                                <select class="form-control" name="acceptLiability[]" id="acceptLiability">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
							<div class="form-group col-md-3">
								<br>
							</div>
                            <div class="form-group col-md-2">
                                <button type="button" class="btn btn-sm btn-success add-field">Add</button>
                                <button type="button" class="btn btn-sm btn-danger remove-field">Remove</button>
                            </div>
                        </div>`;
		$('.dynamic:last').after(fieldHTML);
		initializeSelect2();
	});

	// Remove field
	$(document).on('click', '.remove-field', function () {
		if ($('.dynamic').length > 1) {
			$(this).closest('.dynamic').remove();
		} else {
			toastr.warning("At least one vehicle detail must be present.");
		}
	});

	$(document).ready(function () {
		initializeSelect2();
	});

	$('#form').submit(function (e) {
		$('.selectInsurer').each(function () {
			console.log($(this).val());
			if ($(this).val() === null || $(this).val() === "") {
				$(this).append($('<option>', {
					value: 0,
					text: '0'
				})).select2();
			}
		});
	});

	function initializeSelect2() {
		$(".selectInsurer").select2({
			placeholder: "Select Insurer",
			ajax: {
				url: '<?= police_url("getInsurerSearch") ?>',
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
	}
</script>
