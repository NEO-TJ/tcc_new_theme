<?php $this->load->view('backend/eventImageAdmin/header_v'); ?>

	<br>
<!-- ////////////////////////////////////////////////////// Content -->
	<section class="panel">
	<!-- Panel header -->
		<header class="panel-heading bg-primary">
			<h2 class="panel-title" style="color:white">
				โครงการ : <?php echo isset($dsIccCard[0]["Project_Name"]) ? $dsIccCard[0]["Project_Name"] : "" ?>
			</h2>
		</header>
	<!-- End Panel header -->

	<!-- Panel body -->
		<div class="panel-body">
		<!-- Upload Form -->
			<div class="form_data">
				<form method="post" action="<?php echo site_url('eventImageAdmin/uploadImage')?>" enctype="multipart/form-data">
					<input type="hidden" id="iccCardId" name="iccCardId" value="<?php echo $iccCardId ?>">
					<input type="file" multiple="multiple" name="imageFile[]">
					<input type="submit" value="Upload image" name="submit">
				</form>
			</div>
		<!-- End Upload Form -->

			<hr>
		<!-- Uploaded Image -->
			<div id="eventImage">
				<?php $this->load->view('backend/eventImageAdmin/bodyTableImage_v'); ?>
			</div> 
		<!-- End Uploaded Image -->
		</div>
	<!-- End Panel body -->
	</section>
<!-- ////////////////////////////////////////////////////// End Content -->

<?php $this->load->view('backend/eventImageAdmin/footer_v'); ?>