<?php
require_once("application/libraries/mpdf/mpdf.php");
$stylesheet = file_get_contents("css/bootstrap.min.css");
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <base href="<?php echo base_url()?>" ></base>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>&nbsp;</title>

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" media="all" >
    
</head>

<body>

    <div class="container" >

        <table>
            <tr>
                <td style="padding: 8px; vertical-align: top; width: 100px;" >
                    <img src="images/logo.jpg" class="img-responsive" style="width: 80px;"  />
                </td>
                <td style="padding: 8px; vertical-align: middle;">
                    <h3>ข้อมูลการขอรับบริการฝนหลวง</h3>
                    <h5>กลุ่มวิชาการปฏิบัติการฝนหลวง กองปฏิบัติการฝนหลวง กรมฝนหลวงและการบินเกษตร</h5>
                </td>
            </tr>
        </table>
        
        <table class="table table-bordered" >
            <tr>
                <th style="padding: 8px; vertical-align: top;" bgcolor="#fcf8e3" colspan="2" >
                    ส่วนที่ 1 รายละเอียดเอกสารขอรับบริการ
                </th>
            </tr>
            <tr>
                <td style="padding: 8px; vertical-align: top; width: 120px;">วันที่รับเรื่อง</td>
                <td style="padding: 8px; vertical-align: top;"><?php echo mysql_to_th($value->request_date,'F',FALSE)?></td>
            </tr>
            <tr>
                <td style="padding: 8px; vertical-align: top;">เลขที่เรื่อง</td>
                <td style="padding: 8px; vertical-align: top;"><?php echo $value->form_number?></td>
            </tr>
            <tr>
                <td style="padding: 8px; vertical-align: top;">ผู้รับผิดชอบ</td>
                <td style="padding: 8px; vertical-align: top;"><?php echo $value->operation_center->title?></td>
            </tr>
            <tr>
                <td style="padding: 8px; vertical-align: top;">ช่องทางขอรับบริการ</td>
                <td style="padding: 8px; vertical-align: top;">
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
                <td style="padding: 8px; vertical-align: top;">พื้นที่ขอรับบริการ</td>
                <td style="padding: 8px; vertical-align: top;"> 
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
                <td style="padding: 8px; vertical-align: top;">ชื่อผู้ขอรับบริการ<br />รายละเอียด</td>
                <td style="padding: 8px; vertical-align: top;">
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
                <td style="padding: 8px; vertical-align: top;">ชื่อผู้ติดต่อกลับ<br />รายละเอียด</td>
                <td style="padding: 8px; vertical-align: top;">
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
            <tr class="warning" >
                <th style="padding: 8px; vertical-align: top;" colspan="5" >
                    ส่วนที่ 2 การดำเนินการ
                </th>
            </tr>
            <tr>
                <th style="padding: 8px; vertical-align: top; width: 30px;" >ลำดับ</th>
                <th style="text-align: center;" >รายละเอียด</th>
                <th style="text-align: center;" >ผู้ดำเนินการ/หน่วยงาน</th>
                <th style="text-align: center; width: 125px;" >วันที่</th>
                <th style="width: 80px;" >สถานะ</th>
            </tr>
            <?php if($value->request_rain_progess->id):?>
                <?php foreach ($value->request_rain_progess->order_by('progess_date','ASC')->get() as $key => $progess):?>
                <tr>
                    <td style="padding: 8px;" ><?php echo $key+1?></td>
                    <td style="padding: 8px;" >
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
                                            echo '<strong style="font-weight: bold;" >'.$province->title.'</strong> (';
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
                                            echo '<strong style="font-weight: bold;" >'.$province->title.'</strong> (';
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
                    <td style="padding: 8px;" ><?php echo $progess->user->center->center_name?></td>
                    <td style="padding: 8px;" ><?php echo mysql_to_th($progess->progess_date,"F",false)?></td>
                    <td style="padding: 8px;" ><?php echo $progess->request_rain_status->short_title?></td>
                </tr>
                <?php endforeach?>
            <?php else:?>
                <tr>
                    <td colspan="5" style="padding: 8px; vertical-align: top; text-align: center;" >- ยังไม่มีการดำเนินการ -</td>
                </tr>
            <?php endif?>
        </table>

        <table style="width: 100%; position: relative;">
            <tr>
                <td style="text-align: right; font-size:12pt;">ข้อมูล ณ วันที่</td>
                <td style="text-align: center; font-size:12pt; width: 250px;"><?php echo mysql_to_th($value->request_date,"F",false)?></td>            </tr>
        </table>

    </div>
    
</body>

</html>
<?php
$html = ob_get_contents();
$pdf = new mPDF('th', 'A4', '0', '',15, 15, 16, 16);
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$style = '
    @page {
        margin: 0 20px;
    }
    .pagebreak {
        page-break-after: always;
    }';
?>
<div style="text-align: left;"><?php $pdf->WriteHTML($stylesheet, 1);?></div>
<div style="text-align: left;"><?php $pdf->WriteHTML($style,1);?></div>
<div style="text-align: left;"><?php $pdf->WriteHTML($html, 2);?></div>
<?php
if(!@file_exists("requests")) {
    $old = umask(0);
    @mkdir("requests",0777);
    @umask($old);
}
$pdf->Output("requests/".$value->uid.".pdf");