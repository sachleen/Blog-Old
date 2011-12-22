<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE HTML> 
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>sachleen</title>
<link rel="stylesheet" href="http://localhost/public_html/blog/template/css/style.css" type="text/css" media="screen, print" />
</head>
<body>

<div id="container">
	<div id="content">
        <?php $counter1=-1; if( isset($posts) && is_array($posts) && sizeof($posts) ) foreach( $posts as $key1 => $value1 ){ $counter1++; ?>
        <div class="post">
            <h1><a href="http://localhost/public_html/blog/publish/<?php echo $value1["slug"];?>.html" rel="bookmark" title="<?php echo $value1["title"];?>"><strong><?php echo $value1["title"];?></strong></a></h1>
            <div class="entry">
                <?php echo $value1["content"];?>
            </div>
            <div class="postInfo">
                <?php echo $value1["date"];?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

</body>
</html>