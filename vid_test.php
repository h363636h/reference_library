   <html>
<head>
<script src='js/jquery-11.0.min.js' type='text/javascript'></script>
    <script src="js/jquery-1.10.2.js" type='text/javascript'></script>
    <script src="js/jquery-ui.js" type='text/javascript'></script>
    <script>
$(function() {
  var moveLeft = 20;
  var moveDown = 10;

  $('a.trigger').hover(function(e) {
  	var path = e.target.id;
  	var videoPlayer = document.getElementById("popup_vid");

  	videoPlayer.src = path;
  	videoPlayer.autoplay = true;
  	videoPlayer.loop = true;
  	videoPlayer.load();

    $('div#pop-up').show();

  }, function() {
    $('div#pop-up').hide();
  });

  $('a.trigger').mousemove(function(e) {
    $("div#pop-up").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
  });

});
</script>
<style>

/* HOVER STYLES */
div#pop-up {
  display: none;
  position: absolute;
  width: 280px;
  padding: 10px;
  background: #eeeeee;
  color: #000000;
  border: 1px solid #1a1a1a;
  font-size: 90%;
}
</style>
</head>
<body>

    <p>

            <a href="#" id="/reference/movie/west/[0_Series]아이언맨 Iron.Man/[2010]아이언맨2.IronMan2/아이언맨2 Iron.Man2.2010.BluRay.1080P.DTS.x264.AC3-HAYABUSA.mkv#t=4898.8333333333,5036.4583333333" class="trigger">this link</a>.
    </p>

    <p>

         <a href="#" id="/reference/movie/west/[0_Series]아이언맨 Iron.Man/[2010]아이언맨2.IronMan2/아이언맨2 Iron.Man2.2010.BluRay.1080P.DTS.x264.AC3-HAYABUSA.mkv#t=10,50" class="trigger">this link</a>.
    </p>

    <!-- HIDDEN / POP-UP DIV -->
    <div id="pop-up">
      <p>
        <video width='100%' id='popup_vid'></video>
      </p>
    </div>

    

</body>
</html>