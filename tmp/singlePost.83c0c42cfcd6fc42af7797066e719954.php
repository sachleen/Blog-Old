<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE HTML> 
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $post["title"];?></title>
<link rel="stylesheet" href="http://localhost/blog/public_html/blog/template/css/style.css" type="text/css" media="screen, print" />
<script src="http://localhost/blog/public_html/blog/template/js/jquery.min.js"></script>
<script src="http://localhost/blog/public_html/blog/template/js/main.js"></script>
<script>
$(function() {
    gallery($(".gallery img"));
});
</script>

<div id="container">
	<div id="content">
        <div class="post">
            <h1><a href="http://localhost/blog/public_html/blog/index.html"><img src="http://localhost/blog/public_html/blog/template/images/back.gif" alt="back" /></a> <strong><?php echo $post["title"];?></strong></h1>
            <div class="entry">
                <?php echo $post["content"];?>
            </div>
            <div class="postInfo">
                <?php echo $post["date"];?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
var pageTracker = _gat._getTracker("UA-2893329-1");
pageTracker._trackPageview();
</script>

</body>
</html>