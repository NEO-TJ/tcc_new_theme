<style>

.promo_full {
   
	height: auto;
	 background: url(<?php echo base_url('assets/images/slide/Sunrise.jpg'); ?>) center center no-repeat fixed;
	background-size: cover;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	position: relative;
}

.image-upper-bg-block
{
	text-align:center;
	height:300px;
	background-color:#fff;
}

.image-block-css
{
	margin:12px 0px;
}

   <?php
function DateThai($strDate)
{
$strYear = date("Y",strtotime($strDate))+543;
$strMonth= date("n",strtotime($strDate));
$strDay= date("j",strtotime($strDate));
$strHour= date("H",strtotime($strDate));
$strMinute= date("i",strtotime($strDate));
$strSeconds= date("s",strtotime($strDate));
$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
$strMonthThai=$strMonthCut[$strMonth];
return "$strDay $strMonthThai $strYear";
}
?>

</style>

	<div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">

		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
			<li data-target="#bs-carousel" data-slide-to="1"></li>
			<li data-target="#bs-carousel" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<?php $s = 1; ?>
			<?php if(count($sl) != 0) : ?>
				<?php foreach($sl as $row) : ?>
					<div class="item <?php echo ($s ==1) ? 'active' : ''; ?>">
						<img src="<?php echo base_url('/assets/admin/slide/'.$row['image']); ?>" alt="Slide <?php echo $s; ?>">
					</div>
					<?php $s++; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

	</div>


	<div id="background-under-picture" style="background: url(<?php echo base_url('assets/images/bg-main.jpg'); ?>) center center no-repeat;">
		<div class="container">
			<div class="row">
				<!-- Content-1-Home col-1 section -->
				<div class="col-md-3 image-upper-bg-block">
					<ul class="none">
						<li>
							<p class="tn">
								<a href="<?php echo base_url('/report'); ?>">
									<img class="image-block-css" src="<?php echo base_url('assets/images/background/image-link1.png'); ?>">
								</a>
							</p>
							<p>
								<a href="<?php echo base_url('/report'); ?>">
									<img src="<?php echo base_url('assets/images/background/caption-link1.png'); ?>">
								</a>
							</p>
						</li>
					</ul>
				</div>
				<!-- End Content-1-Home col-1 section -->

				<!-- Content-1-Home col-2 section -->
				<div class="col-md-3 image-upper-bg-block">
					<ul class="none">
						<li>
							<p class="tn">
								<a href="<?php echo base_url('/PublicRelations/content_list'); ?>">
									<img class="image-block-css" src="<?php echo base_url('assets/images/background/image-link2.png'); ?>">
								</a>
							</p>
							<p>
								<a href="<?php echo base_url('/PublicRelations/content_list'); ?>">
									<img src="<?php echo base_url('assets/images/background/caption-link2.png'); ?>">
								</a>
							</p>
						</li>
					</ul>
				</div>
				<!-- End Content-1-Home col-2 section -->

				<!-- Content-1-Home col-3 section -->
				<div class="col-md-3 image-upper-bg-block">
					<ul class="none">
						<li>
							<p class="tn">
								<a href="#">
									<img class="image-block-css" src="<?php echo base_url('assets/images/background/image-link3.png'); ?>">
								</a>
							</p>
							<p>
								<a href="#" >
									<img src="<?php echo base_url('assets/images/background/caption-link3.png'); ?>">
								</a>
							</p>
						</li>
					</ul>
				</div>
				<!-- End Content-1-Home col-3 section -->

				<!-- Content-1-Home col-4 section -->
				<div class="col-md-3 image-upper-bg-block">
					<ul class="none">
						<li>
							<p class="tn">
								<a href="<?php echo base_url('eventImageGallery'); ?>">
									<img class="image-block-css" src="<?php echo base_url('assets/images/background/image-link4.png'); ?>">
								</a>
							</p>
							<p>
								<a href="<?php echo base_url('eventImageGallery'); ?>">
									<img src="<?php echo base_url('assets/images/background/caption-link4.png'); ?>">
								</a>
							</p>
						</li>
					</ul>
				</div>
				<!-- End Content-1-Home col-4 section -->
			</div>
		</div><!-- End .container -->
	</div>



<div class="content-section-b" style="padding: 20px 0 20px;">
			<div class="container" >

			  <div class="row">
			  	<div class="col-md-6 " >

			  		<dir><img src="<?php echo base_url('assets/images/main_index/top-menu.png'); ?>" class="img-responsive" style="max-width: 280px;"></dir>
			  		<dir class="panel">
			  			
			  			<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-striped mb-none">
											<thead>
												<tr>
													<th>#</th>
													<th>ชื่อขยะ</th>
													<th>จำนวน</th>
													<th>Progress</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>ก้อนบุหรี่</td>
													<td><span class="total-sc" >1,800,000 ชิ้น</span></td>
													<td>
														<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
															<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
																100%
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>2</td>
													<td>ขวดพลาสติก</td>
													<td><span class="total-sc" >800,000 ชิ้น</span></td>
													<td>
														<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
															<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="80" style="width: 80%;">
																80%
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>3</td>
													<td>หลอด</td>
													<td><span class="total-sc" >800,000 ชิ้น</span></td>
													<td>
														<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
															<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="60" style="width: 60%;">
																60%
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>4</td>
													<td>เสื้อผ้า</td>
													<td><span class="total-sc" >100,000 ชิ้น</span></td>
													<td>
														<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="60" style="width: 40%;">
																40%
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>5</td>
													<td>กล่งโฟม</td>
													<td><span class="total-sc" >50,000 ชิ้น</span></td>
													<td>
														<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
															<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="60" style="width: 20%;">
																20%
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>6</td>
													<td>ก้อนบุหรี่</td>
													<td><span class="total-sc" >1,800,000 ชิ้น</span></td>
													<td>
														<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
															<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
																100%
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>7</td>
													<td>ขวดพลาสติก</td>
													<td><span class="total-sc" >800,000 ชิ้น</span></td>
													<td>
														<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
															<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="80" style="width: 80%;">
																80%
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>8</td>
													<td>หลอด</td>
													<td><span class="total-sc" >800,000 ชิ้น</span></td>
													<td>
														<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
															<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="60" style="width: 60%;">
																60%
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>9</td>
													<td>เสื้อผ้า</td>
													<td><span class="total-sc" >100,000 ชิ้น</span></td>
													<td>
														<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="60" style="width: 40%;">
																40%
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>10</td>
													<td>กล่งโฟม</td>
													<td><span class="total-sc" >50,000 ชิ้น</span></td>
													<td>
														<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
															<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="60" style="width: 20%;">
																20%
															</div>
														</div>
													</td>
												</tr>
										
											
											</tbody>
										</table>
									</div>
								</div>
			  		</dir>
				
				</div>
			<div class="col-md-6 " >
				<dir class="body-project">
				<img src="<?php echo base_url('assets/images/main_index/advance-footer-4.png'); ?>" class="img-responsive">
				</dir>

			
			  			
			  			<div class="panel-body">
			  				<header class="panel-heading">
									
					
									<h2 class="panel-title"><b>ระบบฐานข้อมูลเชิงพื้นที่การเปลี่ยนแปลงพื้นที่ชายฝั่งทะเลไทย</b></h2>
									<p class="panel-subtitle" style="text-indent: 2.5em;">ในอดีตการเปลี่ยนแปลงชายฝั่งทะเลประเทศไทย จะเกิดขึ้นอย่างค่อยเป็นค่อยไปตามกระบวนการเปลี่ยนแปลงตามธรรมชาติ และจะปรับสภาพชายฝั่งให้เข้าอยู่ในภาวะสมดุลอยู่ตลอดเวลาที่เรียกว่าสมดุลแบบพลวัต (Dynamic equilibrium) ตามรอบฤดูกาล ซึ่งเป็นความสมดุลบนความเคลื่อนไหวตามธรรมชาติ แต่ในในช่วง 3 ทศวรรษ ที่ผ่านมาชายฝั่งทะเลประเทศไทยเกิดการกัดเซาะอย่างรุนแรง ทั้งเกิดจากการเปลี่ยนแปลงสภาพทางธรรมชาติและสิ่งแวดล้อมในปัจจุบัน การขาดตะกอนสะสมตัวเพราะสิ่งก่อสร้างต่างๆ ที่ไปขวางกั้นทางน้ำโดยมนุษย์ เช่น สะพาน ถนน แนวกันคลื่น</p>
								</header>
			  			</div>
			  


				</div>
			</div>
		</div>
	</div>

















	<section class="promo_full">
		<div class="promo_full_wp magnific">
			<div>
				<h4 style="font-size: 28px;">เป็นองค์กรหลักในการบริหารจัดการ</h4>
				<h4 style="font-size: 22px;">
					ทรัพยากรทางทะเลชายฝั่งให้มีความอุดมสมบูรณ์ฺและยั่งยืน
				</h4>

			</div>
		</div>
	</section>


			
 <div class="content-section-a" style="padding: 20px 0 60px;">
			<div class="container">
				<div class="row">


					<div class="col-md-4">
						<h3 class="widget-title">ข่าวสาร <?php // echo $this->session->userdata('isUserLoggedIn'); ?></h3>
						<hr>

						<div class="sidebar-tabing" >

							<?php if(count($rs) != 0){ ?>
					<?php foreach($rs as $row) { ?>

									<div class="media"> 
										<a href="<?php echo base_url('/publicRelations/content/'.$row['id']); ?>"> 
											<img class="d-flex mr-3" src="<?php echo base_url('/assets/admin/blog/'.$row['Thumbnail_Url']); ?>"  style="float:left">
										</a>
									<div class="media-body">
										<div class="news-title">
											<a href="<?php echo base_url('/publicRelations/content/'.$row['id']); ?>" class="media-news"><?php echo $row['Title_a']; ?></a>
										</div>
										<div class="news-auther"><span class="time"><i class="fa fa-clock-o"></i> <?php echo DateThai($row['Create_Date']); ?>, <i class="fa fa-folder-o"></i> ข่าวสาร</span></div>
									</div>
								  </div>

							 <?php } ?> 
					<?php } ?>     

					   <!--     <div class="media"> 
										<a href="#"> <img class="d-flex mr-3" src="<?php echo base_url('assets/images/news/pic-201711201511165387332.png'); ?>"  style="float:left">
										</a>
									<div class="media-body">
										<div class="news-title">
											<a href="#" class="media-news">ทช.ประชุมรับฟังคำชี้แจงหลักการจัดทำแผนปฏิรูปองค์กร</a>
										</div>
										<div class="news-auther"><span class="time"><i class="fa fa-clock-o"></i> 4 พ.ย. 2560, <i class="fa fa-folder-o"></i> ข่าวสาร</span></div>
									</div>
								  </div>

							<div class="media"> 
										<a href="#"> <img class="d-flex mr-3" src="<?php echo base_url('assets/images/news/pic-201711131510561787379.JPG'); ?>"  style="float:left">
										</a>
									<div class="media-body">
										<div class="news-title">
											<a href="#" class="media-news">รองฯ โสภณ หารือคณะทำงานการจัดประชุมขยะทะเลอาเซียน</a>
										</div>
										<div class="news-auther"><span class="time"><i class="fa fa-clock-o"></i> 4 พ.ย. 2560, <i class="fa fa-folder-o"></i> ข่าวสาร</span></div>
									</div>
								  </div> -->


						  </div>
						  <hr>
						  <div class="textwidget-more" style="float: right;"><a href="<?php echo base_url('PublicRelations/content_list'); ?>">ดูข่าวสารทั้งหมด <i class="fa fa-arrow-right"></i></a></div>

	
		  			</div>


		  			<div class="col-md-4">
						<h3 class="widget-title">บทความ</h3>
						<hr>
						<div class="sidebar-tabing" >

								  <?php if(count($rt) != 0){ ?>
					<?php foreach($rt as $rows) { ?>

									<div class="media"> 
										<a href="<?php echo base_url('/publicRelations/content/'.$rows['id']); ?>"> <img class="d-flex mr-3" src="<?php echo base_url('/assets/admin/blog/'.$rows['Thumbnail_Url']); ?>"  style="float:left">
										</a>
									<div class="media-body">
										<div class="news-title">
											<a href="<?php echo base_url('/publicRelations/content/'.$rows['id']); ?>" class="media-news"><?php echo $rows['Title_a']; ?></a>
										</div>
										<div class="news-auther"><span class="time"><i class="fa fa-clock-o"></i> <?php echo DateThai($rows['Create_Date']); ?>, <i class="fa fa-folder-o"></i> บทความ</span></div>
									</div>
								  </div>

							 <?php } ?> 
					<?php } ?>     


						  </div>
						  <hr>
						  <div class="textwidget-more" style="float: right;"><a href="<?php echo base_url('PublicRelations/content_list'); ?>">ดูบทความทั้งหมด  <i class="fa fa-arrow-right"></i></a></div>

	
		  			</div>

		  			<div class="col-md-4">
						<h3 class="widget-title">รู้จักเรา</h3>
						<hr>
						<div style="margin-top: -15px;">
							
							<iframe src="https://player.vimeo.com/video/242977011" width="370" height="250" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
							<p style="margin-top: -10px; padding-left: 5px;"><strong style="color:#9e9e9e">"ทรัพยากรทางทะเลและชายฝั่ง"</strong> หมายความว่า สิ่งที่มีอยู่หรือเกิดขึ้นตามธรรมชาติในบริเวณทะเลและชายฝั่ง รวมถึงพรุชายฝั่ง พื้นที่ชุ่มน้ําชายฝั่ง คลอง คูแพรก ทะเลสาบ และบริเวณพื้นที่ปากแม่น้ํา ที่มีพื้นที่ติดต่อกับทะเลหรืออิทธิพลของน้ําทะเลเข้าถึง เช่น ป่าชายเลน ป่าชายหาด หาด ที่ชายทะเล เกาะ หญ้าทะเล ปะการัง ดอนหอย พืชและสัตว์ทะเล  </p>
						</div>

	
		  			</div>


				</div>
			</div>
</div>


















