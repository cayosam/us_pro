<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang="ja"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HELP</title>

    <!-- <link rel="apple-touch-icon" href="apple-touch-icon.png"> -->
    <!--Google Font link-->
    
   
   
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/magnific-popup.css"> -->
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <!--For Plugins external css-->
    <!-- <link rel="stylesheet" href="assets/css/plugins.css" /> -->
    <!--Theme custom css -->
    <link rel="stylesheet" href="css/help_style.css">
    <!--Theme Responsive css-->
    <link rel="stylesheet" href="css/help_responsive.css" >
    <!-- <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script> -->
    <script type="text/javascript" src="js/footerFixed.js"></script>
        <!-- header -->
    <link rel="stylesheet" href="css/navi.css" />
    <link rel="stylesheet" href="css/hero.css" />


    <script>
         var map;
         function initMap() {
           map = new google.maps.Map(document.getElementById('map'), {
           center: {lat: -34.397, lng: 150.644},
           zoom: 8
         });
             }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL3qe_lcSnHCs7ENLJM9sMEHnxNABZb04&callback=initMap"
           async defer></script>


    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        /*height: 100%;*/
        height:300px;
        width: 300px;
        /*border-radius: 50%;*/
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
</head>
<body>
<!-- <body data-spy="scroll" data-target=".navbar" data-offset="200"> -->
<!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!--<div class='preloader'>
        <div class='loaded'>&nbsp;</div>
    </div> -->

<header>
   <a class="navbar-brand logo" href="index.php"></a>
    <div class=" topnav" id="myTopnav"> 
      <?php if (isset($_SESSION["id"])){ ?>
      <a href="logout.php">Logout</a>
      <a href="profile.php">MyPage</a>
      <a href="post.php">POST</a>
      <?php } ?>
      <a class="active" href="contact.php">Contact</a>
      <a href="json_map.php">*MAP*</a>
      <a href="javascript:void(0);" style="font-size:30px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
</header>


  <section id="choose" class="choose">
    <div class="container">
      <div class="row">
        <div class="main_choose sections">
          <div class="col-sm-6">
            <div class="head_title">
              <legend class="profile_title">HELP</legend>
              <!--<h3>HELP    </h3>-->
              <!--<div class="separator"></div>-->
            </div>
                <div class="single_choose">
                  <div class="single_choose_acording">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                      <div class="panel panel-default">

                      <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                      <i class="fa fa-bullseye"></i>WHAT IS  " WHERE IS * " ?
                      </a>
                      </h4>
                      </div>

                      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: auto;">
                      <div class="panel-body">
                      俺たちの遊び。<br>
                      ここってどんなところなんやろー？もしかしたらその疑問に答えてくれるかもしれないもの。
                      </div>
                      </div>
                      </div>

                      <div class="panel panel-default">

                      <div class="panel-heading" role="tab" id="headingTwo">
                      <h4 class="panel-title">
                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <i class="fa fa-bullseye"></i> How To Post
                      </a>
                      </h4>
                      </div>

                      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
                      <div class="panel-body">
                      ⑴まずここでログイン必要やから<br>
                      ⑵youtubeアカウントある？まずそっちにアップして。え？それがそもそもわからんって？これ見てガンバー&nbsp;&nbsp;<u><a href="https://support.google.com/youtube/answer/161805?co=GENIE.Platform%3DDesktop&hl=ja" style="display:inline">Youtube Help</a></u>
                      <br>
                      ⑶投稿画面のマップクリックして、撮影地の緯度経度を調べて入れて<br>
                      ⑷youtubeでアップしたい動画を右クリック（マックなら両指クリックの事な）んだら選択肢に「動画コード取得」があると思うから、それクリックな。んだらそれがコピーされるんや<br>
                      ⑸iframeの所に貼り付けて、GO や！
                      </div>
                      </div>
                      </div>


                      <div class="panel panel-default">

                      <div class="panel-heading" role="tab" id="headingThree">
                      <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      <i class="fa fa-bullseye"></i> HOW DO I REPORT ?
                      </a>
                      </h4>
                      </div>

                      <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false">
                      <div class="panel-body">
                      例えば、肖像権侵害と思われる動画を発見。通報と削除依頼をする場合は<u><a href="contact.php" style="display:inline">Contact Us</a></u> から申請をしてください。ただし、Youtubeから消えるわけではないのでご注意を。
                      </div>
                      </div>
                      </div>


                    </div>
                  </div>
                </div>
        </div>

        <div class="col-sm-4 col-sm-offset-1">
              <div id="map"></div>
        </div>
      </div>
    </div>
  </div>
  </section>

  <div id="footer" class="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-2"></div>
          <div class="col-sm-8 webscope">
            <span class="webscope-text"> The world view by </span>
            <a href=""> <img src="img/logo04.png"/> </a>
          </div>
        <div class="col-sm-2"></div>
      </div>
    </div>
  </div>




    <!-- START SCROLL TO TOP  -->
<!--<div class="scrollup">
        <a href="#"><i class="fa fa-chevron-up"></i></a>
    </div> -->




   
 

  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

   
    <!-- <script src="assets/js/jquery.magnific-popup.js"></script> -->
    <!-- <script src="assets/js/jquery.mixitup.min.js"></script> -->
    <!-- <script src="assets/js/jquery.easing.1.3.js"></script> -->
    <!-- <script src="assets/js/jquery.masonry.min.js"></script> -->

    <!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script> -->
    <!-- <script src="http://maps.google.com/maps/api/js"></script> -->
    <!-- <script src="assets/js/gmaps.min.js"></script> -->

<!-- 
        <script>

                                            function showmap() {
                                                var mapOptions = {
                                                    zoom: 8,
                                                    scrollwheel: false,
                                                    center: new google.maps.LatLng(-34.397, 150.644),
                                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                                };
                                                var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
                                            }
        </script>
 -->
        <!-- <script src="assets/js/plugins.js"></script> -->
        <!-- <script src="assets/js/main.js"></script> -->

 <script src="js/navi.js"> </script>
</body>
</html>
