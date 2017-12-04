<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>กรมทรัพยากรทางทะเลและชายฝั่ง</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" media="all">
   
    <?php
        echo css_asset("customize/my-panel.css");
        echo css_asset("customize/my-daterange.css");
        if($useCssTemplate) {
            $this->load->view('template/welcome_css');
        }
    ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>"/>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image  visible-sm visible-xs-->
                <a class="navbar-brand" href="<?php echo base_url('/'); ?>">
                    <img style="margin-top:-25px;" src="<?php echo base_url('assets/images/logo/logo.png'); ?>" height="55" title="logo">
                    <a href="<?php echo base_url('/'); ?>" style="font-size: 16px;" class="site-sm-title visible-sm visible-xs"> กรมทรัพยากรชายฝั่ง</a>
                    <span class="site-sm-description visible-sm visible-xs">ฐานข้อมูลขยะทะเล</span>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav hidden-sm hidden-xs">
                    <li><a href="<?php echo base_url('/'); ?>" class="site-title"> กรมทรัพยากรชายฝั่ง</a></li>
                    <li class="li-site-description"><a href="<?php echo base_url('/'); ?>" class="site-description">
                     ฐานข้อมูลขยะทะเล</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right nav-custom-site">
                    <!-- Authentication Links -->
                    <li><a class="go-related-website-link green" href="http://www.dmcr.go.th" target="_blank"> กลับสู่เว็บหลัก กช.</a></li>
                    <li><a class="go-related-website-link red" href="http://marinegiscenter.dmcr.go.th" target="_blank"> ระบบฐานข้อมูลกลาง</a></li>
                    <li><a href="<?php echo base_url('report'); ?>"> ข้อมูลขยะ</a></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                            ข่าวสาร <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url('publicRelations/content_list/'); ?>">ข่าวสาร</a></li>
                            <li><a href="<?php echo base_url('publicRelations/content_list/'); ?>">บทความ</a></li>
                            <li><a href="<?php echo base_url('publicRelations/content_list/'); ?>">ข่าวสารโครงการ</a></li>
                            <li><a href="<?php echo base_url('publicRelations/content_list/'); ?>">ความรู้เกี่ยวกับที่มาของขยะทะเล</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url('mapPlace'); ?>"> แผนที่</a></li>
                    <li><a href="#"> รวมภาพกิจกรรม</a></li>
                    <li><a href="#"> เกี่ยวกับเรา </a></li>
                    <li class="dropdown">
                        <?php if ( $this->session->userdata('isUserLoggedIn') ) : ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-user"></i> <?php  echo $this->session->userdata('user_name'); ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url('logout'); ?>"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        <?php else : ?>
                            <a href="<?php echo base_url('users/login'); ?>"><i class="fa fa-user"></i> เข้าสุ่ระบบ</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php if($body) echo $body;?>

    <footer>
        <div class="footer-menu">
            <div class="footer-menu" style="padding-top: 35px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <h4>กรมทรัพยากรทางทะเลและชายฝั่ง<span class="head-line"></span></h4>
                            <p style="    font-size: 13px;">เลขที่ 120 หมู่ที่ 3 ชั้นที่ 5-9 อาคารรัฐประศาสนภักดี ศูนย์ราชการเฉลิมพระเกียรติ 
                            80 พรรษา 5 ธันวาคม 2550 ถนนแจ้งวัฒนะ แขวงทุ่งสองห้อง เขตหลักสี่ กรุงเทพมหานคร 10210</p>
                            <ul>
                                <li><span>โทรศัพท์ :</span> (+66) 0 2141 1299-300 </li>
                                <li><span>โทรสาร :</span> (+66) 0 2143 9242 </li>
                                <li><span>อีเมล:</span> it@dmcr.mail.go.th </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <h4>บริการ<span class="head-line"></span></h4>
                            <ul class="service-style">
                                <li><a href="<?php echo base_url('publicRelations/content_list/'); ?>">ข่าวสาร</a></li>
                                <li><a href="<?php echo base_url('mapPlace'); ?>">แผนที่</a></li>
                                <li><a href="#">รวมภาพกิจกรรม</a></li>
                                <li><a href="#">เกี่ยวกับเรา </a></li>
                                <li><a href="#">ติดต่อเรา </a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h4>ติดตามข่าวสาร<span class="head-line"></span></h4>
                            <div class="fb-page" data-href="https://www.facebook.com/DMCRTH/" data-tabs="timeline" data-height="100" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/DMCRTH/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/DMCRTH/">กรมทรัพยากรทางทะเลและชายฝั่ง</a></blockquote></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8" style="border-top: 1px solid rgba(255,255,255,.06); margin-top:25px;">
                            <p class="copyright small" style="padding-top: 15px; color: #ccc; margin: 0 0 1px;">เว็บไซต์ กรมทรัพยากรทางทะเลและชายฝั่ง แสดงผลได้ดีกับบราวเซอร์  <img src="https://www.learnsbuy.com/assets/image/chrome-512.png" style="margin-left:10px;height:25px;"> <img src="https://www.learnsbuy.com/assets/image/appicns_Firefox.png" style="height:25px;"> <img src="https://www.learnsbuy.com/assets/image/500px-Internet_Explorer_4_and_5_logo.svg.png" style="height:25px;"> <img src="https://www.learnsbuy.com/assets/image/safari_PNG28.png" style="height:25px;margin-right:10px;">  เวอร์ชั่นล่าสุด</p>
                            <p class="copyright small" style="padding: 3px 0; color: #ccc;font-size: 13px;">สงวนลิขสิทธิ์ © พ.ศ.๒๕๕๖ กรมทรัพยากรทางทะเลและชายฝั่ง</p>
                        </div>
                        <div>
                            
                        </div>
                        <div class="col-md-4" style="border-top: 1px solid rgba(255,255,255,.06); margin-top:25px;">
                            <div class="social-icon" style="float:right;margin-right:30px;margin-top:20px;">
                                <a href="https://www.facebook.com/DMCRTH" title="Facebook" target="_blank" class="social-01" rel="nofollow">fb</a>
                                <a href="https://twitter.com/dmcrth" title="Twitter" target="_blank" class="social-02" rel="nofollow">twitter</a>
                                <a href="https://www.youtube.com/channel/UC4_fXOSelonvCzuv0jc4qbg" title="Twitter" target="_blank" class="social-03" rel="nofollow">youtube</a>
                                <a href="https://www.instagram.com/dmcrth/" title="Instagram" target="_blank" class="social-04" rel="nofollow">Instagram</a>
                                <a href="http://line.me/ti/p/~@DMCRTH" title="line" target="_blank" class="social-05" rel="nofollow">line</a>
                            </div>
                            <div style="float:right;margin-right:200px;margin-top:15px;">
                                <!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
                                <!-- Histats.com  START  (aync)-->
                                <script type="text/javascript">var _Hasync= _Hasync|| [];
                                _Hasync.push(['Histats.start', '1,3962294,4,15,170,40,00011111']);
                                _Hasync.push(['Histats.fasi', '1']);
                                _Hasync.push(['Histats.track_hits', '']);
                                (function() {
                                var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
                                hs.src = ('//s10.histats.com/js15_as.js');
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
                                })();</script>
                                <noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?3962294&101" alt="unique visitors counter" border="0"></a></noscript>
                                <!-- Histats.com  END  -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.11&appId=206036876527614';
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <script type="text/javascript">
        $(window).load(function() {
            var boxheight = $('#myCarousel .carousel-inner').innerHeight();
            var itemlength = $('#myCarousel .item').length;
            var triggerheight = Math.round(boxheight/itemlength+1);
            $('#myCarousel .list-group-item').outerHeight(triggerheight);
        });

        var monthNames = [ "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December" ];
        var dayNames= ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"]

        var newDate = new Date();
        newDate.setDate(newDate.getDate() + 1);    
        $('#Date').html(dayNames[newDate.getDay()] + ", " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());
    </script>

     <?php if(isset($check_url) && $check_url == "map") : ?>
        <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/31/0/intl/th_ALL/common.js"></script>
        <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/31/0/intl/th_ALL/util.js"></script>
        <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/31/0/intl/th_ALL/infowindow.js"></script>
        <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/31/0/intl/th_ALL/map.js"></script>
        <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/31/0/intl/th_ALL/marker.js"></script>
        <style type="text/css">
            .gm-style {
                font: 400 11px Roboto, Arial, sans-serif;
                text-decoration: none;
            }
            .gm-style img { max-width: none; }
        </style>
        <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/31/0/intl/th_ALL/onion.js"></script>
        <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/31/0/intl/th_ALL/controls.js"></script>
        <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/31/0/intl/th_ALL/stats.js"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyClagICh6L2KDnt5-14byUhE-wBRnjiYeg&amp;sensor=false"></script>
        <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugin/jquery/jquery-ui.min.js"');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugin/jquery/jquery.blockUI.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/customize/my.helper.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/customize/my.mapData.js');?>" ></script>
    <?php endif; ?>

<?php if(isset($extendedJs)) echo $extendedJs; ?>
</body>
</html>
