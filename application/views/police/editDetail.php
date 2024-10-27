<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-lg" style="width: 80%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal" aria-label="Close">
					Close
				</button>
				<h4 class="modal-title"><b>Update Accident Details</b></h4>
			</div>
			<form role="form" action="<?= police_url('updateDetail/' . $data->id) ?>" method="post"
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
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
								<input class="form-control" type="time" name="accidentTime" id="accidentTime"
									   value="<?= $data->accidentTime ?>" required>
							</div>
						</div>
						<div class="form-group col-md-3">
							<label for="vehicleLicPlate">Vehicle LIC. Plate No<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="vehicleLicPlate" id="vehicleLicPlate"
								   value="<?= $data->vehicleLicPlate ?>" required>
						</div>
						<div class="form-group col-md-3">
							<label for="chassisNo">Vehicle VIN./Chassis No.<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="chassisNo" id="chassisNo"
								   value="<?= $data->chassisNo ?>" required>
						</div>
						<div class="form-group col-md-2">
							<label for="licensePlateClass">License Plate Class</label>
							<select class="form-control" name="licensePlateClass" id="licensePlateClass">
								<option <?= $data->licensePlateClass == '' ? 'selected' : '' ?> value="">Select Plate
									Class
								</option>
								<option <?= $data->licensePlateClass == 'A - Motor Cycle' ? 'selected' : '' ?>
										value="A - Motor Cycle">A - Motor Cycle
								</option>
								<option <?= $data->licensePlateClass == 'A1 - Quad Bike' ? 'selected' : '' ?>
										value="A1 - Quad Bike">A1 - Quad Bike
								</option>
								<option <?= $data->licensePlateClass == 'A2 - Scooter' ? 'selected' : '' ?>
										value="A2 - Scooter">A2 - Scooter
								</option>
								<option <?= $data->licensePlateClass == 'B - Private Motor Vehicle' ? 'selected' : '' ?>
										value="B - Private Motor Vehicle">B - Private Motor Vehicle
								</option>
								<option <?= $data->licensePlateClass == 'C - Light Public Service Vehicle(Up to 17 Passengers)' ? 'selected' : '' ?>
										value="C - Light Public Service Vehicle(Up to 17 Passengers)">C - Light Public
									Service Vehicle(Up to 17 Passengers)
								</option>
								<option <?= $data->licensePlateClass == 'C1 - Light Public Service Vehicle(Over 17 Passengers)' ? 'selected' : '' ?>
										value="C1 - Light Public Service Vehicle(Over 17 Passengers)">C1 - Light Public
									Service Vehicle(Over 17 Passengers)
								</option>
								<option <?= $data->licensePlateClass == 'D - Light Goods Vehicle (GROSS Weight Up to 7000Kgs)' ? 'selected' : '' ?>
										value="D - Light Goods Vehicle (GROSS Weight Up to 7000Kgs)">D - Light Goods
									Vehicle (GROSS Weight Up to 7000Kgs)
								</option>
								<option <?= $data->licensePlateClass == 'D1 - Heavy Goods Vehicle (GROSS Weight Exceeding 7000Kgs)' ? 'selected' : '' ?>
										value="D1 - Heavy Goods Vehicle (GROSS Weight Exceeding 7000Kgs)">D1 - Heavy
									Goods Vehicle (GROSS Weight Exceeding 7000Kgs)
								</option>
								<option <?= $data->licensePlateClass == 'E - Trailer/Tractor' ? 'selected' : '' ?>
										value="E - Trailer/Tractor">E - Trailer/Tractor
								</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="locationOfAccident">Place/Location of Accident </label>
							<input class="form-control" type="text" name="locationOfAccident" id="locationOfAccident"
								   value="<?= $data->locationOfAccident ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="roadCondition">Road Condition </label>
							<input class="form-control" type="text" name="roadCondition" id="roadCondition"
								   value="<?= $data->roadCondition ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="vehicleOwner">Vehicle Owner </label>
							<input class="form-control" type="text" name="vehicleOwner" id="vehicleOwner"
								   value="<?= $data->vehicleOwner ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="driverName">Driver at Time of Accident</label>
							<input class="form-control" type="text" name="driverName" id="driverName"
								   value="<?= $data->driverName ?>">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-2">
							<label for="driverOccupation">Occupation of Driver </label>
							<input class="form-control" type="text" name="driverOccupation" id="driverOccupation"
								   value="<?= $data->driverOccupation ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="insurerId">Select Insurer</label>
							<select style="width: 100%" id="insurerId" name="insurerId"
									class="form-control selectInsurer">
								<option value="<?= $data->insurerId ?>" selected><?= $data->insurer ?></option>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="acceptLiability">Did This Driver Accept Liability?</label>
							<select class="form-control" name="acceptLiability" id="acceptLiability">
								<option <?= $data->acceptLiability == 'Yes' ? 'selected' : '' ?> value="Yes">Yes
								</option>
								<option <?= $data->acceptLiability == 'No' ? 'selected' : '' ?> value="No">No</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="policeOpinion">Police Opinion</label>
							<textarea class="form-control" rows="3" name="policeOpinion"
									  id="policeOpinion"><?= $data->policeOpinion ?></textarea>
						</div>
						<div class="form-group col-md-6">
							<label for="accidentDetails">Details Of Accident</label>
							<textarea class="form-control" rows="3" name="accidentDetails"
									  id="accidentDetails"><?= $data->accidentDetails ?></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="form-group col-md-12 text-center">
							<button type="submit" class="btn btn-info">Update</button>
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

	$(document).ready(function () {
		$(".selectInsurer").select2({
			placeholder: "Select Insurer",
			dropdownParent: $("#remoteModal1"),
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
	});
</script>
