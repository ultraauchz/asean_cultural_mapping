<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <base href="<?php echo base_url()?>" ></base>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>กรมฝนลวงและการบินเกษตร</title>

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" media="all" >
    <style type="text/css" >
    	@media print {
    		body {
    			font-size: 12px;
    		}
    		.pagebreak {page-break-after: always;}
    	}
    </style>
	
</head>

<body>

    <div class="container" >

        <table>
            <tr>
                <td style="width: 100px;" >
                    <img src="images/logo.jpg" class="img-responsive" style="width: 80px;"  />
                </td>
                <td>
                    <h3>ข้อมูลการขอรับบริการฝนหลวง</h3>
                    <h5>กลุ่มวิชาการปฏิบัติการฝนหลวง กองปฏิบัติการฝนหลวง กรมฝนหลวงและการบินเกษตร</h5>
                </td>
            </tr>
        </table>
    	
    	<table class="table table-bordered" >
    		<tr>
    			<th colspan="2" style="background: #eee;" >
    				ส่วนที่ 1 รายละเอียดเอกสารขอรับบริการ
    			</th>
    		</tr>
            <tr>
                <td style="width: 200px;" >วันที่รับเรื่อง</td>
                <td><?php echo mysql_to_th($value->request_date,'F',FALSE)?></td>
            </tr>
    		<tr>
    			<td>เลขที่เรื่อง</td>
    			<td><?php echo $value->form_number?></td>
    		</tr>
    		<tr>
    			<td>ผู้รับผิดชอบ</td>
				<td><?php echo $value->operation_center->title?></td>
    		</tr>
    		<tr>
    			<td>ช่องทางขอรับบริการ</td>
    			<td>
    				<?php
    					switch ($value->request_type) {
                            case 1:
                                echo " หนังสือราชการ : ".$value->request_detail;
                                break;
                            case 2:
                                echo "โทรศัพท์";
                                break;
                            case 3:
                                echo "เว็บไซต์";
                                break;
                            case 4:
                                echo "ขอรับบริการด้วยตนเอง";
                                break;
                            default:
                                echo "อื่นๆ : ".$value->request_detail;
                                //  echo "<span style=\"color: #f00;\" >ไม่ทราบ</span>";
                                break;
						}
    				?>
    			</td>
    		</tr>
            <tr>
                <td>พื้นที่ขอรับบริการ</td>
                <td> 
                    <?php 
                        foreach ($value->request_rain_area_province as $provinces => $province) {
                            echo '<div>';
                            echo '<b style="font-weight: bold;" >'.$province->title.'</b> (';
                            foreach ($value->request_rain_area_amphur->where('province_id',$province->province_id)->get() as $amphurs => $amphur) {
                                if($amphurs!=0) echo ", ";
                                echo trim($amphur->title);
                            }
                            echo ')</div>';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td style="width: 200px;" >ชื่อผู้ขอรับบริการ<br />รายละเอียด</td>
                <td>
                    <?php
                        echo '<p>'.$value->title.$value->firstname." ".$value->lastname;
                        echo '<p></p>';
                        echo 'โทรศัพท์ ';
                        echo ($value->tel_number) ? $value->tel_number : '- ';
                        echo ' อีเมล์ ';
                        echo ($value->email) ? $value->email : '- ';
                        echo '</p>';

                        echo '<p>ที่อยู่ ';
                        if($value->address_number) {
                            echo $value->address_number.' ';
                        }

                        if($value->address_moo) {
                            echo 'หมู่ที่ '.$value->address_moo.' ';
                        }
                        
                        if($value->address_soi) {
                            echo 'ซอย '.$value->address_soi.' ';
                        }
                        
                        if($value->address_road) {
                            echo 'ถนน '.$value->address_road.' ';
                        }

                        echo '</p><p>';

                        if($value->address_province_id==1) {
                            echo 'แขวง'.$value->address_district->title.'&nbsp;';
                            echo $value->address_amphur->title;
                            echo '</p><p>';
                            echo $value->address_province->title.'&nbsp;';
                        } else {
                            echo 'ตำบล '.$value->address_district->title.'&nbsp;';
                            echo 'อำเภอ '.$value->address_amphur->title;
                            echo '</p><p>';
                            echo 'จังหวัด '.$value->address_province->title.'&nbsp;';
                        }

                        echo $value->address_code.'</p>';
                    ?>
                </td>
            </tr>
            <tr>
                <td>ชื่อผู้ติดต่อกลับ<br />รายละเอียด</td>
                <td>
                    <?php
                        if($value->recall_type==1) {
                            echo 'ผู้ขอรับบริการ';
                        } else {
                            echo '<p>'.$value->recall_title.$value->recall_firstname." ".$value->recall_lastname;
                            echo '<p></p>';
                            echo 'โทรศัพท์ ';
                            echo ($value->recall_tel_number) ? $value->recall_tel_number : '- ';
                            echo ' อีเมล์ ';
                            echo ($value->recall_email) ? $value->recall_email : '- ';
                            echo '</p>';
                            echo '<p>ที่อยู่ ';
                            if($value->recall_number) {
                                echo $value->recall_number.' ';
                            }

                            if($value->recall_moo) {
                                echo 'หมู่ที่ '.$value->recall_moo.' ';
                            }
                            
                            if($value->recall_soi) {
                                echo 'ซอย '.$value->recall_soi.' ';
                            }
                            
                            if($value->recall_road) {
                                echo 'ถนน '.$value->recall_road.' ';
                            }
                            
                            echo '</p><p>';

                            if($value->recall_province_id==1) {
                                echo 'แขวง'.$value->recall_district->title.'&nbsp;';
                                echo $value->recall_amphur->title;
                                echo '</p><p>';
                                echo $value->recall_province->title.'&nbsp;';
                            } else {
                                echo 'ตำบล '.$value->recall_district->title.'&nbsp;';
                                echo 'อำเภอ '.$value->recall_amphur->title;
                                echo '</p><p>';
                                echo 'จังหวัด '.$value->recall_province->title.'&nbsp;';
                            }

                            echo $value->recall_address_code.'</p>';
                        }
                    ?>
                </td>
            </tr>
    	</table>

        <div class="pagebreak" ></div>
        <div class="clearfix" >&nbsp;</div>
    	
    	<table class="table table-bordered" >
    		<tr>
    			<th colspan="5" style="background: #eee;" >
    				ส่วนที่ 2 การดำเนินการ
    			</th>
    		</tr>
    		<tr>
				<th style="width: 30px;" >ลำดับ</th>
    			<th>รายละเอียด</th>
    			<th>ผู้ดำเนินการ/หน่วยงาน</th>
    			<th>วันที่</th>
    			<th style="width: 80px;" >สถานะ</th>
    		</tr>
    		<?php if($value->request_rain_progess->id):?>
				<?php foreach ($value->request_rain_progess->order_by('progess_date','ASC')->get() as $key => $progess):?>
                    <tr>
                        <td><?php echo $key+1?></td>
                        <td>
                            <?php
                                switch ($progess->request_rain_status_id) {
                                    case 1:
                                        echo '<strong>รับเรื่องขอรับบริการฝนหลวง</strong>';
                                        break;
                                    case 2:
                                        echo '<strong>วางแผนปฏิบัติการให้ความช่วยเหลือ</strong>';
                                            foreach ($progess->request_rain_progess_province as $provinces => $province) {
                                                $i=0;
                                                echo '<div>';
                                                echo '<strong>'.$province->title.'</strong> (';
                                                foreach ($progess->request_rain_progess_amphur as $amphurs => $amphur) {
                                                    if($amphur->province_id==$province->province_id) {
                                                        if($i!=0) echo ', ';
                                                        echo $amphur->second_title;
                                                        $i++;
                                                    }
                                                }
                                                echo ')</div>';
                                            }
                                        break;
                                    case 3:
                                        echo ($progess->detail) ? $progess->detail : '<strong>รายงานความก้าวหน้า</strong>';
                                        break;
                                    case 4:
                                        switch ($progess->help_rain_level) {
                                            case 1:
                                                $rain_level = 'ฝนตกเล็กน้อย';
                                                break;
                                            case 2:
                                                $rain_level = 'ฝนตกปานกลาง';
                                                break;
                                            case 3:
                                                $rain_level = 'ฝนตกหนัก';
                                                break;
                                            case 4:
                                                $rain_level = 'ฝนตกหนักมาก';
                                                break;
                                            default:
                                                $rain_level = 'ไม่ทราบ';
                                                break;
                                        }
                                        echo "<strong>ปฏิบัติการสำเร็จ : $rain_level</strong>";
                                            foreach ($progess->request_rain_progess_province as $provinces => $province) {
                                                $i=0;
                                                echo '<div>';
                                                echo '<strong>'.$province->title.'</strong> (';
                                                foreach ($progess->request_rain_progess_amphur as $amphurs => $amphur) {
                                                    if($amphur->province_id==$province->province_id) {
                                                        if($i!=0) echo ', ';
                                                        echo $amphur->second_title;
                                                        $i++;
                                                    }
                                                }
                                                echo ')</div>';
                                            }
                                        break;
                                    case 5:
                                        switch ($progess->recall_type) {
                                            case 1:
                                                $recall = 'โทรศัพท์';
                                                break;
                                            case 2:
                                                $recall = 'หนังสือราชการ '.$progess->recall_type_detail;
                                                break;
                                            case 3:
                                                $recall = 'ไปรษณีย์บัตร';
                                                break;
                                            case 4:
                                                $recall = 'อื่นๆ '.$progess->recall_type_detail;
                                                break;
                                        }
                                        echo "<strong>การตอบกลับผู้ขอรับบริการ : $recall</strong>";
                                        break;
                                    case 6:
                                        echo '<strong>ยุติเรื่องขอรับบริการฝนหลวง</strong>';
                                        break;
                                }
                            ?>
                        </td>
                        <td><?php echo $progess->user->center->center_name?></td>
                        <td><?php echo mysql_to_th($progess->progess_date,"F",false)?></td>
                        <td><?php echo $progess->request_rain_status->short_title?></td>
                    </tr>
                    <?php endforeach?>
			<?php else:?>
				<tr>
					<td colspan="5" style="text-align: center;" >- ยังไม่มีการดำเนินการ -</td>
				</tr>
			<?php endif?>
    	</table>

        <table style="width: 100%; position: relative;">
            <tr>
                <td style="text-align: right; font-size:12pt;">ข้อมูล ณ วันที่</td>
                <td style="text-align: center; font-size:12pt; width: 250px;"><?php echo mysql_to_th($value->request_date,"F",false)?></td>
            </tr>
        </table>

    </div>
    
</body>

</html>