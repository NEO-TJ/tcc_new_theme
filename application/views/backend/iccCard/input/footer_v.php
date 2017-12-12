					<br>
				<!-- Button submit and delete -->
					<section class="panel">
						<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
							<div class="row">
								<div class="col-xs-8 col-md-8 col-lg-8"></div>
		
								<div class="col-xs-2 col-md-2 col-lg-2">
									<?php $btnDeleteHide = ( ($this->uri->segment(2) == 'edit') ? '' : ' disabled' ); ?>
									<button type="button" class="btn btn-danger pull-right" id="deleteIccCard"
									<?php echo($btnDeleteHide) ?>>
										ลบข้อมูลทั้งหมด
									</button>
								</div>
		
								<div class="col-xs-2 col-md-2 col-lg-2">
									<button type="button" class="btn btn-primary pull-right" id="btnSave">บันทึกข้อมูล</button>
								</div>
							</div>
						</div>
					</section>
				<!-- End Button submit and delete -->

				<!-- ////////////////////////////////////////////////////// End Content -->

					<br><br><br>
				<!-- Footer back to top -->
					<section class="panel">
						<div id="footer">
							<div class="row">
								<div class="col-xs-10 col-md-10 col-lg-10"></div>
								<div class="col-xs-2 col-md-2 col-lg-2">
									<a id="backToTop" href="#" class="pull-right">Back to top</a>
								</div>
							</div>
						</div>
					</section>
				<!-- End Footer back to top -->

				</section>

			</div><!-- End col -->
		</div><!-- End row -->
	</div><!-- End row -->
</section><!-- End section main -->