<?php echo css_asset("report/style.css"); ?>
<div class="container" style="margin-top:20px">
	<div class="row">

		<!-- ************************************************ Div Main Report -->
		<div class="col-xs-12 col-md-12 col-lg-12 panel-group" id="collapseMainReportParent">
		<!-- ************************************** Panel Main Report -->
			<div class="panel panel-primary">
			<!-- ************************* Panel Main Report - Heading -->
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" 
						data-parent="#collapseMainReportParent" 
						href="#collapseMainReport">
							<div id="panelHeaderCaption">
								รายงานข้อมูลขยะทะเลในประเทศไทย
							</div>
						</a>
					</h4>
				</div>
			<!-- ************************* End Panel Main Report - Heading -->

				<div class="panel-collapse collapse in" id="collapseMainReport">
				<!-- ************************* Panel Main Report - Body -->
					<div class="panel-body">
						<div class="row">
						<!-- Filter Section -->
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="row">
								<!-- Main Limit ranking Sub Section -->
									<div class="col-xs-6 col-md-6 col-lg-6 margin-input">
										<label class="radio-inline">
											<input type="radio" class="input-require" checked
											id="rankingLimit10" name="rankingLimit" value="10">
											แสดงข้อมูลขยะทะเลแบบ Top 10
										</label>
										<label class="radio-inline">
											<input type="radio" class="input-require"
											id="rankingLimitNone" name="rankingLimit" value="9000">
											แสดงข้อมูลขยะทะเลทั้งหมด
										</label>
									</div>
								<!-- Province Sub Section -->
									<div class="col-xs-1 col-md-1 col-lg-1 text-left margin-input">
										<div>จังหวัด : </div>
									</div>
									<div class="col-xs-5 col-md-5 col-lg-5 margin-input">
										<select class="form-control input-require" 
										id="provinceCode">
										</select>
									</div>
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
								<!-- Project Sub Section -->
									<div class="col-xs-1 col-md-1 col-lg-1 text-left margin-input">
										<div>โครงการ : </div>
									</div>
									<div class="col-xs-4 col-md-4 col-lg-4 margin-input">
										<select class="form-control input-require" 
										id="projectName">
										</select>
									</div>
								<!-- Button Section -->
									<div class="col-xs-1 col-md-1 col-lg-1 margin-input">
										<button id="genReport" class="bg-success">OK</button>
									</div>
								<!-- End Button Section -->
								</div>
							</div>
						<!-- End Filter Section -->
							<hr>
						<!-- Body Content -->
							<div class="col-xs-12 col-md-12 col-lg-12">                            
								<div class="row">

									<div class="panel panel-info">
										<div class="panel-body">
										<!-- Marine Debris Single Place Report 3Pie Chart Sub Section -->
											<div class="col-xs-6 col-md-6 col-lg-6 text-left">
												<div class="panel panel-primary-light-1">
													<div class="panel-heading">
														<h4 class="panel-title">
															<div id="panelHeaderCaption">
																แผนภาพวงกลม แสดงชนิดและปริมาณขยะทะเลตามสถานที่
															</div>
														</h4>
													</div>
													<div class="panel-body">
														<div id="marineDebrisSinglePlaceChart"></div>
													</div>
												</div>
											</div>
										<!-- Marine Debris Event Place Map Place Sub Section -->
											<div class="col-xs-6 col-md-6 col-lg-6 text-left">
												<div class="panel panel-primary-light-1">
													<div class="panel-heading">
														<h4 class="panel-title">
															<div id="panelHeaderCaption">
																แผนที่แสดงตำแหน่งของกิจกรรม  :  
																<a href="<?php echo base_url(); ?>mapPlace" 
																title="แสดงแผนที่อย่างละเอียด">
																	<u class="u-click">คลิ๊ก</u>
																</a>
															</div>
														</h4>
													</div>
													<div class="panel-body">
														<div id="marineDebrisEventPlaceMapPlace">
															<?php echo $map['html']; ?>
														</div>
													</div>
												</div>
											</div>
										<!-- Marine Debris Place Compare Report Column Chart Sub Section -->
											<div class="col-xs-12 col-md-12 col-lg-12 text-left">
												<div class="panel panel-primary-light-2">
													<div class="panel-heading">
														<h4 class="panel-title">
															<div id="panelHeaderCaption">
																รายงานแผนภูมิแท่ง เปรียบเทียบชนิดและปริมาณขยะทะเลในแต่ละสถานที่
															</div>
														</h4>
													</div>
													<div class="panel-body">
														<div id="marineDebrisPlaceGroupChart"></div>
													</div>
												</div>
											</div>
										<!-- End Marine Debris Place Compare Report Column Chart Sub Section -->
										</div>
									</div>

									<div class="panel panel-info">
										<div class="panel-body">
										<!-- Marine Debris Single Place Report Table Sub Section -->
											<div class="col-xs-12 col-md-12 col-lg-12 panel-group" 
											id="collapseMarineDebrisSinglePlaceReportParent">
											<!-- ************************************** Panel MarineDebrisSinglePlace Report -->
												<div class="panel panel-info-detail-1">
												<!-- ************************* Panel MarineDebrisSinglePlace Report - Heading -->
													<div class="panel-heading">
														<h4 class="panel-title">
															<a data-toggle="collapse" 
															data-parent="#collapseMarineDebrisSinglePlaceReportParent" 
															href="#collapseMarineDebrisSinglePlaceReport">
																<div id="panelHeaderCaption">
																	<u class="u-caption">ตารางแสดงชนิดและปริมาณขยะทะเลตามสถานที่</u>
																</div>
															</a>
														</h4>
													</div>
												<!-- ************************* End Panel MarineDebrisSinglePlace Report - Heading -->
													<div class="panel-collapse collapse in" id="collapseMarineDebrisSinglePlaceReport">
													<!-- ************************* Panel MarineDebrisSinglePlace Report - Body -->
														<div class="panel-body">
															<table class="table table-bordered table-components table-condensed table-hover table-striped table-responsive" 
															id="marineDebrisSinglePlaceTable" style="width: 100%;">
																<thead>
																	<tr class="bg-info-detail-1">
																		<th class="text-center header-border-report">
																			<h4><strong></strong></h4>
																		</th>
																		<th class="text-center header-border-report">
																			<h4><strong>สถานที่</strong></h4>
																		</th>
																		<th class="text-center header-border-report" width="80">
																			<h4><strong>อันดับ</strong></h4>
																		</th>
																		<th class="text-center header-border-report">
																			<h4><strong>ชนิดขยะทะเล</strong></h4>
																		</th>
																		<th class="text-center header-border-report">
																			<h4><strong>จำนวน (ชิ้น)</strong></h4>
																		</th>
																	</tr>
																</thead>

																<tbody>
																</tbody>
															</table>
														</div>
													<!-- ************************* End Panel MarineDebrisSinglePlace Report - Body -->
													</div>
												</div>
											<!-- ************************************** End Panel MarineDebrisSinglePlace Report -->
											</div>
										<!-- End Marine Debris Single Place Report Table Sub Section -->

										<!-- Marine Debris Place Compare Report Table Sub Section -->
											<div class="col-xs-12 col-md-12 col-lg-12 panel-group" 
											id="collapseMarineDebrisPlaceCompareReportParent">
											<!-- ************************************** Panel MarineDebrisPlaceCompare Report -->
												<div class="panel panel-info-detail-2">
												<!-- ************************* Panel MarineDebrisPlaceCompare Report - Heading -->
													<div class="panel-heading">
														<h4 class="panel-title">
															<a data-toggle="collapse" 
															data-parent="#collapseMarineDebrisPlaceCompareReportParent" 
															href="#collapseMarineDebrisPlaceCompareReport">
																<div id="panelHeaderCaption">
																	<u class="u-caption">ตารางเปรียบเทียบชนิดและปริมาณขยะทะเลในแต่ละสถานที่</u>
																</div>
															</a>
														</h4>
													</div>
												<!-- ************************* End Panel MarineDebrisPlaceCompare Report - Heading -->
													<div class="panel-collapse collapse" id="collapseMarineDebrisPlaceCompareReport">
													<!-- ************************* Panel MarineDebrisPlaceCompare Report - Body -->
														<div class="panel-body">
															<table class="table table-bordered table-components 
															table-condensed table-hover table-striped table-responsive" 
															id="marineDebrisGroupingPlaceTable" style="width: 100%;">
																<thead>
																	<tr class="bg-info-detail-2">
																		<th class="text-center header-border-report">
																			<h4><strong></strong></h4>
																		</th>
																		<th class="text-center header-border-report">
																			<h4><strong>สถานที่</strong></h4>
																		</th>
																		<th class="text-center header-border-report" width="80">
																			<h4><strong>อันดับ</strong></h4>
																		</th>
																		<th class="text-center header-border-report">
																			<h4><strong>ชนิดขยะทะเล</strong></h4>
																		</th>
																		<th class="text-center header-border-report">
																			<h4><strong>จำนวน (ชิ้น)</strong></h4>
																		</th>
																	</tr>
																</thead>

																<tbody>
																</tbody>
															</table>
														</div>
													<!-- ************************* End Panel MarineDebrisPlaceCompare Report - Body -->
													</div>
												</div>
											<!-- ************************************** End Panel MarineDebrisPlaceCompare Report -->
											</div>
										<!-- End Marine Debris Place Compare Report Table Sub Section -->
										</div>
									</div>

								</div>
							</div>
						<!-- End Body Content -->
						</div>
					</div>
				<!-- ************************* End Panel Main Report - Body -->
				</div>

			</div>
		<!-- ************************************** Panel Main Report -->
		</div>
		<!-- ************************************************ End Div Main Report -->

	</div>
</div>