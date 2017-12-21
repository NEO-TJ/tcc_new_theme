<?php $this->load->view('backend/masterdata/input/header_v'); ?>

<!-- Garbage Type -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">ประเภทขยะ : </button>
		</span>
		<select class="form-control input-require startFocus" id="garbageTypeID" name="FK_Garbage_Type">
			<option value="0" selected>เลือกประเภทขยะ</option>
			<?php 
				foreach($dsGarbageType as $row) {
					$selected = (($dsInput['FK_Garbage_Type'] == $row['id']) 
								? ' selected' : '');
					echo '<option value='.$row['id'].$selected.'>'.$row['Name'].'</option>';
				}
			?>
		</select>
	</div>
</div>

<!-- Garbage Name -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">ชื่อ : </button>
		</span>
		<input type="text" class="form-control input-require" 
			autocomplete="off" placeholder="ชื่อของขยะ..."
			id="Name" name="Name" value="<?php echo($dsInput['Name']); ?>">
	</div>
</div>

<?php $this->load->view('backend/masterdata/input/footer_v'); ?>