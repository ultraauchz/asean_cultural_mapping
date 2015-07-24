<h3>ร้องเรียน/ร้องทุกข์</h3>
<div class="form-group">
	<label style='font-weight:bold;' for="name">ชื่อ - นามสกุล</label>
	<div><? echo $rs->name; ?></div>
</div>

<div class="form-group">
	<label style='font-weight:bold;' for="email">Email address</label>
	<div><? echo $rs->email; ?></div>
</div>

<div class="form-group">
	<label style='font-weight:bold;' for="tel">เบอร์โทรติดต่อ</label>
	<div><? echo $rs->tel; ?></div>
</div>

<div class="form-group">
	<label style='font-weight:bold;' for="detail">รายละเอียดการร้องเรียน</label>
	<div><? echo $rs->detail; ?></div>
</div>
