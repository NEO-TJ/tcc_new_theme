<?php $this->load->view('admin/dateThaiHelper_v');?>

<section role="main" class="content-body">
<div class="row">
	<div class="row">
		<div class="col-xs-12">

<!-- Search -->
	<div class="panel">
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12 overflow-xy">
				<div class="panel panel-primary">
					<div class="panel-body">
						<div class="row">
						<!-- Daterange Section -->
							<div class="col-xs-7 col-md-7 col-lg-7 text-left">
								<div class="input-group">
									<span class="input-group-btn">
										<button class="btn btn-primary disabled" type="button">ช่วงเวลา : </button>
									</span>
									<div id="daterange" class="form-control">
										<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
										<span></span> <b class="caret"></b>
									</div>
								</div>
							</div>
						<!-- Province Section -->
							<div class="col-xs-5 col-md-5 col-lg-5">
								<div class="input-group">
									<span class="input-group-btn">
										<button class="btn btn-primary disabled" type="button">จังหวัด : </button>
									</span>
									<select class="form-control" id="provinceCode">
										<option value="0" selected>เลือกทั้งหมด...</option>
										<?php
											foreach($dsProvince as $row) {
												echo '<option value='.$row['ProvinceCode'].'>'.$row['ProvinceName'].'</option>';
											}
										?>
									</select>
								</div>
							</div>
						<!-- Department Section -->
							<div class="col-xs-7 col-md-7 col-lg-7">
								<div class="input-group">
									<span class="input-group-btn">
										<button class="btn btn-primary disabled" type="button">ชื่อหน่วยงาน : </button>
									</span>
									<select class="form-control" id="orgId">
										<option value="0" selected>เลือกทั้งหมด...</option>
										<?php
											foreach($dsOrg as $row) {
												echo '<option value='.$row['id'].'>'.$row['department'].'</option>';
											}
										?>
									</select>
								</div>
							</div>
						<!-- Amphur Section -->
							<div class="col-xs-5 col-md-5 col-lg-5">
								<div class="input-group">
									<span class="input-group-btn">
										<button class="btn btn-primary disabled" type="button">อำเภอ : </button>
									</span>
									<select class="form-control" id="amphurCode">
										<option value="0" selected>เลือกทั้งหมด...</option>
										<?php
											foreach($dsAmphur as $row) {
												echo '<option value='.$row['AmphurCode'].'>'.$row['AmphurName'].'</option>';
											}
										?>
									</select>
								</div>
							</div>
						<!-- Garbage Type Section -->
							<div class="col-xs-4 col-md-4 col-lg-4">
								<div class="input-group">
									<span class="input-group-btn">
										<button class="btn btn-primary disabled" type="button">ประเภทขยะ : </button>
									</span>
									<select class="form-control" id="garbageTypeId">
										<option value="0" selected>เลือกทั้งหมด...</option>
										<?php
											foreach($dsGarbageType as $row) {
												echo '<option value='.$row['id'].'>'.$row['Name'].'</option>';
											}
										?>
									</select>
								</div>
							</div>
						<!-- Icc Card Status Section -->
							<div class="col-xs-3 col-md-3 col-lg-3">
								<div class="input-group">
									<span class="input-group-btn">
										<button class="btn btn-primary disabled" type="button">สถานะโครงการ : </button>
									</span>
									<select class="form-control" id="iccCardStatusCode">
										<option value="0" selected>เลือกทั้งหมด...</option>
										<?php 
											$cn = count($rIccCardStatus) + 1;
											for($i=1; $i < $cn; $i++) {
												echo '<option value=' . $i . '>' . $rIccCardStatus[$i] . '</option>';
											}
										?>
									</select>
								</div>
							</div>
						<!-- Project Name Section -->
							<div class="col-xs-4 col-md-4 col-lg-4">
								<div class="input-group">
									<span class="input-group-btn">
										<button class="btn btn-primary disabled" type="button">ชื่อโครงการ : </button>
									</span>
									<select class="form-control" id="projectName">
										<option value="0" selected>เลือกทั้งหมด...</option>
										<?php
											foreach($dsProjectName as $row) {
												echo '<option value="'.$row['id'].'">'.$row['Project_Name'].'</option>';
											}
										?>
									</select>
								</div>
							</div>
						<!-- Button Section -->
							<div class="col-xs-1 col-md-1 col-lg-1 pull-left">
								<button type="button" class="btn btn-primary pull-right" id="search">Go</button>
							</div>
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
			<h2 class="panel-title">แบบบันทึกข้อมูลไอซีซี </h2>
		</header>

		<div class="panel-body">
			<?php echo form_open(base_url("iccCard/addNew"), array("id" => "formAddNew")); ?>
				<a class="btn btn-primary " href="#" role="button"
				onclick="javascript:document.getElementById('formAddNew').submit()">
					<i class="fa fa-plus"></i> เพิ่มแบบข้อมูลใหม่
				</a>
			<?php echo form_close(); ?><!-- Close form choose -->
			<br><br>
			<?php echo form_open(base_url("iccCard/edit"), array("id" => "formChoose")); ?>
				<input type="hidden" name="iccCardId" value="0"/>
			<!-- Tabel view display -->
				<table class="table table-striped" id="iccCard">
					<thead>
						<tr>
							<th class="text-center" width="40"></th>
							<?php 
								if(count($dsIccCardList) > 0) {
									$i=0;
									foreach($dsIccCardList[0] as $col => $value) {
										if($i++ > 0) {
											echo ('<th class="text-center">'. $col .'</th>');
										}
									}
								}
							?>
							<th class="text-center" width="40">จัดการ</th>
							<th class="text-center" width="40">ภาพกิจกรรม</th>
						</tr>
					</thead>

					<tbody>
					</tbody>
				</table>
			<!-- End Tabel view display -->
				<div class="pagination" id="paginationLinks"> <p><?php echo $paginationLinks; ?></p> </div>
			<?php echo form_close(); ?><!-- Close form choose -->
		</div>
	</section>
<!-- List panel -->

			</div>
		</div>
	</div>
</section>