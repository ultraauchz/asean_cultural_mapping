<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 					'ab');
define('FOPEN_READ_WRITE_CREATE', 				'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| My Constants
|--------------------------------------------------------------------------
|
*/
define('FIRST_ROUND_DATE','Up to 31 Mar 2013');
define('SECOND_ROUND_DATE','1 Apr - 14 Aug 2013');
define('THIRD_ROUND_DATE','15 Aug - 30 Sep 2013 or on-site**');
define('FIRST_ROUND_LIMIT','2013-03-31');
define('SECOND_ROUND_LIMIT','2013-08-14');
define('THIRD_ROUND_LIMIT','2013-09-30');
define('NOTICE_CONFIRM_DELETE', 'ยืนยันการลบ');
define('NOTICE_CONFIRM_LOGOUT', 'ยืนยันออกจากระบบ');
define('SAVE_DATA_COMPLATE','บันทึกข้อมูลเรียบร้อย');
define('DELETE_DATA_COMPLATE', 'ลบข้อมูลเรียร้อยแล้ว');
define('REMOVE_IMAGE_COMPLATE', 'ลบรูปภาพเรียบร้อยแล้ว');
define('LOGIN_FAIL', 'Username หรือ Password ไม่ถูกต้อง');

define('CURR_BASE_URL','http://www.dengue2013bangkok.com/');
define('SITE_TITLE','The Third International Conference on Dengue and Dengue Haemorrhagic Fever “ Global Dengue : Challenges and Promises”');

/* Member Profile Label*/
define('LBL_REGISTER_MEMBER_NAME_TH','ชื่อ - นามสกุล');
define('LBL_REGISTER_MEMBER_ADDRESS_TH','ที่อยู่');
define('LBL_REGISTER_MEMBER_PROVINCE_TH','จังหวัด');
define('LBL_REGISTER_MEMBER_COUNTRY_TH','ประเทศ');
define('LBL_REGISTER_MEMBER_ZIPCODE_TH','รหัสไปรษณีย์');
define('LBL_REGISTER_MEMBER_TEL_TH','เบอร์โทรศัพท์');
define('LBL_REGISTER_MEMBER_FAX_TH','เบอร์โทรสาร');
define('LBL_REGISTER_MEMBER_EMAIL_TH','อีเมล์');
define('LBL_REGISTER_MEMBER_CONFIRM_EMAIL_TH','ยืนยันอีเมล์');
define('LBL_REGISTER_MEMBER_CURRENT_PASSWORD_TH','รหัสผ่านปัจจุบัน');
define('LBL_REGISTER_MEMBER_PASSWORD_TH','รหัสผ่าน');
define('LBL_REGISTER_MEMBER_CONFIRM_PASSWORD_TH','ยืนยันรหัสผ่าน');


define('LBL_REGISTER_MEMBER_NAME_EN','Name');
define('LBL_REGISTER_MEMBER_ADDRESS_EN','Address');
define('LBL_REGISTER_MEMBER_PROVINCE_EN','Province/City');
define('LBL_REGISTER_MEMBER_COUNTRY_EN','Country');
define('LBL_REGISTER_MEMBER_ZIPCODE_EN','Zipcode/Postcode');
define('LBL_REGISTER_MEMBER_TEL_EN','Tel.');
define('LBL_REGISTER_MEMBER_FAX_EN','Fax.');
define('LBL_REGISTER_MEMBER_EMAIL_EN','Email');
define('LBL_REGISTER_MEMBER_CONFIRM_EMAIL_EN','Confirm Email');
define('LBL_REGISTER_MEMBER_CURRENT_PASSWORD_EN','Current Password');
define('LBL_REGISTER_MEMBER_PASSWORD_EN','Password');
define('LBL_REGISTER_MEMBER_CONFIRM_PASSWORD_EN','Confirm Password');
/* End of file constants.php */
/* Location: ./system/application/config/constants.php */