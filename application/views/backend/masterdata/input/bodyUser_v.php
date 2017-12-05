<input type='hidden' id='dataType' name='dataType' value=<?php echo($dataType); ?>></input>
<input type='hidden' id='rowID' name='rowID' value=<?php echo($dsInput['masterId']); ?> />
<input type='hidden' id='baseUrl' value="<?php echo(base_url()); ?>"></input>

<!-- User ID -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">User ID : </button>
		</span>
		<input type="text" class="form-control input-require" autocomplete="off"
			placeholder="UserID..." id="userID" name="UserId" value="<?php echo($dsInput['UserId']); ?>">
	</div>
</div>

<!-- Password -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">Password : </button>
		</span>
		<input type="password" class="form-control input-require" autocomplete="off" 
			readonly onfocus="this.removeAttribute('readonly');"
			placeholder="Password..." id="password" name="Password" value="<?php echo($dsInput['Password']); ?>">
	</div>
</div>

<!-- First Name -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">First Name : </button>
		</span>
		<input type="text" class="form-control input-require startFocus" autocomplete="off"
			placeholder="First Name..." id="firstName" name="First_Name" value="<?php echo($dsInput['First_Name']); ?>">
	</div>
</div>

<!-- Last Name -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">Last Name : </button>
		</span>
		<input type="text" class="form-control" autocomplete="off"
			placeholder="Last Name..." id="lastName" name="Last_Name" value="<?php echo($dsInput['Last_Name']); ?>">
	</div>
</div>

<!-- Emial -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">Email : </button>
		</span>
		<input type="text" class="form-control" autocomplete="off"
			placeholder="Email@..." id="email" name="Email" value="<?php echo($dsInput['Email']); ?>">
	</div>
</div>

<!-- Gender -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">Gender : </button>
		</span>
		<select class="form-control" id="gender" name="Gender">
			<option value=1<?php echo(($dsInput['Gender'] == 1) ? ' selected' : ''); ?>>Male</option>
			<option value=2<?php echo(($dsInput['Gender'] == 2) ? ' selected' : ''); ?>>Female</option>
		</select>
	</div>
</div>

<!-- Age -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">Age : </button>
		</span>
		<input type="text" class="form-control" autocomplete="off"
			placeholder="Age..." id="age" name="Age" value="<?php echo($dsInput['Age']); ?>">
	</div>
</div>

<!-- ID Card Number -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">ID Card Number : </button>
		</span>
		<input type="text" class="form-control" autocomplete="off"
			placeholder="ID Card Number..." id="idCardNumber" name="ID_Card_Number" value="<?php echo($dsInput['ID_Card_Number']); ?>">
	</div>
</div>

<!-- Level -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">Level : </button>
		</span>
		<select class="form-control" id="level" name="Level">
			<option value="1" <?php echo(($dsInput['Level'] == '1') ? ' selected' : ''); ?>>ผู้ดูแลระบบ</option>
			<option value="2" <?php echo(($dsInput['Level'] == '2') ? ' selected' : ''); ?>>ชำนาญการ</option>
			<option value="3" <?php echo(($dsInput['Level'] == '3') ? ' selected' : ''); ?>>ปฏิบัติการ</option>
			<option value="4" <?php echo(($dsInput['Level'] == '3') ? ' selected' : ''); ?>>อาสาสมัคร</option>
		</select>
	</div>
</div>

<!-- Department -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">Department : </button>
		</span>
		<select class="form-control input-require startFocus" id="department" name="FK_Department">
			<option value="0" selected>กรุณาเลือกหน่วยงานที่สังกัด</option>
			<?php 
				foreach($dsDepartment as $row) {
					$selected = (($dsInput['FK_Department'] == $row['id']) 
								? ' selected' : '');
					echo '<option value='.$row['id'].$selected.'>'.$row['department'].'</option>';
				}
			?>
		</select>
	</div>
</div>

<!-- Status -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">Status : </button>
		</span>
		<select class="form-control" id="status" name="Status">
			<option value="0"<?php echo(($dsInput['Status'] == 0) ? ' selected' : ''); ?>>ยังไม่เปิดใช้งาน</option>
			<option value="1"<?php echo(($dsInput['Status'] == 1) ? ' selected' : ''); ?>>พร้อมใช้งาน</option>
			<option value="2"<?php echo(($dsInput['Status'] == 2) ? ' selected' : ''); ?>>รอการยืนยัน</option>
			<option value="3"<?php echo(($dsInput['Status'] == 3) ? ' selected' : ''); ?>>รหัสถูกล๊อค</option>
		</select>
	</div>
</div>