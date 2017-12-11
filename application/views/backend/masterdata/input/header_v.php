<section role="main" class="content-body">
	<div class="row">
		<div class="row">
			<div class="col-xs-12">

				<section class="panel">
				<!-- ////////////////////////////////////////////////////// Breadcrumb -->
					<header class="panel-heading">
						<h2 class="panel-title">
							<ol class="breadcrumb">
								<li>
									<a href="<?php echo base_url('masterdata/view/'.$dataType); ?>">
										<?php echo($dataTypeCaption); ?>
									</a>
								</li>
								<li class="active"><?php echo($inputModeName);?></li>
							</ol>
						</h2>
					</header>
				<!-- ////////////////////////////////////////////////////// End Breadcrumb -->
					<br>

				<!-- ////////////////////////////////////////////////////// Content -->
					<div class="panel-body">
					<!-- ************************************************ Panel of Masterdata input -->
						<?php echo form_open(base_url("masterdata/save"), array("id" => "formInputData")); ?>
							<input type='hidden' id='dataType' name='dataType' value=<?php echo($dataType); ?>></input>
							<input type='hidden' id='rowId' name='rowId' value=<?php echo($dsInput['id']); ?>></input>
							<div class="row">