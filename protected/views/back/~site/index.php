<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>
<div id="page-heading">
	<h1>Dashboard</h1>
</div>
<div class="container">
	<!-- Statisctic -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 clearfix">
							<h4 style="margin:0 0 10px" class="pull-left">Statistik Website <small>(overview)</small></h4>
							<div class="pull-right">
								<a class="btn btn-default-alt btn-sm" href="javascript:;"><i class="fa fa-refresh"></i></a>
								<a class="btn btn-default-alt btn-sm" href="javascript:;"><i class="fa fa-wrench"></i></a>
								<a class="btn btn-default-alt btn-sm" href="javascript:;"><i class="fa fa-cog"></i></a>
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-2">
							<div style="width: 90px; margin: 0 auto; padding: 10px 0 6px;" id="indexvisits"><canvas style="display: inline-block; width: 90px; height: 45px; vertical-align: top;" width="90" height="45"></canvas></div>
							<h3 style="text-align: center; margin: 0; color: #808080;">7,451</h3>
							<p style="text-align: center; margin: 0;">Visits</p>
							<hr class="hidden-md hidden-lg">
						</div>
						<div class="col-xs-6 col-sm-6 col-md-2">
							<div style="width: 90px; margin: 0 auto; padding: 10px 0 6px;" id="indexpageviews"><canvas style="display: inline-block; width: 90px; height: 45px; vertical-align: top;" width="90" height="45"></canvas></div>
							<h3 style="text-align: center; margin: 0; color: #808080;">35,711</h3>
							<p style="text-align: center; margin: 0;">Page Views</p>
							<hr class="hidden-md hidden-lg">
						</div>
						<div class="col-xs-6 col-sm-6 col-md-2">
							<div style="width: 90px; margin: 0 auto; padding: 10px 0 6px;" id="indexpagesvisit"><canvas style="display: inline-block; width: 90px; height: 45px; vertical-align: top;" width="90" height="45"></canvas></div>
							<h3 style="text-align: center; margin: 0; color: #808080;">6.92</h3>
							<p style="text-align: center; margin: 0;">Pages / Visit</p>
							<hr class="hidden-md hidden-lg">
						</div>
						<div class="col-xs-6 col-sm-6 col-md-2">
							<div style="width: 90px; margin: 0 auto; padding: 10px 0 6px;" id="indexavgvisit"><canvas style="display: inline-block; width: 90px; height: 45px; vertical-align: top;" width="90" height="45"></canvas></div>
							<h3 style="text-align: center; margin: 0; color: #808080;">00:04:17</h3>
							<p style="text-align: center; margin: 0;">Average Visit Time</p>
							<hr class="hidden-md hidden-lg">
						</div>
						<div class="col-xs-6 col-sm-6 col-md-2">
							<div style="width: 90px; margin: 0 auto; padding: 10px 0 6px;" id="indexnewvisits"><canvas style="display: inline-block; width: 90px; height: 45px; vertical-align: top;" width="90" height="45"></canvas></div>
							<h3 style="text-align: center; margin: 0; color: #808080;">71.27%</h3>
							<p style="text-align: center; margin: 0;">New Visits</p>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-2">
							<div style="width: 90px; margin: 0 auto; padding: 10px 0 6px;" id="indexbouncerate"><canvas style="display: inline-block; width: 90px; height: 45px; vertical-align: top;" width="90" height="45"></canvas></div>
							<h3 style="text-align: center; margin: 0; color: #808080;">31.08%</h3>
							<p style="text-align: center; margin: 0;">Bounce Rate</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Latest News -->
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>User Daftar Terakhir</h4>
					<div class="options">
						<a href="javascript:;"><i class="fa fa-cog"></i></a>
						<a href="javascript:;"><i class="fa fa-wrench"></i></a> 
						<a class="panel-collapse" href="javascript:;"><i class="fa fa-chevron-down"></i></a>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table style="margin-bottom: 0px;" class="table">
							<thead>
								<tr>
									<th class="col-xs-1 col-sm-1"><input type="checkbox" id="select-all"></th>
									<th class="col-xs-9 col-sm-3">User ID</th>
									<th class="col-sm-6 hidden-xs">Email Address</th>
									<th class="col-xs-2 col-sm-2">Status</th>
								</tr>
							</thead>
							<tbody class="selects">
								<tr>
									<td><input type="checkbox" class=""></td>
									<td>cranston</td>
									<td class="hidden-xs">cranstonb@gnail.com</td>
									<td><span class="label label-success">Approved</span></td>
								</tr>
								<tr>
									<td><input type="checkbox" class=""></td>
									<td>aaron</td>
									<td class="hidden-xs">ppaul@lime.com</td>
									<td><span class="label label-grape">Pending</span></td>
								</tr>
								<tr>
									<td><input type="checkbox" class=""></td>
									<td>norris</td>
									<td class="hidden-xs">j.norris@gnail.com</td>
									<td><span class="label label-warning">Suspended</span></td>
								</tr>
								<tr>
									<td><input type="checkbox" class=""></td>
									<td>gunner</td>
									<td class="hidden-xs">gunner@outluk.com</td>
									<td><span class="label label-danger">Blocked</span></td>
								</tr>
								<tr>
									<td><input type="checkbox" class=""></td>
									<td>mrford</td>
									<td class="hidden-xs">fordm@gnail.com</td>
									<td><span class="label label-grape">Pending</span></td>
								</tr>
								<tr>
									<td><input type="checkbox" class=""></td>
									<td>stewrtt</td>
									<td class="hidden-xs">swttrs@outluk.com</td>
									<td><span class="label label-danger">Blocked</span></td>
								</tr>
							</tbody>
							<tfoot>
								<tr class="active">
									<td class="text-left" colspan="4">
										<label style="margin-bottom:0" for="action">Action </label>
										<select name="action">
											<option value="Edit">Edit</option>
											<option value="Aprove">Aprove</option>
											<option value="Move">Move</option>
											<option value="Delete">Delete</option>
										</select>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Komentar Terakhir</h4>
					<div class="options">
						<a href="javascript:;"><i class="fa fa-cog"></i></a>
						<a href="javascript:;"><i class="fa fa-wrench"></i></a> 
						<a class="panel-collapse" href="javascript:;"><i class="fa fa-chevron-down"></i></a>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table style="margin-bottom: 0px;" class="table">
							<thead>
								<tr>
									<th class="col-xs-1 col-sm-1"><input type="checkbox" id="select-all"></th>
									<th class="col-xs-9 col-sm-3">User ID</th>
									<th class="col-sm-6 hidden-xs">Email Address</th>
									<th class="col-xs-2 col-sm-2">Status</th>
								</tr>
							</thead>
							<tbody class="selects">
								<tr>
									<td><input type="checkbox" class=""></td>
									<td>cranston</td>
									<td class="hidden-xs">cranstonb@gnail.com</td>
									<td><span class="label label-success">Approved</span></td>
								</tr>
								<tr>
									<td><input type="checkbox" class=""></td>
									<td>aaron</td>
									<td class="hidden-xs">ppaul@lime.com</td>
									<td><span class="label label-grape">Pending</span></td>
								</tr>
								<tr>
									<td><input type="checkbox" class=""></td>
									<td>norris</td>
									<td class="hidden-xs">j.norris@gnail.com</td>
									<td><span class="label label-warning">Suspended</span></td>
								</tr>
								<tr>
									<td><input type="checkbox" class=""></td>
									<td>gunner</td>
									<td class="hidden-xs">gunner@outluk.com</td>
									<td><span class="label label-danger">Blocked</span></td>
								</tr>
								<tr>
									<td><input type="checkbox" class=""></td>
									<td>mrford</td>
									<td class="hidden-xs">fordm@gnail.com</td>
									<td><span class="label label-grape">Pending</span></td>
								</tr>
								<tr>
									<td><input type="checkbox" class=""></td>
									<td>stewrtt</td>
									<td class="hidden-xs">swttrs@outluk.com</td>
									<td><span class="label label-danger">Blocked</span></td>
								</tr>
							</tbody>
							<tfoot>
								<tr class="active">
									<td class="text-left" colspan="4">
										<label style="margin-bottom:0" for="action">Action </label>
										<select name="action">
											<option value="Edit">Edit</option>
											<option value="Aprove">Aprove</option>
											<option value="Move">Move</option>
											<option value="Delete">Delete</option>
										</select>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>