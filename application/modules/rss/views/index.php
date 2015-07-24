<h2>RSS Feed</h2>

<form action="rss" method="get" >
    <div class="form-group">
        <label for="exampleInputEmail1">เลือกประเภทข่าว</label>
        <select class="form-control" name="g" >
        	<?php foreach ($variable as $key => $value):?>
        	<option value="<?php echo $value->id?>" ><?php echo $value->title?></option>
        	<?php endforeach?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="number">จำนวนที่จะแสดง</label>
        <input type="number" class="form-control" name="n" value="50" />
    </div>
    
    <button type="submit" class="btn btn-default" >ยืนยัน</button>
</form>