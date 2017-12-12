<!-- ************************************************ Panel of ICC Card - Master -->
	<?php echo form_open(base_url("iccCard"), array("id" => "formIccCardMaster")); ?>
	<!-- Header content panel -->
		<div class="panel-heading bg-primary">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#collapseIccCardMasterParent" 
				href="#collapseIccCardMaster" style="color:white">
					1. ข้อมูลสถานที่ทำกิจกรรม
				</a>
			</h4>
		</div>
	<!-- End Header content panel -->
	
	<!-- Body content panel -->
		<div class="panel-collapse collapse in" id="collapseIccCardMaster">
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12 col-md-12 col-lg-12">
					<!-- Project Name -->
						<div class="row">
							<div class="col-xs-2 col-md-2 col-lg-2 text-left margin-input">
								<div>ชื่อโครงการ</div>
							</div>
							<div class="col-xs-6 col-md-6 col-lg-6 margin-input">
								<input type="text" class="form-control input-require" autocomplete="off"
								placeholder="ชื่อโครงการ..." id="projectName" name="Project_Name"
								value="<?php echo($dsInput['dsIccCardMaster'][0]['Project_Name']); ?>">
							</div>
							<div class="col-xs-3 col-md-3 col-lg-3 text-left margin-input">
								<div class="input-group">
									<span>สถานะของโครงการ : </span>
									<span class="input-group-addon" id="iccCardStatus"><?php 
										echo($rIccCardStatus[$dsInput['dsIccCardMaster'][0]['FK_ICC_Card_Status']]);
									?></span>
								</div>
							</div>
							<div class="col-xs-1 col-md-1 col-lg-1 text-left margin-input">
								<div><?php
									if( ($this->uri->segment(2) == 'edit') 
									&& (($level == 1) || ($level == 2)) ) {
										if($dsInput['dsIccCardMaster'][0]['FK_ICC_Card_Status'] == 2) {
											echo('<div>'
													. '<button id="doneIccCard"'
													. ' type="button" class="btn btn-success">'
														. 'เสร็จสิ้น'
													. '</button>'
												. '</div>'
											);
										} else if($dsInput['dsIccCardMaster'][0]['FK_ICC_Card_Status'] == 1) {
											echo('<div>'
													. '<button id="approveIccCard"'
													. ' type="button" class="btn btn-info">'
														. 'อนุมัติ'
													. '</button>'
												. '</div>'
											);
										}
									}
								?></div>
							</div>
						</div>
					<!-- Cleanup Type & Hidden := masterId, geoLocationId -->
						<div class="row">
							<div class="col-xs-2 col-md-2 col-lg-2 text-left margin-input">
								<div>บริเวณ/ลักษณะของพื้นที่เก็บขยะ</div>
							</div>
							<div class="col-xs-10 col-md-10 col-lg-10 margin-input">
								<?php
									foreach($dsCleanupType as $row) {
									$rbCleanupTypeSelected = (
															($dsInput['dsIccCardMaster'][0]['FK_Cleanup_Type']
															== $row['id']) ? ' checked' : '');
										echo(
											'<label class="radio-inline">'
											. '<input type="radio" class="input-require"'
											. ' id="cleanupTypeId" name="FK_Cleanup_Type"'
											. ' value="' . $row['id'] . '"' . $rbCleanupTypeSelected . '>'
											. $row['Name']
											. '</label>'
										);
									}
								?>
								
								<input type="hidden" id="iccCardId" name="masterId"
								value=<?php echo($dsInput['dsIccCardMaster'][0]['id']) ?>>
								<input type="hidden" name="geoLocationId"
								value=<?php echo($dsInput['dsGeoLocation'][0]['id']); ?>>
							</div>
						</div>
					<!-- Province & Latitude -->
						<div class="row">
							<div class="col-xs-2 col-md-2 col-lg-2 text-left margin-input">
								<div>จังหวัด</div>
							</div>
							<div class="col-xs-7 col-md-7 col-lg-7 margin-input">
								<select class="form-control input-require" id="provinceCode" name="FK_Province_Code">
									<option value="0" selected>เลือกจังหวัด...</option>
									<?php 
										foreach($dsProvince as $row) {
											$selected = (($dsInput['dsIccCardMaster'][0]['FK_Province_Code']
												== $row['ProvinceCode'])
													? ' selected' : '');
											echo '<option value=' . $row['ProvinceCode'] . $selected.'>'
												. $row['ProvinceName'] . '</option>';
										}
									?>
								</select>
							</div>
							<div class="col-xs-1 col-md-1 col-lg-1 text-left margin-input">
								<div>Latitude</div>
							</div>
							<div class="col-xs-2 col-md-2 col-lg-2 margin-input">
								<input type="number" class="form-control allow-decimal-negative input-require"
								autocomplete="off" placeholder="Latitude..." id="latitude" name="Lat"
								value="<?php echo($dsInput['dsGeoLocation'][0]['Lat']); ?>">
							</div>
						</div>
					<!-- Amphur & Longitude -->
						<div class="row">
							<div class="col-xs-2 col-md-2 col-lg-2 text-left margin-input">
								<div>อำเภอ</div>
							</div>
							<div class="col-xs-7 col-md-7 col-lg-7 margin-input">
								<select class="form-control" id="amphurCode" name="FK_Amphur_Code">
									<option value="0" selected>เลือกอำเภอ...</option>
									<?php 
										foreach($dsAmphur as $row) {
											$selected = (($dsInput['dsIccCardMaster'][0]['FK_Amphur_Code']
												== $row['AmphurCode'])
													? ' selected' : '');
											echo '<option value=' . $row['AmphurCode'] . $selected.'>'
												. $row['AmphurName'] . '</option>';
										}
									?>
								</select>
							</div>
							<div class="col-xs-1 col-md-1 col-lg-1 text-left margin-input">
								<div>Longitude</div>
							</div>
							<div class="col-xs-2 col-md-2 col-lg-2 margin-input">
								<input type="number" class="form-control allow-decimal-negative input-require"
								autocomplete="off" placeholder="Longitude..." id="longitude" name="Lon"
								value="<?php echo($dsInput['dsGeoLocation'][0]['Lon']); ?>">
							</div>
						</div>
					<!-- Event Place Name -->
						<div class="row">
							<div class="col-xs-2 col-md-2 col-lg-2 text-left margin-input">
								<div>ชื่อสถานที่ทำกิจกรรม</div>
							</div>
							<div class="col-xs-10 col-md-10 col-lg-10 margin-input">
								<input type="text" class="form-control input-require" autocomplete="off"
								placeholder="ชื่อสถานที่ทำกิจกรรม..." id="eventPlaceName" name="Event_Place_Name"
								value="<?php echo($dsInput['dsIccCardMaster'][0]['Event_Place_Name']); ?>">
							</div>
						</div>
					<!-- Event Place Name Map -->
						<div class="row">
							<div class="col-xs-2 col-md-2 col-lg-2 text-left margin-input">
								<div>   </div>
							</div>
							<div class="col-xs-10 col-md-10 col-lg-10 margin-input">
								<center>
									<div id="map" style="width:650px;height:300px; margin-bottom: 20px;"></div>     </center>
							</div>
						</div>
						<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClagICh6L2KDnt5-14byUhE-wBRnjiYeg"></script>
					<!-- Event Date -->
						<div class="row">
							<div class="col-xs-2 col-md-2 col-lg-2 text-left margin-input">
								<div>วันที่จัดกิจกรรม</div>
							</div>
							<div class="col-xs-10 col-md-10 col-lg-10 margin-input">
								<div class="input-group date" id='dtsEventDate'>
									<input data-date-format="DD-MMM-YYYY" type="text"
									class="small-input-group input-require" name="Event_Date"
									value=<?php 
										echo( ( 
											($dsInput['dsIccCardMaster'][0]['Event_Date'] == 0)
												? date("d-M-Y")
												: date("d-M-Y"
													, strtotime($dsInput['dsIccCardMaster'][0]['Event_Date']))));
									?>>
									</input>

									<span class="input-group-addon small-input-group">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</div>
					<!-- Department -->
						<div class="row">
							<div class="col-xs-2 col-md-2 col-lg-2 text-left margin-input">
								<div>หน่วยงานที่จัด</div>
							</div>
							<div class="col-xs-10 col-md-10 col-lg-10 margin-input">
								<select class="form-control" id="department" name="FK_Org">
									<option value="0" selected>เลือกหน่วยงาน...</option>
									<?php 
										foreach($dsOrg as $row) {
											$selected = (($dsInput['dsIccCardMaster'][0]['FK_Org'] == $row['id'])
														? ' selected' : '');
											echo '<option value=' . $row['id'] . $selected.'>' . $row['department'] . '</option>';
										}
									?>
								</select>
							</div>
						</div>
					<!-- Co-ordinator Name -->
						<div class="row">
							<div class="col-xs-2 col-md-2 col-lg-2 text-left margin-input">
								<div>หน่วยงานที่เกี่ยวข้อง</div>
							</div>
							<div class="col-xs-10 col-md-10 col-lg-10 margin-input">
								<input type="text" class="form-control input-require" autocomplete="off"
								placeholder="หน่วยงานที่เกี่ยวข้อง..." id="coordinatorName" name="Coordinator_Name"
								value="<?php echo($dsInput['dsIccCardMaster'][0]['Coordinator_Name']); ?>">
							</div>
						</div>
					<!-- Volunteer Qty -->
						<div class="row">
							<div class="col-xs-2 col-md-2 col-lg-2 text-left margin-input">
								<div>จำนวนอาสาสมัคร</div>
							</div>
							<div class="col-xs-10 col-md-10 col-lg-10 margin-input">
								<input type="text" class="form-control input-require" autocomplete="off"
								placeholder="จำนวนอาสาสมัคร..." id="volunteerQty" name="Volunteer_Qty"
								value="<?php echo($dsInput['dsIccCardMaster'][0]['Volunteer_Qty']); ?>">
							</div>
						</div>
					<!-- Distance Qty & Unit -->
						<div class="row">
							<div class="col-xs-2 col-md-2 col-lg-2 text-left margin-input">
								<div>ระยะทาง</div>
							</div>
							<div class="col-xs-7 col-md-7 col-lg-7 margin-input">
								<?php
									$rbEventDistanceSelectedAlready = false;
									$rbEventDistanceAttribute[0] = array('caption' => '1/4', 'val' => number_format(1/4,2));
									$rbEventDistanceAttribute[1] = array('caption' => '1/2', 'val' => number_format(1/2,2));
									$rbEventDistanceAttribute[2] = array('caption' => '3/4', 'val' => number_format(3/4,2));
									$rbEventDistanceAttribute[3] = array('caption' => '1', 'val' => number_format(1,2));
									$rbEventDistanceAttribute[4] = array('caption' => '2', 'val' => number_format(2,2));

									foreach($rbEventDistanceAttribute as $row) {
										if(!$rbEventDistanceSelectedAlready) {
											if( $dsInput['dsIccCardMaster'][0]['Event_Distance'] == $row['val'] ) {
												$rbEventDistanceSelected = ' checked';
												$rbEventDistanceSelectedAlready = true;
											} else {
												$rbEventDistanceSelected = '';
											}
										} else { $rbEventDistanceSelected = ''; }
										echo(
											'<label class="radio-inline">'
											. '<input type="radio"'
											. ' id="eventDistance" name="Event_Distance"'
											. ' value="' . $row['val'] . '"' . $rbEventDistanceSelected . '>'
											. $row['caption']
											. '</label>'
										);
									}

									if($rbEventDistanceSelectedAlready) {
										$rbEventDistanceSelected = '';
										$tbEventDistanceSelected = '';
									} else {
										$rbEventDistanceSelected = ' checked';
										$tbEventDistanceSelected = $dsInput['dsIccCardMaster'][0]['Event_Distance'];
									}
									echo(''
										. '<label class="radio-inline">'
										. '<input type="radio"'
										. ' id="eventDistanceEtc" name="Event_Distance"'
										. ' value="' . $rbEventDistanceSelected . '">'
										. 'อื่นๆระบุ'
										. '</label>'

										. '<label class="radio-inline">'
										. '<input type="number" id="eventDistanceEtc"'
										. ' class="allow-decimal" min=0 step=0.05'
										. ' placeholder="อื่นๆ..." autocomplete="off"'
										. ' value="' . $tbEventDistanceSelected . '">'
										. '</label>'
									);
								?>
							</div>
							<div class="col-xs-3 col-md-3 col-lg-3 text-left margin-input">
								<div>หน่วยของระยะทาง</div>
								<select class="form-control input-require" id="distanceUnitID" name="FK_Distance_Unit">
									<option value="0" selected>เลือกหน่วยของระยะทาง...</option>
									<?php 
										foreach($dsDistanceUnit as $row) {
											$selected = (($dsInput['dsIccCardMaster'][0]['FK_Distance_Unit'] == $row['id'])
														? ' selected' : '');
											echo '<option value=' . $row['id'] . $selected.'>' . $row['Name'] . '</option>';
										}
									?>
								</select>
							</div>
						</div>

					<!-- Garbage Bag - Garbage Qty & Unit -->
						<div class="row">
							<div class="col-xs-3 col-md-3 col-lg-3 margin-input">
								<div class="text-left">จำนวนถุงขยะที่ใช้บรรจุขยะ</div>
								<input type="text" class="form-control text-left input-require" autocomplete="off"
								placeholder="จำนวนถุงขยะที่ใช้บรรจุขยะ..." id="garbageBagQty" name="Garbage_Bag_Qty"
								value="<?php echo($dsInput['dsIccCardMaster'][0]['Garbage_Bag_Qty']); ?>">
							</div>
							<div class="col-xs-6 col-md-6 col-lg-6 text-left margin-input">
								<div>น้ำหนักรวมโดยประมาณ</div>
								<input type="number" class="form-control allow-decimal input-require" autocomplete="off"
								min="0" step=0.05 placeholder="น้ำหนักรวมโดยประมาณ..."
								id="garbageWeight" name="Garbage_Weight"
								value="<?php echo($dsInput['dsIccCardMaster'][0]['Garbage_Weight']); ?>">
							</div>
							<div class="col-xs-3 col-md-3 col-lg-3 text-left margin-input">
								<div>หน่วยของน้ำหนัก</div>
								<select class="form-control input-require" id="weightUnitID" name="FK_Weight_Unit">
									<option value="0" selected>เลือกหน่วยของน้ำหนัก...</option>
									<?php 
										foreach($dsWeightUnit as $row) {
											$selected = (($dsInput['dsIccCardMaster'][0]['FK_Weight_Unit'] == $row['id'])
														? ' selected' : '');
											echo '<option value=' . $row['id'] . $selected.'>' . $row['Name'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
					<!-- Event Time -->
						<div class="row">
							<div class="col-xs-2 col-md-2 col-lg-2 text-left margin-input">
								<div>เวลาในการทำกิจกรรม</div>
							</div>
							<div class="col-xs-10 col-md-10 col-lg-10 margin-input">
								<input type="text" class="form-control input-require" autocomplete="off"
								placeholder="เวลาในการทำกิจกรรม..." id="eventTime" name="Event_Time"
								value="<?php echo($dsInput['dsIccCardMaster'][0]['Event_Time']); ?>">
							</div>
						</div>
					<!-- End ICC Card - Master input -->
					</div>
				</div>
			</div>
		</div>
	<!-- End Body content panel -->
	<?php echo form_close(); ?><!-- Close formIccCardMaster -->
<!-- ************************************************ End panel of ICC Card - Master -->
