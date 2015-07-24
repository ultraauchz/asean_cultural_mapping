<form id="form-pilot" class="form-inline" action="#" method="post" >
	
	<div style="text-align: center;" >
		<h4>แบบลงทะเบียนแหล่งข้อมูล</h4>		
		<h4>ตำแหน่งนักบินของกรมฝนหลวงและการบินเกษตร</h4>
	</div>
	
	
	
	<ul class="nav nav-tabs" id="myTab">
  		<li data-tab="1" class="active"><a href="#step1">ขั้นตอนที่ ๑</a></li>
  		<li data-tab="2" ><a href="#step2">ขั้นตอนที่ ๒.</a></li>
  		<li data-tab="3"><a href="#step3">ขั้นตอนที่ ๓.</a></li>
  		<li data-tab="4"><a href="#step4">ขั้นตอนที่ ๔.</a></li>
  		<li data-tab="5"><a href="#step5">ขั้นตอนที่ ๕.</a></li>
  		<li data-tab="6"><a href="#step6">ขั้นตอนที่ ๖.</a></li>
  		<li data-tab="7"><a href="#step7">ขั้นตอนที่ ๗.</a></li>
		<li data-tab="8"><a href="#step8">ขั้นตอนที่ ๘.</a></li>
		<li data-tab="9"><a href="#step9">ขั้นตอนที่ ๙.</a></li>
	</ul>
 
<div class="tab-content">
  <div class="tab-pane active" id="step1"><?php echo Modules::run("pilots/step",1)?></div>
  <div class="tab-pane" id="step2"><?php echo Modules::run("pilots/step",2)?></div>
  <div class="tab-pane" id="step3"><?php echo Modules::run("pilots/step",3)?></div>
  <div class="tab-pane" id="step4"><?php echo Modules::run("pilots/step",4)?></div>
  <div class="tab-pane" id="step5"><?php echo Modules::run("pilots/step",5)?></div>
  <div class="tab-pane" id="step6"><?php echo Modules::run("pilots/step",6)?></div>
  <div class="tab-pane" id="step7"><?php echo Modules::run("pilots/step",7)?></div>
  <div class="tab-pane" id="step8"><?php echo Modules::run("pilots/step",8)?></div>
  <div class="tab-pane" id="step9"><?php echo Modules::run("pilots/step",9)?></div>
</div>

</form>

<script type="text/javascript" src="js/datepicker/js/bootstrap-datepicker.js" ></script>
<script type="text/javascript" src="js/default/bootstrap.min.js" ></script>
<script type="text/javascript">

function removeGroup(e) {
	var btn = $(e);
	var group = btn.parents("tr");
	
	group.fadeOut();
		
	setTimeout(function() {
		group.remove();
	},1000)
	return false;
}

function add_row(id) {
	var data = "";
	
	switch(id) {
		case "step-2-1":
			data += "<tr>";
			data += "<td>";
			data += "<select class='form-control' name='answer_2_1[]' style='width: 70px;' >";
			for(var i=2558;i>2500;i--) {
				data += "<option value='"+i+"' >"+i+"</option>"
			}
			data += "</select>";
			data += "</td>";
			data += "<td>";
			data += "<select class='form-control' name='answer_2_2[]' style='width: 70px;' >";
			for(var i=2558;i>2500;i--) {
				data += "<option value='"+i+"' >"+i+"</option>"
			}
			data += "</select>";
			data += "</td>";
			data += "<td><input type='text' class='form-control' name='answer_2_1_3[]' style='width: 260px;' /></td>";
			data += "<td><input type='text' class='form-control' name='answer_2_1_4[]' style='width: 260px;' /></td>";
			data += "<td><button type='button' class='btn btn-mini btn-danger delete-row' onclick='removeGroup(this)' >x</button></td>";
			data += "<tr>";
			break;
		
		case "step-2-2":
			data += "<tr>";
			data += "<td><input type='text' class='form-control' name='answer_2_2_1[]' style='width: 330px;' /></td>";
			data += "<td><input type='text' class='form-control' name='answer_2_2_2[]' style='width: 330px;' /></td>";
			data += "<td><button type='button' class='btn btn-mini btn-danger delete-row' >x</button></td>";
			data += "</tr>";
			break;
			
		case "step-3":
			data += "<tr>";
			data += "<td>";
			data += "<select class='form-control' name='answer_3_1[]' style='width: 70px;' >";
			for(var i=2558;i>2500;i--) {
				data += "<option value='"+i+"' >"+i+"</option>"
			}
			data += "</select>";
			data += "</td>";
			data += "<td>";
			data += "<select class='form-control' name='answer_3_2[]' style='width: 70px;' >";
			for(var i=2558;i>2500;i--) {
				data += "<option value='"+i+"' >"+i+"</option>"
			}
			data += "</select>";
			data += "</td>";
			data += "<td><input type='text' class='form-control' name='answer_3_3[]' style='width: 115px;' /></td>";
			data += "<td><input type='text' class='form-control' name='answer_3_4[]' style='width: 115px;' /></td>";
			data += "<td><input type='text' class='form-control' name='answer_3_5[]' style='width: 115px;' /></td>";
			data += "<td><input type='text' class='form-control' name='answer_3_6[]' style='width: 115px;' /></td>";
			data += "<td><button type='button' class='btn btn-mini btn-danger delete-row' onclick='removeGroup(this)' >x</button></td>";
			data += "<tr>";
			break;
			
		case "step-5":
			data += "<tr>";
			data += "<td><input type='text' class='form-control' name='answer_5_1[]' style='width: 150px;' /></td>";
			data += "<td><input type='text' class='form-control' name='answer_5_2[]' style='width: 130px;' /></td>";
			data += "<td><input type='text' class='form-control' name='answer_5_3[]' style='width: 220px;' /></td>";
			data += "<td><input type='text' class='form-control' name='answer_5_4[]' style='width: 140px;' /></td>";
			data += "<td><button type='button' class='btn btn-mini btn-danger delete-row' onclick='removeGroup(this)' >x</button></td>";
			data += "<tr>";
			break;
			
		case "step-8":
			data += "<tr>";
			data += "<td>";
			data += "<select class='form-control' style='width: 70px;' >";
			for(var i=2558;i>2500;i--) {
				data += "<option value='"+i+"' >"+i+"</option>"
			}
			data += "</select>";
			data += "</td>";
			data += "<td>";
			data += "<select class='form-control' style='width: 70px;' >";
			for(var i=2558;i>2500;i--) {
				data += "<option value='"+i+"' >"+i+"</option>"
			}
			data += "</select>";
			data += "</td>";
			data += "<td><input type='text' class='form-control' name='answer_8_3[]' style='width: 170px;' /></td>";
			data += "<td><input type='text' class='form-control' name='answer_8_4[]' style='width: 180px;' /></td>";
			data += "<td><input type='text' class='form-control' name='answer_8_5[]' style='width: 115px;' /></td>";
			data += "<td><button type='button' class='btn btn-mini btn-danger delete-row' onclick='removeGroup(this)' >x</button></td>";
			data += "<tr>";
			break;
			
		case "step-9":
			data += "<tr>";
			data += "<td><input type='text' class='form-control datepicker' name='answer_9_1[]' readonly style='width: 150px;' /></td>";
			data += "<td><input type='text' class='form-control' name='answer_9_2[]' style='width: 130px;' /></td>";
			data += "<td><input type='text' class='form-control' name='answer_9_3[]' style='width: 220px;' /></td>";
			data += "<td><input type='text' class='form-control' name='answer_9_4[]' style='width: 140px;' /></td>";
			data += "<td><button type='button' class='btn btn-mini btn-danger delete-row' onclick='removeGroup(this)' >x</button></td>";
			data += "<tr>";
			break;
	}
	return data;
}

function getDatepicker() {
	var datepick = $(".datepicker").datepicker({
    	format: "yyyy-mm-dd"
	});
	$(".datepicker").on('changeDate', function(ev){
    	$(this).datepicker('hide');
	});
}

getDatepicker();

$('#myTab a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
});

$(".tab-step").click(function(e) {
	var step = $(this).attr("data-li");
	e.preventDefault();
	$(this).tab("show");
	$("#myTab li.active").removeClass("active");
	$("li[data-tab="+step+"]").addClass("active");
});

$(".add-row").click(function() {
	var foo = $(this);
	var row_target = foo.attr("data-target");
	var data = null;
	
	data = add_row(row_target);
	
	$(data).insertBefore("#"+row_target);
	getDatepicker();
});

</script>

<link href="js/datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.nav-tabs>li>a {
		font-size: 0.8em;
	}
</style>