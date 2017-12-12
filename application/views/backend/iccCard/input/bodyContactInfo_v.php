<!-- ************************************************ Panel of ICC Card - Contact Info -->
	<?php echo form_open(base_url("iccCard"), array("id" => "formContactInfo")); ?>
	<!-- Header content panel -->
		<div class="panel-heading bg-primary">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#collapseContactInfoParent" 
				href="#collapseContactInfo" style="color:white">
					2. ติดต่อ
				</a>
			</h4>
		</div>
	<!-- End Header content panel -->

	<!-- Body content panel -->
		<div class="panel-collapse collapse in" id="collapseContactInfo">
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12 col-md-12 col-lg-12">
					<!-- ICC Card - Contact Info Table -->
						<table id="tbContactInfo"
						class="table table-components table-hover table-striped table-responsive input-require-parent">
							<tbody><?php 
								$i=0;
								foreach($dsInput['dsContactInfo'] as $rowInput) {
									echo '<tr id="rowContactInfo">';
									//<!-- No. -->
										echo '<td class="text-center td-group">' . ($i+1) . '</td>';
									//<!-- Contact name caption -->
										echo '<td class="text-left td-group">ชื่อ</td>';
									//<!-- Contact name -->
										echo '<td class="text-left td-group">';
											echo '<input type="text" class="form-control text-left input-require-child"';
											echo ' title="ชื่อ" placeholder="ชื่อ..."';
											echo ' id="contactName" value=' . ($rowInput['Name']) . '>';
										echo '</td>';
									//<!-- Email Caption -->
										echo '<td class="text-center td-group">อีเมล์</td>';
									//<!-- Email -->
										echo '<td class="text-left td-group">';
											echo '<input type="text" class="form-control text-left input-require-sibling"';
											echo ' title="อีเมล์" placeholder="อีเมล์@..."';
											echo ' id="email" value=' . ($rowInput['Email']) . '>';
										echo '</td>';
									//<!-- Add New Row button. -->
										echo '<td class="text-center" width="2%">';
											echo '<button type="button" class="btn btn-';
											echo ($i==0 ? 'default add-elements' : 'danger delete-elements') . '"';
											echo ' id="contactInfoId" value=' . ($rowInput['id']) . '>';
												echo '<i class="fa fa-' . ($i==0 ? 'plus' : 'minus') . '"></i>';
											echo '</button>';
										echo '</td>';
									//<!-- End row -->
									echo '</tr>';
									$i++;
								}?>
							</tbody>
						</table>
					<!-- End Table ICC Card - Contact Info -->
					</div>
				</div>
			</div>
		</div>
	<!-- End Body content panel -->
	<?php echo form_close(); ?><!-- Close formContactInfo -->
<!-- ************************************************ End panel of ICC Card - Contact Info -->