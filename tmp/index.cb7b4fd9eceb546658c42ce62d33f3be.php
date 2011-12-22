<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE HTML> 
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>sachleen</title>
<link rel="stylesheet" href="http://localhost/blogtemplate/css/style.css" type="text/css" media="screen, print" />
<link rel="stylesheet" href="http://localhost/blogtemplate/css/alternate.css" type="text/css" media="screen, print" />
</head>
<body>

<div id="container">
	<div id="content">
        <div class="post" id="post-674">
            <h1><a href="http://localhost/blog#" rel="bookmark" title="title"><b>title</b></a></h1>
            <div class="entry">
                <?php $counter1=-1; if( isset($posts) && is_array($posts) && sizeof($posts) ) foreach( $posts as $key1 => $value1 ){ $counter1++; ?>
                    <?php echo $value1;?>
                <?php } ?>
            </div>
        </div>

    </div>
</div>

</body>
</html>