<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-lg" style="width: 80%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal" aria-label="Close">
					Close
				</button>
				<h4 class="modal-title"><b>Update Accident Details</b></h4>
			</div>
			<form role="form" action="<?= insurer_url('updateDetail/' . $data->id) ?>" method="post"
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
									   value="<?= date('d M Y', strtotime($data->accidentDate)) ?>" readonly>
							</div>
						</div>
						<div class="form-group col-md-2">
							<label for="accidentTime">Accident Time <b class="text-danger">*</b></label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
								<input class="form-control" type="time" name="accidentTime" id="accidentTime"
									   value="<?= $data->accidentTime ?>" readonly>
							</div>
						</div>
						<div class="form-group col-md-3">
							<label for="vehicleLicPlate">Vehicle LIC. Plate No<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="vehicleLicPlate" id="vehicleLicPlate"
								   value="<?= $data->vehicleLicPlate ?>" readonly>
						</div>
						<div class="form-group col-md-3">
							<label for="chassisNo">Vehicle VIN./Chassis No.<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="chassisNo" id="chassisNo"
								   value="<?= $data->chassisNo ?>" readonly>
						</div>
						<div class="form-group col-md-2">
							<label for="licensePlateClass">License Plate Class</label>
							<input class="form-control" type="text" name="licensePlateClass" id="licensePlateClass"
								   value="<?= $data->licensePlateClass ?>" readonly>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="locationOfAccident">Place/Location of Accident </label>
							<input class="form-control" type="text" name="locationOfAccident" id="locationOfAccident"
								   value="<?= $data->locationOfAccident ?>" readonly>
						</div>
						<div class="form-group col-md-3">
							<label for="driverOccupation">Occupation of Driver </label>
							<input class="form-control" type="text" name="driverOccupation" id="driverOccupation"
								   value="<?= $data->driverOccupation ?>">
						</div>
						<div class="form-group col-md-2">
							<label for="annualPremium">Annual Premium </label>
							<input class="form-control" type="number" step="any" name="annualPremium" id="annualPremium"
								   value="<?= $data->annualPremium ?>">
						</div>
						<div class="form-group col-md-2">
							<label for="deductible">Deductible/Excess </label>
							<input class="form-control" type="number" step="any" name="deductible" id="deductible"
								   value="<?= $data->deductible ?>">
						</div>
						<div class="form-group col-md-2">
							<label for="annualPremiumInsurer">Annual Premium </label>
							<input class="form-control" type="number" step="any" name="annualPremiumInsurer"
								   id="annualPremiumInsurer" value="<?= $data->annualPremiumInsurer ?>">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label for="ownDamageDetails">Details Of Own Damage</label>
							<input class="form-control" type="text" name="ownDamageDetails"
								   value="<?= $data->ownDamageDetails ?>" id="ownDamageDetails">
						</div>
						<div class="form-group col-md-4">
							<label for="damageDiagram">Vehicle Damage Diagram</label>
							<input class="form-control" type="text" name="damageDiagram"
								   value="<?= $data->damageDiagram ?>" id="damageDiagram">
						</div>
						<div class="form-group col-md-4">
							<label for="partialDamage">Partial Damage of Total led</label>
							<input class="form-control" type="text" name="partialDamage"
								   value="<?= $data->partialDamage ?>" id="partialDamage">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<table class="table">
								<tbody>
								<tr>
									<td><label for="conviction">Charge/Conviction regarding this accident </label></td>
									<td><input class="form-control numeric-input" type="number" step="any"
											   name="conviction" id="conviction" value="<?= $data->conviction ?>"></td>
								</tr>
								<tr>
									<td><label for="ownDamagePayout">Own Damage Payout by insurer</label></td>
									<td><input class="form-control numeric-input" type="number" step="any"
											   name="ownDamagePayout" id="ownDamagePayout"
											   value="<?= $data->ownDamagePayout ?>"></td>
								</tr>
								<tr>
									<td><label for="thirdPartyPayout">Third Party Property Payout</label></td>
									<td><input class="form-control numeric-input" type="number" step="any"
											   name="thirdPartyPayout" id="thirdPartyPayout"
											   value="<?= $data->thirdPartyPayout ?>"></td>
								</tr>
								<tr>
									<td><label for="thirdPartyBodilyPayout">Third Party Bodily Injury Payout by
											insurer</label></td>
									<td><input class="form-control numeric-input" type="number" step="any"
											   name="thirdPartyBodilyPayout" id="thirdPartyBodilyPayout"
											   value="<?= $data->thirdPartyBodilyPayout ?>"></td>
								</tr>
								<tr>
									<td><label for="thirdPartyDeathPayout">Third Party Death Payout by insurer</label>
									</td>
									<td><input class="form-control numeric-input" type="number" step="any"
											   name="thirdPartyDeathPayout" id="thirdPartyDeathPayout"
											   value="<?= $data->thirdPartyDeathPayout ?>"></td>
								</tr>
								<tr>
									<td><label for="totalThirdPartyPayout">Total Third Party Payout by insurer</label>
									</td>
									<td><input class="form-control" type="number" step="any"
											   value="<?= $data->totalThirdPartyPayout ?>"
											   name="totalThirdPartyPayout" id="totalThirdPartyPayout" readonly></td>
								</tr>
								<tr>
									<td><label for="total">Total Claim Paid for Own Damage and Third Party
											Damage</label></td>
									<td><input class="form-control" type="number" step="any" name="total" id="total"
											   value="<?= $data->total ?>"
											   readonly></td>
								</tr>
								</tbody>
							</table>
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
</script>
