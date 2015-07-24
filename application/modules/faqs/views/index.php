<style>
@page {
    size: A4;
    /*margin: 15mm 10mm;*/
}
@media print {
	.noPrint {display:none;}
	#blogSection > div > div > div.span9{ 
		width: auto; margin: 0 5%; 
		padding: 0; 
		border: 0; 
		float: none !important; 
		color: black; 
		background: transparent;  
	}
}
</style>
<script>
$(function(){
	$('#blogSection > div > div > div.span3,#headerbackground > div,#headerSection,#footerSection,.print-btn,.go-top,form').addClass('noPrint');
});
</script>

<h2>คำถามที่พบบ่อย</h2>

<form class="form-inline">
  <input type="text" class="input-large" name="search" placeholder="คำค้นหา" value="<?php echo @$_GET['search']?>">
	<select class="input-small" name="type">
	  <option value="category" <?php echo @$_GET['type'] == 'category' ? 'selected=selected' : '';?>>หมวดหมู่</option>
	  <option value="question" <?php echo @$_GET['type'] == 'question' ? 'selected=selected' : '';?>>คำถาม</option>
	  <option value="answer" <?php echo @$_GET['type'] == 'answer' ? 'selected=selected' : '';?>>คำตอบ</option>
	</select>
  <button type="submit" class="btn">ค้นหา</button>
  <a href="javascript:window.print()" class="btn pull-right print-btn"><span class="icon-print icon-white" aria-hidden="true"></span></a>
</form>

<?php foreach($faq_groups as $row):?>
<div class="bs-callout bs-callout-info" id="callout-helper-context-color-specificity">
    <h4><?php echo $row->title?></h4>
    <?php foreach($row->faq->where("status",1)->order_by('orders','asc')->get() as $item):?>
    	<p style="border-bottom: 1px dashed #ddd;padding-bottom: 10px;">Q : <?php echo $item->question?><br>A : <?php echo $item->answer?></p>
    <?php endforeach;?>
</div>
<?php endforeach;?>