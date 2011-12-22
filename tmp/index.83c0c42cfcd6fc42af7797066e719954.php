<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE HTML> 
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>sachleen</title>
<link rel="stylesheet" href="http://localhost/blog/public_html/blog/template/css/style.css" type="text/css" media="screen, print" />
<script src="http://localhost/blog/public_html/blog/template/js/jquery.min.js"></script>
<script src="http://localhost/blog/public_html/blog/template/js/main.js"></script>
<script>
$(function() {
    gallery($(".gallery img"));
});
</script>

</head>
<body>

<div id="container">
	<div id="content">
        <?php $counter1=-1; if( isset($posts) && is_array($posts) && sizeof($posts) ) foreach( $posts as $key1 => $value1 ){ $counter1++; ?>
        <div class="post">
            <h1><a href="http://localhost/blog/public_html/blog/<?php echo $value1["slug"];?>.html" rel="bookmark" title="<?php echo $value1["title"];?>"><strong><?php echo $value1["title"];?></strong></a></h1>
            <div class="entry">
                <?php echo $value1["content"];?>
            </div>
            <div class="postInfo">
                <?php echo $value1["date"];?>
            </div>
        </div>
        <?php } ?>
        
        <div id="archive">
        <?php $counter1=-1; if( isset($archive) && is_array($archive) && sizeof($archive) ) foreach( $archive as $key1 => $value1 ){ $counter1++; ?>
            <h1><a href="http://localhost/blog/public_html/blog/<?php echo $value1["slug"];?>.html" rel="bookmark" title="<?php echo $value1["title"];?>"><strong><?php echo $value1["title"];?></strong></a> <span class="date"><?php echo $value1["date"];?></span></h1>
        <?php } ?>
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