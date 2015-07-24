<?php 
	foreach($pg->result() as $item) {
		$created = strtotime($item->created);
		?>
		<div class='progress_box'>
			<?php
				echo '<div>';
					echo '<strong style="margin-right:5px;">'.$item->firstname.' '.$item->lastname.'</strong>';
					echo $item->detail;
				echo '</div>';
				
				echo '<div class="created">';
					echo (date('d', $created)*1).' ';
					echo $month_th[(date('m ', $created)*1)].' ';
					echo (date('Y', $created)+543);
					echo ' เวลา '.date('H:i น.', $created);
				echo '</div>';
			?>
		</div>
		<?php
	}
?>