<div class="modal fade in" id="modal-default" style="display: block; overflow: auto;">
	<div class="modal-dialog modal-lg" style="width: 70%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-sm btn-danger pull-right" id="closeBtn" data-dismiss="modal"
						aria-label="Close">
					Close
				</button>
				<h4 class="modal-title"><b> Update Accident Details</b></h4>
			</div>
			<form id="form" action="<?= police_url('updateDetail/' . $data->id) ?>" method="post"
				  enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-2">
							<label for="accidentDate">Accident Date <b class="text-danger">*</b></label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" name="accidentDate" id="accidentDate"
									   value="<?= date('d M Y', strtotime($data->accidentDate)) ?>" required>
							</div>
						</div>
						<div class="form-group col-md-2">
							<label for="accidentTime">Accident Time <b class="text-danger">*</b></label>
							<input class="form-control" type="time" name="accidentTime"
								   value="<?= date('H:i', strtotime($data->accidentTime)) ?>"
								   id="accidentTime" required>
						</div>
						<div class="form-group col-md-3">
							<label for="locationOfAccident">Place/Location of Accident </label>
							<input class="form-control" type="text" name="locationOfAccident" id="locationOfAccident"
								   placeholder="Location" value="<?= $data->locationOfAccident ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="roadCondition">Road Condition </label>
							<input class="form-control" type="text" name="roadCondition" id="roadCondition"
								   placeholder="Road Condition" value="<?= $data->roadCondition ?>">
						</div>
					</div>
					<hr>
					<?php if ($vehicleDetails) {
						foreach ($vehicleDetails as $vehicleDetail) { ?>
							<div class="row dynamic">
								<div class="form-group col-md-3">
									<label for="vehicleLicPlate">Vehicle LIC. Plate No<b
												class="text-danger">*</b></label>
									<input class="form-control" type="text" name="vehicleLicPlate[]"
										   id="vehicleLicPlate" value="<?= $vehicleDetail->vehicleLicPlate ?>"
										   placeholder="Enter Vehicle LIC Plate Number" required>
								</div>
								<div class="form-group col-md-3">
									<label for="chassisNo">Vehicle VIN./Chassis No.<b class="text-danger">*</b></label>
									<input class="form-control" type="text" name="chassisNo[]" id="chassisNo"
										   placeholder="Enter Chassis Number" value="<?= $vehicleDetail->chassisNo ?>"
										   required>
								</div>
								<div class="form-group col-md-3">
									<label for="licensePlateClass">Vehicle License Plate Class</label>
									<select class="form-control" name="licensePlateClass[]" id="licensePlateClass">
										<option value="">Select Plate Class</option>
										<option <?= $vehicleDetail->licensePlateClass == 'A - Motor Cycle' ? 'selected' : '' ?>
												value="A - Motor Cycle">A - Motor Cycle
										</option>
										<option <?= $vehicleDetail->licensePlateClass == 'A1 - Quad Bike' ? 'selected' : '' ?>
												value="A1 - Quad Bike">A1 - Quad Bike
										</option>
										<option <?= $vehicleDetail->licensePlateClass == 'A2 - Scooter' ? 'selected' : '' ?>
												value="">A2 - Scooter
										</option>
										<option <?= $vehicleDetail->licensePlateClass == 'B - Private Motor Vehicle' ? 'selected' : '' ?>
												value="B - Private Motor Vehicle">B - Private Motor Vehicle
										</option>
										<option <?= $vehicleDetail->licensePlateClass == 'C - Light Public Service Vehicle(Up to 17 Passengers)' ? 'selected' : '' ?>
												value="C - Light Public Service Vehicle(Up to 17 Passengers)">C - Light
											Public
											Service Vehicle(Up to 17 Passengers)
										</option>
										<option <?= $vehicleDetail->licensePlateClass == 'C1 - Light Public Service Vehicle(Over 17 Passengers)' ? 'selected' : '' ?>
												value="C1 - Light Public Service Vehicle(Over 17 Passengers)">C1 - Light
											Public
											Service Vehicle(Over 17 Passengers)
										</option>
										<option <?= $vehicleDetail->licensePlateClass == 'D - Light Goods Vehicle (GROSS Weight Up to 7000Kgs)' ? 'selected' : '' ?>
												value="D - Light Goods Vehicle (GROSS Weight Up to 7000Kgs)">D - Light
											Goods
											Vehicle (GROSS Weight Up to 7000Kgs)
										</option>
										<option <?= $vehicleDetail->licensePlateClass == 'D1 - Heavy Goods Vehicle (GROSS Weight Exceeding 7000Kgs)' ? 'selected' : '' ?>
												value="D1 - Heavy Goods Vehicle (GROSS Weight Exceeding 7000Kgs)">D1 -
											Heavy
											Goods Vehicle (GROSS Weight Exceeding 7000Kgs)
										</option>
										<option <?= $vehicleDetail->licensePlateClass == 'E - Trailer/Tractor' ? 'selected' : '' ?>
												value="E - Trailer/Tractor">E - Trailer/Tractor
										</option>
									</select>
								</div>
								<div class="form-group col-md-3">
									<label for="vehicleOwner">Vehicle Owner </label>
									<input class="form-control" type="text" name="vehicleOwner[]" id="vehicleOwner"
										   placeholder="Vehicle Owner Name" value="<?= $vehicleDetail->vehicleOwner ?>">
								</div>
								<div class="form-group col-md-3">
									<label for="driverName">Driver at Time of Accident + I.D. #</label>
									<input class="form-control" type="text" name="driverName[]" id="driverName"
										   placeholder="Driver Name + I.D. #" value="<?= $vehicleDetail->driverName ?>">
								</div>
								<div class="form-group col-md-3">
									<label for="insurerId">Insurer </label>
									<select style="width: 100%" id="insurerId" name="insurerId[]"
											class="form-control selectInsurer">
										<option selected
												value="<?= $vehicleDetail->insurerId ?>"><?= $vehicleDetail->insurer ?></option>
									</select>
								</div>
								<div class="form-group col-md-3">
									<label for="acceptLiability">Did This Driver Accept Liability?</label>
									<select class="form-control" name="acceptLiability[]" id="acceptLiability">
										<option <?= $vehicleDetail->acceptLiability == 'Yes' ? 'selected' : '' ?>
												value="Yes">Yes
										</option>
										<option <?= $vehicleDetail->acceptLiability == 'No' ? 'selected' : '' ?>
												value="No">No
										</option>
									</select>
								</div>
								<div class="form-group col-md-2">
									<br>
									<button type="button" class="btn btn-sm btn-danger remove-field"><i
												class="fa fa-trash"></i>
									</button>
								</div>
								<div class="form-group col-md-1"></div>
							</div>
						<?php }
					} ?>
					<hr>
					<div class="form-group text-center">
						<button type="button" class="btn btn-md btn-info add-field">Add Vehicle</button>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="accidentDetails">Details Of Accident</label>
							<textarea class="form-control" rows="3" name="accidentDetails"
									  id="accidentDetails"><?= $data->accidentDetails ?></textarea>
						</div>
						<div class="form-group col-md-6">
							<label for="policeOpinion">Police Opinion</label>
							<textarea class="form-control" rows="3" name="policeOpinion"
									  id="policeOpinion"><?= $data->policeOpinion ?></textarea>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="form-group col-md-12 text-center">
							<button type="submit" class="btn btn-success">Update</button>
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

	$('#closeBtn').on('click', function () {
		$("#modal-default").modal("hide");
	});

	function initializeSelect2() {
		$(".selectInsurer").select2({
			placeholder: "Select Insurer",
			dropdownParent: $('#remoteModal1'),
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

	$(document).ready(function () {
		initializeSelect2();
	});
	const getFieldHTML = () => `<div class="row dynamic">
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
                                <button type="button" class="btn btn-sm btn-danger remove-field"><i class="fa fa-trash"></i></button>
                            </div>
 							<div class="form-group col-md-1"></div>
                        </div>`;

	$(document).on('click', '.add-field', function () {
		$('.dynamic:last').after(getFieldHTML());
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
</script>
