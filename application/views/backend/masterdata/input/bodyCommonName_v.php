<?php $this->load->view('backend/masterdata/input/header_v'); ?>

<!-- Common Name -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">Name : </button>
		</span>
		<input type="text" class="form-control input-require startFocus" autocomplete="off"
			placeholder=<?php echo(str_replace(' ', '_', $dataTypeCaption)); ?> 
			id=<?php echo($dataType); ?> name="Name"
			value="<?php echo($dsInput['Name']); ?>">
	</div>
</div>

<?php $this->load->view('backend/masterdata/input/footer_v'); ?>