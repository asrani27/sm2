<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script>
function PlayMusic() {

  var play=document.getElementById("music");
  play.play();
}

$(document).ready(function(){
  setTimeout(PlayMusic,3000);
})

</script>
</head>
<body>

<audio controls id="music" >

  <source src="https://www.computerhope.com/jargon/m/example.mp3" type="audio/mpeg">
</audio>

</body>
</html>