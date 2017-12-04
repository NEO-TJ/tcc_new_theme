
<?php 

$sharelink =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
//echo $sharelink;
?>
<div class="container" style="padding: 30px 0 60px;">
    <div class="row">
        <style type="text/css">
            
            .news-title {
                height: auto;
                font-size: 1.3em;
                margin-bottom: 8px;
            }
            .sidebar-tabing img {
                width: 260px;
                max-width: 260px;
                height: 190px;
            }
            .news-title a {

                font-size: 18px;

            }
           
            .media-body img {
                margin-left: 100px;
            }
            .btn-default {
                color: #795548;
                background-color: #fff;
                border-color: #795548;
            }
            .cat-item{
                padding: 8px;
            }
            .bullet {
                color: #fff;
                font-size: 16px;
                border-radius: 50%;
                width: 28px;
                height: 28px;
                background: #dcdcdc;
                text-align: center;
                padding: 2px;
                font-weight: 700;
                display: block;
                margin: 5px 8px 0px 0px;
                line-height: 1.5;
            }
            .tab-pane i {
                float: left;
            }
            .tab-pane li {
                padding: 8px 2px;
                overflow: hidden;
                border-bottom: 1px dotted #b5b5b5;
                line-height: 1;
            }
            .widget-area-rightbar .widget-title1 {
                padding: 10px 18px 10px;
            }
            .social-nav {
    padding: 0;
    list-style: none;
    margin: -10px 0 0 -10px;
}

            .social-nav li {
    float: left;
    margin: 10px 0 0 10px;
    list-style: none;
}

.social-nav a {
    display: inline-block;
    float: left;
    width: 48px;
    height: 48px;
    font-size: 20px;
    color: #fff;
    text-decoration: none;
    cursor: pointer;
    text-align: center;
    line-height: 48px;
    background: #000;
    position: relative;
    transition: all 0.5s;
    -ms-transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}
.social-nav a {
    overflow: hidden;
    font-size: 26px;
    border-radius: 4px;
}
.social-nav a:hover {
    background: #fff;
    text-shadow: 0px 0px #d4d4d4, 1px 1px #d4d4d4, 2px 2px #d4d4d4, 3px 3px #d4d4d4, 4px 4px #d4d4d4, 5px 5px #d4d4d4, 6px 6px #d4d4d4, 7px 7px #d4d4d4, 8px 8px #d4d4d4, 9px 9px #d4d4d4, 10px 10px #d4d4d4, 11px 11px #d4d4d4, 12px 12px #d4d4d4, 13px 13px #d4d4d4, 14px 14px #d4d4d4, 15px 15px #d4d4d4, 16px 16px #d4d4d4, 17px 17px #d4d4d4, 18px 18px #d4d4d4, 19px 19px #d4d4d4, 20px 20px #d4d4d4, 21px 21px #d4d4d4, 22px 22px #d4d4d4, 23px 23px #d4d4d4, 24px 24px #d4d4d4, 25px 25px #d4d4d4, 26px 26px #d4d4d4, 27px 27px #d4d4d4, 28px 28px #d4d4d4, 29px 29px #d4d4d4, 30px 30px #d4d4d4;
}
.social-nav .twitter {
    background: #00ACED;
    text-shadow: 0px 0px #0087ba, 1px 1px #0087ba, 2px 2px #0087ba, 3px 3px #0087ba, 4px 4px #0087ba, 5px 5px #0087ba, 6px 6px #0087ba, 7px 7px #0087ba, 8px 8px #0087ba, 9px 9px #0087ba, 10px 10px #0087ba, 11px 11px #0087ba, 12px 12px #0087ba, 13px 13px #0087ba, 14px 14px #0087ba, 15px 15px #0087ba, 16px 16px #0087ba, 17px 17px #0087ba, 18px 18px #0087ba, 19px 19px #0087ba, 20px 20px #0087ba, 21px 21px #0087ba, 22px 22px #0087ba, 23px 23px #0087ba, 24px 24px #0087ba, 25px 25px #0087ba, 26px 26px #0087ba, 27px 27px #0087ba, 28px 28px #0087ba, 29px 29px #0087ba, 30px 30px #0087ba;
}
.social-nav .twitter:hover {
    color: #00ACED;
}
.social-nav .facebook {
    background: #3B579D;
    text-shadow: 0px 0px #2d4278, 1px 1px #2d4278, 2px 2px #2d4278, 3px 3px #2d4278, 4px 4px #2d4278, 5px 5px #2d4278, 6px 6px #2d4278, 7px 7px #2d4278, 8px 8px #2d4278, 9px 9px #2d4278, 10px 10px #2d4278, 11px 11px #2d4278, 12px 12px #2d4278, 13px 13px #2d4278, 14px 14px #2d4278, 15px 15px #2d4278, 16px 16px #2d4278, 17px 17px #2d4278, 18px 18px #2d4278, 19px 19px #2d4278, 20px 20px #2d4278, 21px 21px #2d4278, 22px 22px #2d4278, 23px 23px #2d4278, 24px 24px #2d4278, 25px 25px #2d4278, 26px 26px #2d4278, 27px 27px #2d4278, 28px 28px #2d4278, 29px 29px #2d4278, 30px 30px #2d4278;
}
.social-nav .facebook:hover {
    color: #3B579D;
}
.social-nav .google {
    background: #DD4A3A;
    text-shadow: 0px 0px #c23122, 1px 1px #c23122, 2px 2px #c23122, 3px 3px #c23122, 4px 4px #c23122, 5px 5px #c23122, 6px 6px #c23122, 7px 7px #c23122, 8px 8px #c23122, 9px 9px #c23122, 10px 10px #c23122, 11px 11px #c23122, 12px 12px #c23122, 13px 13px #c23122, 14px 14px #c23122, 15px 15px #c23122, 16px 16px #c23122, 17px 17px #c23122, 18px 18px #c23122, 19px 19px #c23122, 20px 20px #c23122, 21px 21px #c23122, 22px 22px #c23122, 23px 23px #c23122, 24px 24px #c23122, 25px 25px #c23122, 26px 26px #c23122, 27px 27px #c23122, 28px 28px #c23122, 29px 29px #c23122, 30px 30px #c23122;
}
.social-nav .google:hover {
    color: #DD4A3A;
}
.social-nav .linkedin {
    background: #007BB6;
    text-shadow: 0px 0px #005983, 1px 1px #005983, 2px 2px #005983, 3px 3px #005983, 4px 4px #005983, 5px 5px #005983, 6px 6px #005983, 7px 7px #005983, 8px 8px #005983, 9px 9px #005983, 10px 10px #005983, 11px 11px #005983, 12px 12px #005983, 13px 13px #005983, 14px 14px #005983, 15px 15px #005983, 16px 16px #005983, 17px 17px #005983, 18px 18px #005983, 19px 19px #005983, 20px 20px #005983, 21px 21px #005983, 22px 22px #005983, 23px 23px #005983, 24px 24px #005983, 25px 25px #005983, 26px 26px #005983, 27px 27px #005983, 28px 28px #005983, 29px 29px #005983, 30px 30px #005983;
}
.social-nav .linkedin:hover {
    color: #007BB6;
}
.social-nav .pinterest {
    background: #CB2026;
    text-shadow: 0px 0px #9f191e, 1px 1px #9f191e, 2px 2px #9f191e, 3px 3px #9f191e, 4px 4px #9f191e, 5px 5px #9f191e, 6px 6px #9f191e, 7px 7px #9f191e, 8px 8px #9f191e, 9px 9px #9f191e, 10px 10px #9f191e, 11px 11px #9f191e, 12px 12px #9f191e, 13px 13px #9f191e, 14px 14px #9f191e, 15px 15px #9f191e, 16px 16px #9f191e, 17px 17px #9f191e, 18px 18px #9f191e, 19px 19px #9f191e, 20px 20px #9f191e, 21px 21px #9f191e, 22px 22px #9f191e, 23px 23px #9f191e, 24px 24px #9f191e, 25px 25px #9f191e, 26px 26px #9f191e, 27px 27px #9f191e, 28px 28px #9f191e, 29px 29px #9f191e, 30px 30px #9f191e;
}
.social-nav .pinterest:hover {
    color: #CB2026;
}

        </style>
   <?php
function DateThai($strDate)
{
$strYear = date("Y",strtotime($strDate))+543;
$strMonth= date("n",strtotime($strDate));
$strDay= date("j",strtotime($strDate));
$strHour= date("H",strtotime($strDate));
$strMinute= date("i",strtotime($strDate));
$strSeconds= date("s",strtotime($strDate));
$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
$strMonthThai=$strMonthCut[$strMonth];
return "$strDay $strMonthThai $strYear";
}
?>
        <div class="col-md-12">
            <h3 class="widget-title" style="    margin-bottom: 0px;"><?php echo $article["Title_a"] ?></h3>
                     
        </div>

        <dir class="col-md-9" style="margin-top: 1px;">

            <div class="" style="padding-left: 35px; padding-right: 20px;">
                <br>
                <small ><i class="fa fa-clock-o"></i> <?php echo DateThai($article['Publish_Date']); ?>, <i class="fa fa-folder-o"></i> ข่าวสาร, <i class="fa fa-user"></i> <?php echo $article["view"] ?></small>
                <br>
                <img class="img-responsive" src="<?php echo base_url('/assets/admin/blog/'.$article['Thumbnail_Url']); ?>"  style="padding: 15px 0px 20px 0px">
               
                <?php echo $article["Content"] ?>

                          </div>
                          <hr>
            <!---->
         <div  style="margin-top: 1px;">
        <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like"     data-href="<?php echo $sharelink;?>" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
<div class="fb-share-button" data-href="<?php echo $sharelink;?>" 
data-layout="button_count" data-size="small" data-mobile-iframe="true">
<a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($sharelink);?>">แชร์</a></div>
<div class="fb-comments" data-href="<?php echo $sharelink;?>" data-numposts="5"></div>
        </div>
<!---->
        </dir>
        
        
        

        <div class="col-md-3">

    


            <div class="widget" style="background-color: #f5f5f5;">
              <div class="widget-title">
                <ul class="tabs" style="margin-bottom: 0px;     margin-top: -5px;">
                  <li class="tab"><a href="#" class="current">Most Viewed</a></li>
                  </ul>
                </div>


<style>
          .widget {


              -webkit-box-shadow: 0 0 5px 0 #e2e3e4;
              -moz-box-shadow: 0 0 5px 0 #e2e3e4;
              box-shadow: 0 0 5px 0 #e2e3e4;
              position: relative;
              margin-bottom: 30px;
              padding: 15px 12px 12px;
          }
          .widget-title {
              padding-bottom: 0px;
                  color: #2f3c4e;
          }
          .widget-title {
              font-size: 16px;
              font-weight: bold;
              padding-bottom: 10px;
              border-bottom: 2px solid #ecedee;
              margin-bottom: 20px;
              line-height: 28px;
              position: relative;
          }
          .tabs li {
    float: left;
    margin: 0 20px 10px 0;
    padding-bottom: 0;
    border-bottom: 0;
  }
  .widget li {
    display: block;
    list-style: none;
    color: #4b525c;
    border-bottom: 1px solid #ecedee;
    padding-bottom: 10px;
    margin-bottom: 10px;
    overflow: hidden;
    width: 100%;
  }
  .tabs li a {
    display: block;
    color: #000;
    text-decoration: none;
    background-color: #f5f5f5;
    padding: 0 10px;
    font-size: 20px;
  }
  .widget-posts-img, .widget-comments-img {
    float: left;
    position: relative;
    margin-right: 10px;
    overflow: hidden;
    text-align: center;
    height: 60px;
    width: 75px;
  }
  .widget-posts-content, .widget-comments-content {
    overflow: hidden;
    height: 100%;
    font-size: 13px;
  }
  .widget .widget-posts-content>a {
    line-height: 0.5em;
    color: #2f3c4e;
    text-decoration: none;
  }
  .widget .widget-posts-content>a:hover {
    line-height: 0.5em;
    color: #337ab7;
    text-decoration: none;
  }
  .widget-posts-content span {
    display: block;
    margin-bottom: 1px;
    font-size: 12px;
    text-transform: uppercase;
    color: #9ba1a8;
  }
  @media (min-width: 992px)
{
    .sidebar-tabing img {
                width: 260px;
                max-width: 260px;
                height: 190px;
            }

}

          </style>


                <div class="widget-posts">
                  <ul>
<?php if(count($rs_view) != 0){ ?>
                    <?php foreach($rs_view as $row) { ?>
                    
                                        <li class="">
                    <div class="widget-posts-img">
                    <a href="<?php echo base_url('publicRelations/content/' . $row['id']); ?>">

                    <img src="<?php echo base_url('assets/admin/blog/'.$row['Thumbnail_Url']) ?>" class="img-responsive" style="height:65px; width:75px; overflow: hidden;">
                    </a>
                    </div>
                    <div class="widget-posts-content">
                    <a href="<?php echo base_url('publicRelations/content/' . $row['id']); ?>"><?php echo $row["Title_a"]  ?></a>
                    <span><i class="fa fa-clock-o"></i> <?php echo date("d-m-Y", strtotime($row['Publish_Date'])); ?></span>
                    </div>
                    </li>


                     <?php } ?> 
                <?php } ?>
                                                   
                    </ul>
                    </div>
            </div>

           
            <div style="margin-bottom: 50px;">
                <h4>Social share</h4>

    <ul class="social-nav">
        <li><a href="https://twitter.com/share?url=<?php echo urlencode($sharelink);?>"  target="_blank" title="Twitter" rel="nofollow" class="twitter"><i class="fa fa-twitter"></i></a></li>
        <li><a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode($sharelink);?>"  target="_blank" title="Facebook" rel="nofollow" class="facebook"><i class="fa fa-facebook"></i></a></li>
        <li><a href="https://plus.google.com/share?url=<?php echo urlencode($sharelink);?>" target="_blank" title="Google plus" rel="nofollow" class="google"><i class="fa fa-google-plus"></i></a></li>
        <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode($sharelink);?>" target="_blank" title="Linkedin" rel="nofollow" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
              
    </ul>
</div>
<br>
<style type="text/css">
    
    .line-tag {
    border-top: 1px solid #dcdcdc;
    padding: 0.5rem 0rem 2rem 0rem;
}
ul li {
    list-style: none;
}
.tag-3 a {
    color: #6d6d6d;
    font-family: "dbozonex-medium";
    float: left;
    padding: 0.3rem 0.9rem;
    background-color: #e6e6e6;
    margin: 0.5rem;
    border-radius: 1rem;
}
</style>
<br>
            <div>
                <h4>Tag cloud</h4>
              

               

                <ul class="line-tag" id="tag">
                    <?php
            $cats = explode(",", $article["tag"]);
            foreach($cats as $cat) {
                $cat = trim($cat);
                ?>
                <li class="tag-3 "><a href=""><?php echo $cat;?></a></li>
            <?php    
            }
            ?>
                </ul>
            </div>
            

        </div>

   
</div>
</div>

