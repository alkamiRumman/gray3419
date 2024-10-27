<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<a href="<?= insurer_url('customers') ?>">
							<div class="small-box bg-orange">
								<div class="inner">
									<h3><?= 150 ?></h3>
									<p>Total Customer</p>
								</div>
								<div class="icon">
									<i class="fa fa-user-secret"></i>
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
			<div class="box-body">
				<div class="row">
					<div class="form-group col-md-2">
						<label for="year"> Select Year </label>
						<select class="form-control" name="year" id="year">
							<?php for ($i = date('Y'); $i > date('Y') - 11; $i--) { ?>
								<option <?= date('Y') == $i ? 'selected' : '' ?> value="<?= $i ?>"><?= $i ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="chartSpace">
							<canvas id="chartContainer" style="height: 400px; width: 100%;"></canvas>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top: 10px">
					<div class="col-md-3"></div>
					<div class="col-md-6 chartTableClass">
						<div class="chartTable">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
