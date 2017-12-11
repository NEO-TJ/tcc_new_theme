<?php $this->load->view('backend/masterdata/input/header_v'); ?>

<!-- Garbage Type Order -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">ลำดับที่ : </button>
		</span>
		<input type="number" class="form-control input-require" 
		autocomplete="off" placeholder="ลำดับที่..."
		id="OrderType" name="Priority" value="<?php echo($dsInput['Priority']); ?>">
	</div>
</div>

<!-- Garbage Type Name -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">ชื่อประเภทขยะ : </button>
		</span>
		<input type="text" class="form-control input-require" 
		autocomplete="off" placeholder="Garbage Name..."
		id="Name" name="Name" value="<?php echo($dsInput['Name']); ?>">
	</div>
</div>

<?php $this->load->view('backend/masterdata/input/footer_v'); ?>