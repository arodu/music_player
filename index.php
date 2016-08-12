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
  <link href="bower_components/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
  <link href="bower_components/ion.rangeSlider/css/ion.rangeSlider.skinHTML5.css" rel="stylesheet" type="text/css" />

  <link href="bin/style.css" rel="stylesheet" type="text/css" />

  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
</head>
<body>

  <div class="container">
    <div class="music">
  	 <?php include('bin/music.php') ?>
    </div>

  <nav class="player navbar navbar-default navbar-fixed-bottom">
    <?php include('bin/player.php') ?>
  </nav>

</div>

<style media="screen">
  .dropdown-menu {
    min-width: 0;
  }
</style>


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


});


</script>


</body>
</html>
