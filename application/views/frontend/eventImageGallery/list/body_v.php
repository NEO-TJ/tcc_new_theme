<div class="container">
	<div class="row">
		<div class="col-xs-12">

		<!-- Search -->
			<div class="panel">
				<div class="row">
					<div class="col-xs-12 col-md-12 col-lg-12 overflow-xy">
						<div class="panel panel-primary">
							<div class="panel-body">
								<div class="row">
								<!-- Filter Section -->
									<div class="col-xs-12 col-md-12 col-lg-12">
										<div class="row">
										<!-- Daterange Sub Section -->
											<div class="col-xs-1 col-md-1 col-lg-1 text-left margin-input">
												<div>ช่วงเวลา : </div>
											</div>
											<div class="col-xs-5 col-md-5 col-lg-5 text-left margin-input">
												<div id="daterange">
													<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
													<span></span> <b class="caret"></b>
												</div>
											</div>
										<!-- Province Sub Section -->
											<div class="col-xs-1 col-md-1 col-lg-1 text-left margin-input">
												<div>จังหวัด : </div>
											</div>
											<div class="col-xs-5 col-md-5 col-lg-5 margin-input">
												<select class="form-control input-require" 
												id="provinceCode">
													<option value="0" selected>เลือกทั้งหมด...</option>
													<?php 
														foreach($dsProvince as $row) {
															echo '<option value=' . $row['ProvinceCode'] .'>'
															. $row['ProvinceName'] . '</option>';
														}
													?>
												</select>
											</div>
										<!-- Amphur Sub Section -->
											<div class="col-xs-1 col-md-1 col-lg-1 text-left margin-input">
												<div>อำเภอ : </div>
											</div>
											<div class="col-xs-5 col-md-5 col-lg-5 margin-input">
												<select class="form-control input-require" 
												id="amphurCode">
													<option value="0" selected>เลือกทั้งหมด...</option>
													<?php 
														foreach($dsAmphur as $row) {
															echo '<option value=' . $row['AmphurCode'] .'>'
															. $row['AmphurName'] . '</option>';
														}
													?>
												</select>
											</div>
										<!-- Project Name Sub Section -->
											<div class="col-xs-1 col-md-1 col-lg-1 text-left margin-input">
												<div>โครงการ : </div>
											</div>
											<div class="col-xs-4 col-md-4 col-lg-4 margin-input">
												<select class="form-control input-require" 
												id="projectName">
													<option value="0" selected>เลือกทั้งหมด...</option>
													<?php 
														foreach($dsProjectName as $row) {
															echo '<option value=' . $row['id'] .'>'
															. $row['Project_Name'] . '</option>';
														}
													?>
												</select>
											</div>
										<!-- Button Section -->
											<div class="col-xs-1 col-md-1 col-lg-1 margin-input">
												<button id="search" class="bg-success">OK</button>
											</div>
										<!-- End Button Section -->
										</div>
									</div>
								<!-- Filter Section -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Search -->

		<!-- List panel -->
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#"  class="panel-action panel-action-toggle" data-panel-toggle></a>
					</div>
						<h2 class="panel-title">อัลบัมภาพกิจกรรม </h2>
				</header>

				<div class="panel-body">
				<!-- Tabel view display -->
					<table class="table table-striped" id="iccCard">
						<thead>
							<tr>
								<th class="text-center" width="40"></th>
								<th class="text-center">ชื่อโครงการ</th>
								<th class="text-center">วันที่ทำกิจกรรม</th>
								<th class="text-center">อำเภอ</th>
								<th class="text-center">จังหวัด</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				<!-- End Tabel view display -->
					<div class="pagination" id="paginationLinks"> <p><?php echo $paginationLinks; ?></p> </div>
				</div>
			</section>
		<!-- List panel -->

		</div>
	</div>
</div>