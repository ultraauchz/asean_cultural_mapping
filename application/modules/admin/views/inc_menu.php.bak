<nav class="navbar navbar-default" role="navigation">
	
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <a class="navbar-brand" href="#">
            </a>
            
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            	<li class="hidden-sm" ><a href="<?php echo base_url()?>" title="ดูหน้าเว็บไซต์" target="_blank" ><span class="glyphicon glyphicon-home" ></span></a></li>
                <li<?php if(uri_segment(2,null)) echo " class=\"active\" "?>><a href="admin">หน้าแรก</a></li>
                
                <?php if((permission("menus","views")) || (permission("sidebars","views"))):?>
                <li class="dropdown<?php if((uri_segment(2,"menus")) || (uri_segment(2,"sidebars"))) echo " active"?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">เมนู <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php if(permission("sidebar","views")):?>
                        <li><a href="admin/menus/">เมนูบน</a></li>
                        <?php endif?>
                        <?php if(permission("sidebar","views")):?>
                        <li><a href="admin/sidebars">เมนูข้าง</a></li>
                        <?php endif?>
                    </ul>
                </li>
                <?php endif?>

                
                <?php if(permission("pages","views")):?>
                <li<?php if(uri_segment(2,"pages")) echo " class=\"active\" "?>><a href="admin/pages">หน้าทั่วไป</a></li>
                <?php endif?>
                
                <?php if(permission("coverpages","views")):?>
                <li<?php if(uri_segment(2,"coverpages")) echo " class=\"active\" "?>><a href="admin/coverpages">หน้าก่อนเข้าเว็บไซต์</a></li>
                <?php endif?>
                
                <?php if((permission("hilights","views")) || (permission("slides","views"))):?>
                <li class="dropdown<?php if((uri_segment(2,"hilights")) || (uri_segment(2,"slides"))) echo " active"?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">ไฮไลท์ <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php if(permission("hilights","views")):?>
                        <li><a href="admin/hilights/">ไฮไลท์</a></li>
                        <?php endif?>
                        <?php if(permission("sidebar","views")):?>
                        <li><a href="admin/slides">ลิงค์ตัววิ่ง</a></li>
                        <?php endif?>
                    </ul>
                </li>
                <?php endif?>
                
                <?php if(($has_permission==1) || (permission("content_groups","views"))):?>
                <li class="dropdown<?php if(uri_segment(2,"contents")) echo " active"?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">ข่าว <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                    	<?php foreach ($contents as $key => $content):?>
	                    	<?php if(permission("content_$content->id","views")):?>
	                    	<li><a href="admin/contents?g=<?php echo $content->id?>" ><?php echo $content->title?></a></li>
	                    	<?php endif?>
                    	<?php endforeach?>
                        <li class="divider"></li>
                		<?php if(permission("content_groups","views")):?>
                        <li><a href="admin/content_groups">จัดการประเภท</a></li>
                        <?php endif?>
                    </ul>
                </li>
                <?php endif?>
                
                <?php if(permission("galleries","views")):?>
                <li<?php if(uri_segment(2,"galleries")) echo " class=\"active\" "?>><a href="admin/galleries">อัลบั้มรูป</a> </li>
                <?php endif?>
                
                <?php if(permission("videos","views")):?>
                <li<?php if(uri_segment(2,"videos")) echo " class=\"active\" "?>><a href="admin/videos">วีดีโอ</a> </li>
                <?php endif?>
                
                <?php if(permission("events","views")):?>
                <li<?php if(uri_segment(2,"events")) echo " class=\"active\" "?>>
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">ปฏิทินกิจกรรม <span class="caret"></span></a>
                	<ul class="dropdown-menu" role="menu">
                		<?php foreach ($events as $key => $event):?>
                    	<li><a href="admin/events?g=<?php echo $event->id?>" ><?php echo $event->title?></a></li>
                    	<?php endforeach?>
                   		<li class="divider"></li>
                        <li><a href="admin/events_type">จัดการประเภท</a></li>
                    </ul>
               </li>	
                <?php endif?>
                 
                <?php if(permission("polls","views")):?>
                <li<?php if(uri_segment(2,"poll")) echo " class=\"active\" "?>><a href="admin/poll">แบบสำรวจ</a> </li>
                <li class="dropdown<?php if(uri_segment(2,"faqs")) echo " active"?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">FAQ <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                    	<?php foreach ($faqs as $key => $content):?>
                    	<li><a href="admin/faqs?g=<?php echo $content->id?>" ><?php echo $content->title?></a></li>
                    	<?php endforeach?>
                        <li class="divider"></li>
                        <li><a href="admin/faq_groups">จัดการประเภท</a></li>
                    </ul>
                </li>
                <?php endif?>
                
                <?php if(permission("links","views")):?>
                <li class="dropdown<?php if(uri_segment(2,"links")) echo " active"?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">เว็บลิ้งค์ <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                    	<?php foreach ($links as $key => $content):?>
                    	<li><a href="admin/links?g=<?php echo $content->id?>" ><?php echo $content->title?></a></li>
                    	<?php endforeach?>
                        <li class="divider"></li>
                        <li><a href="admin/link_groups">จัดการประเภท</a></li>
                    </ul>
                </li>
                <?php endif?>
                
                <?php if(permission("departments","views")):?>
                <li<?php if(uri_segment(2,"departments")) echo " class=\"active\" "?>><a href="admin/departments">หน่วยงาน</a></li>
                <li<?php if(uri_segment(2,"ebooks")) echo " class=\"active\" "?>><a href="#" class="dropdown-toggle" data-toggle="dropdown">หนังสืออิเล็กทรอนิกส์ <span class="caret"></span></a>
                	<ul class="dropdown-menu" role="menu">
                		<li><a href="admin/ebooks" >แสดงทั้งหมด</a></li>
                    	<?php foreach ($ebooks as $key => $ebook):?>
                    		<li><a href="admin/ebooks?g=<?php echo $ebook->id?>" ><?php echo $ebook->title.' ('.count($ebook->ebook->all).')'; ?></a></li>
                    	<?php endforeach?>
                    	
                        <li class="divider"></li>
                        <li><a href="admin/ebook_groups">จัดการหมวดหมู่</a></li>
                        <li><a href="admin/ebooks/setting">ตั้งค่า</a></li>
                    </ul>
                </li>
                <?php endif?>
                
                <?php if(permission("contacts_us","views")):?>
				<li<?php if(uri_segment(2,"contacts_us")) echo " class=\"active\" "?>><a href="admin/contacts_us">ติดต่อเรา</a></li>
                <?php endif?>
                
                <?php if(permission("complains","views")):?>
				<li<?php if(uri_segment(2,"complains")) echo " class=\"active\" "?>><a href="admin/complains">เรื่องร้องเรียน</a></li>
                <?php endif?>
                	
                <?php if(permission("requests","views")):?>
                <li class="dropdown<?php if(uri_segment(2,"requests")) echo " active"?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">ระบบขอรับบริการฝนหลวง <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="admin/requests/">แจ้งขอรับบริการ</a></li>
                        <li class="divider"></li>
                        <li><a href="admin/requests/report">รายงาน</a></li>
                    </ul>
                </li>
                <?php endif?>
                
                <?php if(permission("centre","extra")):?>
				<li<?php if(uri_segment(2,"centre")) echo " class=\"active\" "?>><a href="admin/centre/manage">ศูนย์ปฏิบัติการกรม</a></li>
                <?php endif?>
                
                <?php if(permission("reports","extra")):?>
				<li<?php if(uri_segment(2,"reports")) echo " class=\"active\" "?>><a href="admin/reports">ผลการปฏิบัติการ</a></li>
                <?php endif?>
                
                <!-- <li><a href="#">Link</a> -->
            </ul>

            <ul class="nav navbar-nav navbar-right">
                
                <li class="dropdown<?php if(uri_segment(2,"settings")) echo " active"?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog" ></span> ตั้งค่า <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="admin/settings/profile">ข้อมูลส่วนตัว</a></li>
                        <?php if(permission("users","views") || permission("user_types","views") || permission("permissions","views")):?>
                            <li class="divider"></li>
                             <?php if(permission("social","extra")):?>
                            <li><a href="admin/settings/social">ตั้งค่าทั่วไป</a></li>
                			<?php endif?>
                             <?php if(permission("permissions","views")):?>
                            <li><a href="admin/settings/permissions">สิทธิการใช้งาน</a></li>
                			<?php endif?>
                             <?php if(permission("user_types","views")):?>
                            <li><a href="admin/settings/user_types">ประเภทผู้ใช้งาน</a></li>
                			<?php endif?>
                             <?php if(permission("users","views")):?>
                            <li><a href="admin/settings/users">ผู้ใช้งาน</a></li>
                			<?php endif?>
                            <?php if(permission("logs","extra")):?>
                            <li><a href="admin/logs">บันทึกการใช้งาน</a></li>
                            <?php endif?>
                        <?php endif?>
                    </ul>
                </li>
                <li><a href="admin/signout"><span class="glyphicon glyphicon-log-out" ></span> ออกจากระบบ</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>