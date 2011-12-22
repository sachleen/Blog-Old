<?php
    // Maximum full-length posts to show on home page
    $posts_on_home = 3;
    
    /* End Configuration */
    
    include_once "lib/markdown.php";
    include_once "lib/rain.tpl.class.php";
    include_once "lib/functions.php";
    
    $publish_dir = '../public_html/blog/';
    
    raintpl::configure("base_url", 'http://localhost/blog/public_html/blog/' );
	raintpl::configure("tpl_dir", "template/" );
	raintpl::configure("cache_dir", "tmp/" );
    $tpl = new RainTPL;
    
    echo "\n";
    
    // Make HTML for each posts
    $posts = array();
    foreach(glob('posts/*.txt') as $file) {
        $fh = fopen($file, 'r');
        $theData = fread($fh, filesize($file));
        fclose($fh);
        
        $parts = explode("\n", $theData, 4);
        $post = array();
        $post['title'] = $parts[0];
        $post['slug'] = create_slug($parts[0]);
        $post['date_raw'] = $parts[1];
        $post['date'] = date('M j, Y', strtotime($parts[1]));
        $post['tags'] = explode(',', $parts[2]);
        $post['content'] = Markdown($parts[3]);
        $posts[] = $post;
        
        $tpl->assign("post", $post);
        $html = $tpl->draw('singlePost', $return_string=true);
        
        $publishFile = $publish_dir . $post['slug'] . ".html";
        $fh = fopen($publishFile, 'w') or die("can't open file");
        fwrite($fh, $html);
        fclose($fh);
        
        printf("Published: %s\n", $post['title']);
    }
    
    // Sort posts by date
    usort($posts, "sortPosts");
    function sortPosts($a,$b) {
        return strtotime($a['date_raw']) < strtotime($b['date_raw']);
    }
    
    // Publish Index
    
    if(!isset($_GET['noindex'])) {
        $tpl->assign("posts", array_slice($posts, 0, $posts_on_home));
        $tpl->assign("archive", array_slice($posts, $posts_on_home, count($posts)));
        $html = $tpl->draw('index', $return_string=true);
        $publishFile = $publish_dir . "/index.html";
        $fh = fopen($publishFile, 'w') or die("can't open file");
        fwrite($fh, $html);
        fclose($fh);
        echo "Published: index\n";
    }
    
    echo "\n";
    // Copy the content directory
    copy_directory('posts/content', $publish_dir . 'content');
    echo "Copied content directory\n";
    // Copy the template directory
    copy_directory('template', $publish_dir . 'template');
    echo "Copied template directory\n";
    echo "Done!\n\n";
?>