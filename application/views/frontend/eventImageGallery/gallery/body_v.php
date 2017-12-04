<?php echo my_css_asset("plugins/prettyPhoto/css/prettyPhoto.css") ?>
<!-- Body content -->
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
				<div class="panel-group">
					<div class="panel panel-primary">
					<!-- Panel Header -->
						<div class="panel-heading text-center">
							<h3>
								ภาพกิจกรรมโครงการ : 
								<div><?php echo isset($dsIccCard[0]["Project_Name"]) ? $dsIccCard[0]["Project_Name"] : "" ?></div>
							</h3>
						</div>
					<!-- End Panel Header -->

					<!-- Panel Body -->
						<div class="panel-body">
						<!--Gallery Image -->
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
						<!-- End Gallery Image -->
						</div>
					<!-- End Panel Body -->
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- End Body content -->