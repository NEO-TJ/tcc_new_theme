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
											<div class="col-xs-5 col-md-5 col-lg-5 margin-input" id="provinceCode">
												<select class="form-control multi-select input-require" id="provinceCode" multiple="multiple">
												</select>
											</div>
										<!-- Department Section -->
											<div class="col-xs-1 col-md-1 col-lg-1 text-left margin-input">
												<div>หน่วยงาน</div>
											</div>
											<div class="col-xs-5 col-md-5 col-lg-5 margin-input">
												<select class="form-control input-require" id="orgId">
												</select>
											</div>
										<!-- Project Name Sub Section -->
											<div class="col-xs-1 col-md-1 col-lg-1 text-left margin-input">
												<div>โครงการ : </div>
											</div>
											<div class="col-xs-4 col-md-4 col-lg-4 margin-input">
												<select class="form-control input-require" id="projectName">
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

	<div class="container" style="padding: 0 0 60px;">
    <div class="row wrapper">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <h3 class="widget-title">แผนที่การทำกิจกรรม</h3>
            <div id="mapPlaceDisplay"><?php echo $map['html']; ?></div>
        </div>
    </div>
	</div>

		</div>
	</div>
</div>