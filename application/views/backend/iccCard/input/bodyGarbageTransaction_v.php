<!-- ************************************************ Panel of ICC Card - Garbage Transaction -->
	<?php echo form_open(base_url("iccCard"), array("id" => "formGarbageTransaction")); ?>
		<?php $iGarbageType = 0; ?>
		<?php foreach($dsInput['dsGarbageTransaction'] as $dsGarbageByType) { ?>
		<!-- Header content panel -->
			<div class="panel-heading bg-primary">
				<h4 class="panel-title">
					<a data-toggle="collapse"
					data-parent="#collapseGarbageTransactionParent<?php echo($iGarbageType) ?>"
					href="#collapseGarbageTransaction<?php echo($iGarbageType) ?>" style="color:white">
						<?php echo('4.' . ($iGarbageType + 1) . '. ' . $dsGarbageByType[0]['garbageTypeName']); ?>
					</a>
				</h4>
			</div>
		<!-- End Header content panel -->

		<!-- Body content panel -->
			<div class="panel-collapse collapse in" id="collapseGarbageTransaction<?php echo($iGarbageType) ?>">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12 col-md-12 col-lg-12">

							<?php foreach($dsGarbageByType as $rowInput) { ?>
								<?php if( isset($rowInput['id']) ) { ?>

								<!-- Garbage qty input -->
									<div class="col-xs-6 col-md-6 col-lg-6">
										<div class="col-xs-6 col-md-3 col-lg-3 margin-input">
											<?php
											echo '<input type="number" class="form-control text-right"';
											echo ' autocomplete="off" id="garbageQty"';
											echo ' name="gstId' . $rowInput['id'];
											echo ';' . (isset($rowInput['GarbageTransactionId']) 
												? $rowInput['GarbageTransactionId'] : '0') . '"';
											echo ' min=0 step=1';
											echo ' value="' . $rowInput['Garbage_Qty'] . '">';
											?>
										</div>
										<div class="col-xs-6 col-md-9 col-lg-9 margin-input">
											<div><?php echo($rowInput['Name']) ?></div>
										</div>
									</div>
								<!-- End Garbage qty input -->

								<?php } ?>
							<?php } ?>

						</div>
					</div>
				</div> 
			</div>
		<!-- End Body content panel -->
			<?php $iGarbageType++; ?>
		<?php } ?>
	<?php echo form_close(); ?><!-- Close formGarbageTransaction -->
<!-- ************************************************ End panel of ICC Card - Garbage Transaction -->