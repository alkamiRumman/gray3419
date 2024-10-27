<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<a href="<?= admin_url('users') ?>">
							<div class="small-box bg-fuchsia">
								<div class="inner">
									<h3><?= $totalUser ?></h3>
									<p>Total User</p>
								</div>
								<div class="icon">
									<i class="fa fa-users"></i>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3">
						<a href="<?= admin_url('customers') ?>">

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

					<!--					<div class="col-md-3">-->
					<!--						<div class="small-box bg-aqua">-->
					<!--							<div class="inner">-->
					<!--								<h3>--><? //= 1500 ?><!--</h3>-->
					<!--								<p>Monthly Sale</p>-->
					<!--							</div>-->
					<!--							<div class="icon">-->
					<!--								<i class="fa fa-dollar"></i>-->
					<!--							</div>-->
					<!--						</div>-->
					<!--					</div>-->
					<!--					<a href="--><? //= admin_url('dailySales') ?><!--">-->
					<!--						<div class="col-md-3">-->
					<!--							<div class="small-box bg-green">-->
					<!--								<div class="inner">-->
					<!--									<h3>--><? //= 150 ?><!--</h3>-->
					<!--									<p>Today's Sale</p>-->
					<!--								</div>-->
					<!--								<div class="icon">-->
					<!--									<i class="fa fa-dollar"></i>-->
					<!--								</div>-->
					<!--							</div>-->
					<!--						</div>-->
					<!--					</a>-->
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
<script>
	var cData = JSON.parse(`<?php echo $data1; ?>`);
	var html = '';
	var totalIncome = 0;
	var totalSpend = 0;
	var totalSalary = 0;
	var totalProfit = 0;
	html += '<table class="table table-striped table-bordered dtr-inline" style="width: 100% !important;">' +
		'<thead class="bg-primary">' +
		'<tr>' +
		'<th>Month Name</th>' +
		'<th style="background-color: rgba(75, 192, 192, 0.7); color: white">Total Income</th>' +
		'<th style="background-color: rgba(255, 99, 132, 0.7); color: white">Total Spend</th>' +
		'<th style="background-color: rgba(255, 206, 86, 0.7); color: white">Total Salary</th>' +
		'<th>Profit/Loss</th>' +
		'</tr>' +
		'</thead><tbody>';
	for (var i = 0; i < cData.label.length; i++) {
		totalIncome += parseFloat(cData.totalIncome[i]);
		totalSpend += parseFloat(cData.totalSpend[i]);
		totalSalary += parseFloat(cData.totalSalary[i]);
		totalProfit += parseFloat(cData.totalProfit[i]);
		html += '<tr>' +
			'<th>' + cData.label[i] + '</th>' +
			'<td>' + cData.totalIncome[i] + '</td>' +
			'<td>' + cData.totalSpend[i] + '</td>' +
			'<td>' + cData.totalSalary[i] + '</td>' +
			'<td class="' + (cData.totalProfit[i] < 0 ? 'text-bold text-danger' : '') + '">' + cData.totalProfit[i] + '</td>' +
			'</tr>';
	}
	html += '<tr><th class="text-right text-bold">Total</th><th class="text-bold">£ ' + totalIncome.toFixed(2) + '</th>' +
		'<th class="text-bold">£ ' + totalSpend.toFixed(2) + '</th>' +
		'<th class="text-bold">£ ' + totalSalary.toFixed(2) + '</th><th class="text-bold">£ ' + totalProfit.toFixed(2) + '</th></tbody></table>';
	$('.chartTable').append(html);
	var ctx = document.getElementById("chartContainer");
	var chart = new Chart(ctx, {
		type: "bar",
		options: {
			responsive: true,
			maintainAspectRatio: false,
			scales: {
				xAxes: [{
					barPercentage: 1.0
				}],
				yAxes: [{
					ticks: {
						beginAtZero: true,
						aspectRatio: false,
						callback: function (value) {
							return '£' + value
						}
					}
				}]
			},
			gridLines: {
				display: true
			},
			responsive: true,
			legend: {
				display: true,
			},
			title: {
				display: true,
				position: "top",
				text: "Monthly Total Sale vs Spend",
				fontSize: 18,
				fontColor: "#111"
			},
		},
		data: {
			labels: cData.label,
			datasets: [
				{
					type: "bar",
					backgroundColor: 'rgba(75, 192, 192, 0.7)',
					borderColor: 'rgba(75, 192, 192, 1)',
					borderWidth: 1,
					barThickness: 1,
					label: "Income",
					data: cData.totalIncome
				},
				{
					type: "bar",
					backgroundColor: 'rgba(255, 99, 132, 0.7)',
					borderColor: 'rgba(255, 99, 132, 1)',
					borderWidth: 1,
					barThickness: 1,
					label: "Spend",
					data: cData.totalSpend
				},
				{
					type: "bar",
					backgroundColor: 'rgba(255, 206, 86, 0.7)',
					borderColor: 'rgba(255, 206, 86, 1)',
					borderWidth: 1,
					barThickness: 1,
					label: "Salary",
					data: cData.totalSalary
				},
				{
					type: "line",
					label: "Profit/Loss",
					data: cData.totalProfit,
					borderColor: 'rgb(40,67,137)',
					tension: 0.1,
					pointRadius: 3,
					borderWidth: 3,
					fill: false
				}
			]
		}
	});

	$('#year').on('change', function () {
		var year = $('#year').val();
		$('#chartContainer').remove();
		$('.chartSpace pre').remove();
		$('.chartTable').remove();
		$(".chartTableClass").append("<div class='chartTable'></div>");
		$(".chartSpace").append("<canvas id='chartContainer' style='height: 400px; width: 100%;'></canvas>");
		$.ajax({
			url: "<?= admin_url('getFilterDashboardData/') ?>" + year,
			method: "POST",
			// data: {email: email},
			success: function (data) {
				console.log(data);
				if (data) {
					var cData = JSON.parse(data);
					var html = '';
					var totalIncome = 0;
					var totalSpend = 0;
					var totalSalary = 0;
					var totalProfit = 0;
					html += '<table class="table table-striped table-bordered dtr-inline" style="width: 100% !important;">' +
						'<thead class="bg-primary">' +
						'<tr>' +
						'<th>Month Name</th>' +
						'<th style="background-color: rgba(75, 192, 192, 0.7); color: white">Total Income</th>' +
						'<th style="background-color: rgba(255, 99, 132, 0.7); color: white">Total Spend</th>' +
						'<th style="background-color: rgba(255, 206, 86, 0.7); color: white">Total Salary</th>' +
						'<th>Profit/Loss</th>' +
						'</tr>' +
						'</thead><tbody>';
					for (var i = 0; i < cData.label.length; i++) {
						totalIncome += parseFloat(cData.totalIncome[i]);
						totalSpend += parseFloat(cData.totalSpend[i]);
						totalSalary += parseFloat(cData.totalSalary[i]);
						totalProfit += parseFloat(cData.totalProfit[i]);
						html += '<tr>' +
							'<th>' + cData.label[i] + '</th>' +
							'<td>' + cData.totalIncome[i] + '</td>' +
							'<td>' + cData.totalSpend[i] + '</td>' +
							'<td>' + cData.totalSalary[i] + '</td>' +
							'<td class="' + (cData.totalProfit[i] < 0 ? 'text-bold text-danger' : '') + '">' + cData.totalProfit[i] + '</td>' +
							'</tr>';
					}
					html += '<tr><th class="text-right text-bold">Total</th><th class="text-bold">£ ' + totalIncome.toFixed(2) + '</th>' +
						'<th class="text-bold">£ ' + totalSpend.toFixed(2) + '</th>' +
						'<th class="text-bold">£ ' + totalSalary.toFixed(2) + '</th>' +
						'<th class="text-bold">£ ' + totalProfit.toFixed(2) + '</th></tbody></table>';
					$('.chartTable').append(html);
					var ctx = document.getElementById("chartContainer");
					var chart = new Chart(ctx, {
						type: "bar",
						options: {
							responsive: true,
							maintainAspectRatio: false,
							scales: {
								xAxes: [{
									barPercentage: 1.0
								}],
								yAxes: [{
									ticks: {
										beginAtZero: true,
										aspectRatio: false,
										callback: function (value) {
											return '£' + value
										}
									}
								}]
							},
							gridLines: {
								display: true
							},
							responsive: true,
							legend: {
								display: true,
							},
							title: {
								display: true,
								position: "top",
								text: "Monthly Total Sale vs Spend",
								fontSize: 18,
								fontColor: "#111"
							},
						},
						data: {
							labels: cData.label,
							datasets: [
								{
									type: "bar",
									backgroundColor: 'rgba(75, 192, 192, 0.7)',
									borderColor: 'rgba(75, 192, 192, 1)',
									borderWidth: 1,
									barThickness: 1,
									label: "Income",
									data: cData.totalIncome
								},
								{
									type: "bar",
									backgroundColor: 'rgba(255, 99, 132, 0.7)',
									borderColor: 'rgba(255, 99, 132, 1)',
									borderWidth: 1,
									barThickness: 1,
									label: "Spend",
									data: cData.totalSpend
								},
								{
									type: "bar",
									backgroundColor: 'rgba(255, 206, 86, 0.7)',
									borderColor: 'rgba(255, 206, 86, 1)',
									borderWidth: 1,
									barThickness: 1,
									label: "Salary",
									data: cData.totalSalary
								},
								{
									type: "line",
									label: "Profit/Loss",
									data: cData.totalProfit,
									borderColor: 'rgb(40,67,137)',
									tension: 0.1,
									pointRadius: 3,
									borderWidth: 3,
									fill: false
								}
							]
						}
					})
				} else {
					$('#chartContainer').remove();
					$(".chartSpace").append("<pre><h4 class='text-danger text-center'>No records found!</h4></pre>");
				}
			}
		});
	});
</script>
