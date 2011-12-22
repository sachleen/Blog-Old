<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE HTML> 
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>sachleen</title>
<link rel="stylesheet" href="/blog/template/css/style.css" type="text/css" media="screen, print" />
</head>
<body>

<div id="container">
	<div id="content">
        <div class="post">
            <h1><a href="/blog/publish/index.html"><img src="/blog/template/images/back.gif" alt="back" /></a> <strong><?php echo $post["title"];?></strong></h1>
            <div class="entry">
                <?php echo $post["content"];?>
            </div>
            <div class="postInfo">
                <?php echo $post["date"];?>
            </div>
        </div>
    </div>
</div>

</body>
</html>