<?php
  //session_start();
  //$_SESSION["tracks"] = "tracks/";
  setcookie("tracks","tracks/");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title class="play-song">Music Player</title>
  <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="bower_components/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css" rel="stylesheet" type="text/css" />
  <link href="bin/style.css" rel="stylesheet" type="text/css" />

  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="bower_components/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>
</head>
<body>

  <div class="container">
    <div class="music">
  	 <?php include('bin/music.php') ?>
    </div>

 <nav class="navbar navbar-inverse">
   <div class="container-fluid">
     <!-- Brand and toggle get grouped for better mobile display -->
     <div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </button>
     </div>

     <div>
       <ul class="nav navbar-nav">
         <li><a href="#"><span class="glyphicon glyphicon-pause"></span></a></li>
         <li><a href="#"><span class="glyphicon glyphicon-fast-backward"></span></a></li>
         <li><a href="#"><span class="glyphicon glyphicon-fast-forward"></span></a></li>
         <li><a href="#"><span class="glyphicon glyphicon-volume-up"></span></a></li>

       </ul>
    </div>

     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       <ul class="nav navbar-nav">
         <li><p class="navbar-text play-song"></p></li>
         <li><input type="text" class="slider" /></li>
       </ul>

       <ul class="nav navbar-nav navbar-right">
         <li class="player"><?php include('bin/player.php') ?></li>
         <li><p class="navbar-text current-time">00:00</p></li>
       </ul>
     </div><!-- /.navbar-collapse -->
   </div><!-- /.container-fluid -->
 </nav>

</div>


<script>
$(function(){
  $('.song').on('click', function(){

    $.ajax({
      method: "POST",
      url: "bin/player.php",
      data: { song: $(this).data('song') },
      success: function(msg){
        $('.player').html(msg);
      }
    });

    return false;
  });

  var mySlider = $("input.slider").slider('disable');


});


</script>



</body>
</html>
