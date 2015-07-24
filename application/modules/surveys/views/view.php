<h2><?php echo $value->title?></h2>
<small><?php echo mysql_to_th($value->created,"F",TRUE)?></small>
<hr />

<?php if($this->session->flashdata("error")==1):?>
<div class="alert alert-error" >
	<strong><?php echo $this->session->flashdata("msg")?></strong>
</div>
<?php endif?>

<?php if(file_exists($value->image_path)):?>
<div style="text-align: center;" >
<img src="<?php echo $value->image_path?>" class="img-polaroid" style="margin: auto;" />
</div>
<div class="clearfix" >&nbsp;</div>

<hr />
<?php endif?>

<?php echo (empty($value->detail))?null:$value->detail.'<hr>'; ?>
    
    
<?php if(file_exists($value->file_path)):?>
	<a href="contents/download/<?php echo $value->id?>" title="<?php echo $value->title?>" target="_blank" >
		<button type="button" class="btn btn-primary" > <span class="icon-download-alt"></span> ดาวน์โหลด</button>
	</a>
	<div class="clearfix" >&nbsp;</div>

	<hr />
<?php endif?>


<?php if($status == 'survey') { ?> 
	<form class="form-horizontal" action="surveys/send/<?php echo $value->id?>" method="post" >
		<fieldset>
			
			<?php foreach ($value->survey_question->get() as $num => $row):?>
			<div class="control-group" >
				<label class="control-label" ><?php echo $row->title?></label>
				<div class="controls" >
					<?php
						switch ($row->survey_question_type_id) {
							case 1:
								echo form_input("input_x".$row->id);
								break;
							case 2:
								echo form_textarea("textarea_".$row->id);
								break;
							case 3:
								foreach ($row->survey_question_choice->get() as $foo => $bar) {
									echo "<label>".form_checkbox("checkbox_".$row->id,$bar->id)." ".$bar->title."</label>";
								}
								break;
							case 4:
								foreach ($row->survey_question_choice->get() as $foo => $bar) {
									echo "<label>".form_radio("radio_".$row->id,$bar->id)." ".$bar->title."</label>";
								}
								break;
						}
					?>
				</div>
			</div>
			<?php endforeach?>
	 
		    <div class="control-group">
				<div class="controls">
					<img src="surveys/captcha" />
				</div>
		    </div>
	 
		    <div class="control-group">
				<div class="controls">
					<input type="text" class="form-control" name="captcha" maxlength="6" style="width:150px;" />
				</div>
		    </div>
	 
		    <div class="control-group">
				<div class="controls">
					<button type="submit" class="btn btn-success" >ยืนยัน</button>
				</div>
		    </div>
			
		</fieldset>
	</form>
<? } else { 
		function cal_perc($most = 0, $cur = 0) {
			if($most == 0 || $cur == 0) {
				return 0;
			} else {
				return str_replace('.00', null, number_format(((100/$most)*$cur), 2));
			}
		}

		
		foreach($ans_list as $item) {
			echo '<h4>'.$item['title'].'</h4>';
			?>
			<div class="progress progress-info">
				<div class="bar" style="width:<?php echo cal_perc($ans_perc['most_val'], $item['answer_amount']); ?>%;"><?php echo cal_perc($ans_perc['most_val'], $item['answer_amount']); ?>%</div>
			</div>
			<?/**/
		}/***/
	?>
	<div class='pull-right'><a href='surveys'><button class='btn btn-danger'>ย้อนกลับ</button></a></div>
<? } ?>