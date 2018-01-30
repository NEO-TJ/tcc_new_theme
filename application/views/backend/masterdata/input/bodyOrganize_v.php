<?php $this->load->view('backend/masterdata/input/header_v'); ?>

<!------------------------------------------------------------------------------------>
	<!-- Department -->
	<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
		<div class="input-group">
			<span class="input-group-btn">
				<button class="btn btn-primary disabled" type="button">ชื่อหน่วยงาน : </button>
			</span>
			<input type="text" class="form-control input-require" 
			autocomplete="off" placeholder="ชื่อหน่วยงาน..."
			id="department" name="department" value="<?php echo($dsInput['department']); ?>">
		</div>
	</div>

	<!-- Location -->
	<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
		<div class="input-group">
			<span class="input-group-btn">
				<button class="btn btn-primary disabled" type="button">สถานที่ตั้ง : </button>
			</span>
			<input type="text" class="form-control input-require" 
			autocomplete="off" placeholder="สถานที่ตั้ง..."
			id="location" name="location" value="<?php echo($dsInput['location']); ?>">
		</div>
	</div>
<!------------------------------------------------------------------------------------>


<!------------------------------------------------------------------------------------>
	<div class="col-xs-12 col-md-12 col-lg-12"><br></div>
	<!-- Degrees Longitude -->
	<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
		<div class="input-group">
			<span class="input-group-btn">
				<button class="btn btn-primary disabled" type="button">Degrees Lon : </button>
			</span>
			<input type="number" class="form-control allow-decimal-negative"
			autocomplete="off" placeholder="Degrees Longitude..." id="deglon" name="deglon"
			value="<?php echo($dsInput['deglon']); ?>">
		</div>
	</div>

	<!-- Degrees Latitude -->
	<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
		<div class="input-group">
			<span class="input-group-btn">
				<button class="btn btn-primary disabled" type="button">Degrees Lat : </button>
			</span>
			<input type="number" class="form-control allow-decimal-negative"
			autocomplete="off" placeholder="Degrees Latitude..." id="deglat" name="deglat"
			value="<?php echo($dsInput['deglat']); ?>">
		</div>
	</div>
<!------------------------------------------------------------------------------------>


<!------------------------------------------------------------------------------------>
	<div class="col-xs-12 col-md-12 col-lg-12"><br></div>
	<!-- UTM X -->
	<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
		<div class="input-group">
			<span class="input-group-btn">
				<button class="btn btn-primary disabled" type="button">UTM X : </button>
			</span>
			<input type="number" class="form-control allow-decimal-negative"
			autocomplete="off" placeholder="UTM X..." id="utmx" name="utmx"
			value="<?php echo($dsInput['utmx']); ?>">
		</div>
	</div>

	<!-- UTM Y -->
	<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
		<div class="input-group">
			<span class="input-group-btn">
				<button class="btn btn-primary disabled" type="button">UTM Y : </button>
			</span>
			<input type="number" class="form-control allow-decimal-negative"
			autocomplete="off" placeholder="UTM Y..." id="utmy" name="utmy"
			value="<?php echo($dsInput['utmy']); ?>">
		</div>
	</div>

	<!-- UTM Z -->
	<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
		<div class="input-group">
			<span class="input-group-btn">
				<button class="btn btn-primary disabled" type="button">UTM Zone : </button>
			</span>
			<input type="number" class="form-control allow-decimal-negative"
			autocomplete="off" placeholder="UTM Zone..." id="utmz" name="utmz"
			value="<?php echo($dsInput['utmz']); ?>">
		</div>
	</div>

	<!-- UTM P -->
	<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
		<div class="input-group">
			<span class="input-group-btn">
				<button class="btn btn-primary disabled" type="button">Hemisphere : </button>
			</span>

			<span class="input-group-btn"></span>

			<label class="radio-inline">
				<input type="radio" class="input-require" id="utmp" name="utmp" value="N"
				<?php echo(($dsInput['utmp'] == 'N') ? ' checked' : '') ?>> N
			</label>

			<label class="radio-inline">
				<input type="radio" class="input-require" id="utmp" name="utmp" value="S"
				<?php echo(($dsInput['utmp'] == 'S') ? ' checked' : '') ?>> S
			</label>
		</div>
	</div>
<!------------------------------------------------------------------------------------>


<!------------------------------------------------------------------------------------>
	<div class="col-xs-12 col-md-12 col-lg-12"><br></div>
	<!-- Geographic Longitude -->
	<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
		<div class="input-group">
			<span class="input-group-btn">
				<button class="btn btn-primary disabled" type="button">Geographic Lon : </button>
			</span>
			<input type="number" class="form-control allow-decimal-negative"
			autocomplete="off" placeholder="Geographic Longitude..." id="gmaplon" name="gmaplon"
			value="<?php echo($dsInput['gmaplon']); ?>">
		</div>
	</div>

	<!-- Geographic Latitude -->
	<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
		<div class="input-group">
			<span class="input-group-btn">
				<button class="btn btn-primary disabled" type="button">Geographic Lat : </button>
			</span>
			<input type="number" class="form-control allow-decimal-negative"
			autocomplete="off" placeholder="Geographic Latitude..." id="gmaplat" name="gmaplat"
			value="<?php echo($dsInput['gmaplat']); ?>">
		</div>
	</div>
<!------------------------------------------------------------------------------------>


<?php $this->load->view('backend/masterdata/input/footer_v'); ?>