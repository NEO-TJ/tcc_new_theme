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
					<input type="hidden" name="iccCardId" value="<?php echo $iccCardId ?>">
					<input type="file" multiple="multiple" name="imageFile[]">
					<input type="submit" value="Upload image" name="submit">
				</form>
			</div>
		<!-- End Upload Form -->

		<!--Uploaded Image -->
			<?php if(isset($dsImage)) { ?>

				<table width="100%" cellpadding="1" cellspacing="0">
					<tr>
						<?php $i=1; ?>
						<?php foreach($dsImage as $image) { ?>
							<td>
								<a title="" rel="prettyPhoto[pp_gal]"
								href="<?=base_url().'uploads/Event_Images/'.$image['Image_URL'] ?>" >
									<img src="<?=base_url().'uploads/Event_Images/thumbs/'.$image['Image_URL'] ?>" 
									alt="<?=$image['Caption']?>">
								</a>
							</td>
							<?php if($i > 7) { ?>
								</tr>
								<tr>
								<?php $i = 0; ?>
							<?php } ?>
							<?php $i++; ?>
						<?php }?>
					</tr>
				</table>

			<?php } ?>
		<!-- End Uploaded Image -->
		</div>
	<!-- End Panel body -->
	</section>
<!-- ////////////////////////////////////////////////////// End Content -->

<?php $this->load->view('backend/eventImageAdmin/footer_v'); ?>