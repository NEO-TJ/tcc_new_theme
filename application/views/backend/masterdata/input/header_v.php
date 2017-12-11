<section role="main" class="content-body">
<div class="row">
	<div class="row">
		<div class="col-xs-12">

<!-- ////////////////////////////////////////////////////// Breadcrumb -->
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-12 col-lg-12">
						<ol class="breadcrumb">
							<li><a href="<?php echo base_url('masterdata/view/'.$dataType); ?>"><?php echo($dataTypeCaption); ?></a></li>
							<li class="active"><?php echo($inputModeName);?></li>
						</ol>
					</div>
				</div>
			</div>
<!-- ////////////////////////////////////////////////////// End Breadcrumb -->

<!-- ////////////////////////////////////////////////////// Content -->
			<div class="container">
				<div class="row">
<!-- ************************************************ Panel of Masterdata input -->
					<?php echo form_open(base_url("masterdata/save"), array("id" => "formInputData")); ?>
						<input type='hidden' id='dataType' name='dataType' value=<?php echo($dataType); ?>></input>
						<input type='hidden' id='rowId' name='rowId' value=<?php echo($dsInput['id']); ?>></input>
						<div class="col-xs-12 col-md-12 col-lg-12 panel-group" id="collapseIccCardMasterParent">
							<div class="panel panel-primary">
							<!-- ************************************** Panel ICC Card - Master -->
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#collapseIccCardMasterParent" 
										href="#collapseIccCardMaster" style="color:white">
										ข้อมูลหลัก  -  <?php echo($dataTypeCaption); ?>
										</a>
									</h4>
								</div>
								<div class="panel-collapse collapse in" id="collapseIccCardMaster">
									<div class="panel-body">
										<div class="row">