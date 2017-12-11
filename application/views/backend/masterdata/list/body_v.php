<section role="main" class="content-body">
<div class="row">
	<div class="row">
		<div class="col-xs-12">

		<!-- List section panel -->
			<section class="panel">
			<!-- ////////////////////////////////////////////////////// Breadcrumb -->
				<header class="panel-heading">
					<h2 class="panel-title">
						<ol class="breadcrumb">
							<li class="active"><?php echo($dataTypeCaption); ?></li>
						</ol>
					</h2>
				</header>
			<!-- ////////////////////////////////////////////////////// End Breadcrumb -->
				<br>

			<!-- ////////////////////////////////////////////////////// Content -->
				<div class="panel-body">
				<!-- Form Add new -->
					<?php echo form_open(base_url("masterdata/addNew/".$dataType), array("id" => "formAddNew")); ?>
						<input type='hidden' name='dataType' value=<?php echo($dataType); ?> />
						<a class="btn btn-primary " href="#" role="button"
						onclick="javascript:document.getElementById('formAddNew').submit()">
							<i class="fa fa-plus"></i> เพิ่มข้อมูลใหม่
						</a>
					<?php echo form_close(); ?><!-- Close form choose -->
				<!-- End Form Add new -->
					<br><br>
				<!-- Form Choose table -->
					<?php echo form_open(base_url("masterdata/edit/".$dataType), array("id" => "formChoose")); ?>
						<input type='hidden' name='dataType' value=<?php echo($dataType); ?> />
						<input type='hidden' name='rowId' value='0' />
					<!-- Tabel view display -->	
						<table id="view" class="table table-bordered table-components 
						table-condensed table-hover table-striped table-responsive">
						<!-- Header Table -->
							<thead class="table-header">
								<tr>
									<th class="text-center" width="40">No.</th>
									<?php 
										if(count($dsView) > 0) {
											$i=0;
											foreach($dsView[0] as $col => $value) {
												if($i++ > 0) {
													echo ('<th class="text-center">'. $col .'</th>');
												}
											}
										}
									?>
									<th class="text-center" width="90">จัดการ</th>
								</tr>
							</thead>
						<!-- End Header Table -->

						<!-- Body Table -->
							<tbody>
								<?php $i = 1; ?>
								<?php foreach($dsView as $row) { ?>
									<tr>
										<td class="text-center"><?php echo($i++) ?></td>
										<?php $j=0; ?>
										<?php foreach($row as $value) { ?>
											<?php if($j++ > 0) { ?>
												<td class="text-left"><?php echo($value) ?></td>
											<?php } ?>
										<?php } ?>
										<td class="text-center">
											<a title="แก้ไขข้อมูล" class="btn btn-primary btn-xs" href="#" role="button"  id="editRow">
												<i class="fa fa-pencil fa-fw"></i>
											</a>

											<a title="ลบข้อมูล" class="btn btn-danger btn-xs" href="#" role="button" id="deleteRow" 
											style="margin-left:10px">
												<i class="fa fa-times"></i>
											</a>

											<input type="hidden" id="rowId" value="<?php echo($row['id']) ?>"/>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						<!-- End Body Table -->
						</table>
					<!-- Tabel view display -->
					<?php echo form_close(); ?><!-- Close form choose -->
				<!-- Form Choose table -->
				</div>
			<!-- ////////////////////////////////////////////////////// Content -->

			</section>
		<!-- End List section panel -->

		</div>
	</div>
</div>
</section>