<div class="container" style="margin-top:20px">
	<div class="row">

		<div class="sitemap">
			<h1 class="sitemap">Sitemap</h1>

			<ul class="sitemap" id="utilityNav">
				<li><a class="sitemap" href="http://www.dmcr.go.th">เวปหลัก ทช</a></li>
				<li><a class="sitemap" href="http://marinegiscenter.dmcr.go.th">ระบบฐานข้อมูลกลาง</a></li>
				
				<li><a class="sitemap" href="<?php echo base_url('users/registration'); ?>">ลงทะเบียนผู้ใช้</a></li>
				<li><a class="sitemap" href="<?php echo base_url('users/login'); ?>">เข้าสู่ระบบ</a></li>
				<li><a class="sitemap" href="<?php echo base_url('users/profile'); ?>">แก้ไขข้อมูลส่วนตัว</a></li>
				<li><a class="sitemap" href="<?php echo base_url('sitemap'); ?>">Sitemap</a></li>
			</ul>

			<ul class="sitemap" id="primaryNav">
				<li id="home"><a class="sitemap" href="<?php echo base_url('/'); ?>">หน้าหลัก</a></li>
			<!-- Report -->
				<li><a class="sitemap" href="<?php echo base_url('report'); ?>">ข้อมูลขยะ</a>
					<ul class="sitemap">
						<li><a class="sitemap" href="<?php echo base_url('mapPlace'); ?>">แผนที่</a></li>
					</ul>
				</li>
			<!-- CMS -->
				<li><a class="sitemap" href="#">หมวดข่าวสาร</a>
					<ul class="sitemap">
					<!-- News -->
						<li><a class="sitemap" href="<?php echo base_url('publicRelations/content_list/'); ?>">ข่าวสาร</a>
							<ul class="sitemap">
								<li><a class="sitemap" href="#">สารบรรณ</a></li>
								<li><a class="sitemap" href="#">เนื้อหา</a></li>
							</ul>
						</li>
					<!-- Article -->
						<li><a class="sitemap" href="<?php echo base_url('publicRelations/content_list/'); ?>">บทความ</a>
							<ul class="sitemap">
								<li><a class="sitemap" href="#">สารบรรณ</a></li>
								<li><a class="sitemap" href="#">เนื้อหา</a></li>
							</ul>
						</li>
					<!-- Project News -->
						<li><a class="sitemap" href="<?php echo base_url('publicRelations/content_list/'); ?>">ข่าวสารโครงการ</a>
							<ul class="sitemap">
								<li><a class="sitemap" href="#">สารบรรณ</a></li>
								<li><a class="sitemap" href="#">เนื้อหา</a></li>
							</ul>
						</li>
					<!-- Marine debris knowledge -->
						<li><a class="sitemap" href="<?php echo base_url('publicRelations/content_list/'); ?>">ความรู้ที่มาขยะ</a>
							<ul class="sitemap">
								<li><a class="sitemap" href="#">สารบรรณ</a></li>
								<li><a class="sitemap" href="#">เนื้อหา</a></li>
							</ul>
						</li>
					<!-- End Marine debris knowledge -->
					</ul>
				</li>
			<!-- Map -->
				<li><a class="sitemap" href="<?php echo base_url('mapPlace'); ?>">แผนที่</a>
				</li>
			<!-- Event images -->
				<li><a class="sitemap" href="<?php echo base_url('eventImageGallery'); ?>">ภาพกิจกรรม</a>
					<ul class="sitemap">
						<li><a class="sitemap" href="#">สารบรรณ</a></li>
						<li><a class="sitemap" href="#">เนื้อหา</a></li>
					</ul>
				</li>
			<!-- About us -->
				<li><a class="sitemap" href="#">เกี่ยวกับเรา</a>
				</li>
			</ul>
		</div>

	</div>
</div>