<h3>ผลการปฏิบัติการฝนหลวงประจำเดือน / สัปดาห์</h3>

<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#per_week" data-get-list="week" aria-controls="per_week" role="tab" data-toggle="tab">รายสัปดาห์</a></li>
        <li role="presentation"><a href="#per_week2" data-get-list="week2" aria-controls="per_week2" role="tab" data-toggle="tab">รายสัปดาห์ (กส.9)</a></li>
        <li role="presentation"><a href="#per_month" data-get-list="month" aria-controls="per_month" role="tab" data-toggle="tab">รายเดือน</a></li>
        <li role="presentation"><a href="#per_month2" data-get-list="month2" aria-controls="per_month2" role="tab" data-toggle="tab">รายเดือน (กส.9)</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="per_week"></div>
        <div role="tabpanel" class="tab-pane" id="per_week2"></div>
        <div role="tabpanel" class="tab-pane" id="per_month"></div>
        <div role="tabpanel" class="tab-pane" id="per_month2"></div>
    </div>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		
		$("[data-get-list]").click(function(){
			var has = $(this).attr("data-get-list");
			
			$.get("reports/get_list/"+has, function(data) {
				$("#per_"+has).html(data);
			})
			
		})
		
	})
</script>