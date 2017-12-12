<!-- ************************************************ Panel of ICC Card - Entangled Animal -->
	<?php echo form_open(base_url("iccCard"), array("id" => "formEntangledAnimal")); ?>
	<!-- Header content panel -->
		<div class="panel-heading bg-primary">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#collapseEntangledAnimalParent"
				href="#collapseEntangledAnimal" style="color:white">
					3. สัตว์ที่พบ
				</a>
			</h4>
		</div>
	<!-- End Header content panel -->

	<!-- Body content panel -->
		<div class="panel-collapse collapse in" id="collapseEntangledAnimal">
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12 col-md-12 col-lg-12">
					<!-- ICC Card - Entangled Animal Table -->
						<table id="tbEntangledAnimal"
						class="table table-components table-hover table-striped table-responsive input-require-parent">
							<tbody><?php 
								$i=0;
								foreach($dsInput['dsEntangeledAnimal'] as $rowInput) {
									echo '<tr>';
									//<!-- No. -->
										echo '<td class="text-center td-group">' . ($i+1) . '</td>';
									//<!-- Animal name -->
										echo '<td class="text-left td-group">';
											echo 'สัตว์ที่ได้รับอันตรายหรือบาดเจ็บ';
											echo '<input type="text" class="form-control text-left input-require-child"';
											echo ' id="animalName" title="ชื่อชนิดของสัตว์" placeholder="ชื่อสัตว์..."';
											echo ' value=' . ($rowInput['Name']) . '>';
										echo '</td>';
									//<!-- Animal Status -->
										echo '<td class="text-left td-group">';
											echo 'สถานะภาพ';
											echo '<select class="form-control text-left input-require-sibling"';
											echo 'id="animalStatus">';
												echo '<option value="0" selected>----</option>';
												foreach($dsAnimalStatus as $row) {
													$selected = (($rowInput['FK_Animal_Status'] == $row['id']) 
																? ' selected' : '');
													echo '<option value='.$row['id'].$selected.'>'.$row['Name'].'</option>';
												}
											echo '</select>';
										echo '</td>';
									//<!-- Entangled Flag -->
										echo '<td class="text-left td-group">';
											echo '<input type="checkbox" id="entangledFlag"';
											echo (($rowInput['Entangled_Flag'] == 1) ? ' checked' : '') . ' >';
										echo '</td>';
										echo '<td class="text-left td-group">';
											echo '<label for="entangledFlag">';
											echo ' มีขยะทะเลเกี่ยวพันร่างกายหรือไม่';
											echo '</label>';
										echo '</td>';
										echo '<td></td>';
									//<!-- Entangled Debris -->
											echo '<td class="text-left td-group">';
											echo 'ชนิดขยะที่เกี่ยวพัน';
											echo '<input type="text" class="form-control text-left input-require-sibling"';
											echo ' id="entangledDebris"';
											echo ' title="ชนิดขยะที่เกี่ยวพัน" placeholder="ชนิดขยะที่เกี่ยวพัน..."';
											echo ' value=' . ($rowInput['Entangled_Debris']) . '>';
										echo '</td>';
									//<!-- Add New Row button. -->
										echo '<td class="text-center" width="2%">';
											echo '<button type="button" class="btn btn-';
											echo ($i==0 ? 'default add-elements' : 'danger delete-elements') . '"';
											echo ' id="entangledAnimalId" value=' . ($rowInput['id']) . '>';
												echo '<i class="fa fa-' . ($i==0 ? 'plus' : 'minus') . '"></i>';
											echo '</button>';
										echo '</td>';
									//<!-- End row -->
									echo '</tr>';
									$i++;
								}?>
							</tbody>
						</table>
					<!-- End Table ICC Card - Entangled Animal -->
					</div>
				</div>
			</div>
		</div>
	<!-- End Body content panel -->
	<?php echo form_close(); ?><!-- Close formEntangledAnimal -->
<!-- ************************************************ End panel of ICC Card - Entangled Animal -->