<?php
    /* Configuration */
    $posts_on_home = 3; // Maximum full-length posts to show on home page
    $publish_dir = '../../public_html/blog/';
    /* End Configuration */
    
    include_once "lib/markdown.php";
    include_once "lib/functions.php";
    
    echo "\n";
    
    /*
     * Iterates over all text files in the posts/ directory and generates
     * the HTML output for each post.
     */
    $postData = array();
    foreach(glob('posts/*.txt') as $file) {
        $post = parse_file($file);
        /*
         * Store the post data (except for the actual post) in an array
         * for ease of access when building the index.
         */
        if($post['index'] == 'true') {
            $postData[] = array(
                'file' => $file,
                'title' => $post['title'],
                'date' => $post['date'],
                'date_formatted' => date('M j, Y', strtotime($post['date'])),
                'tags' => $post['tags'],
                'slug' => $post['slug']
            );
        }
        
        /*
         * Generate template for this post
         */
        ob_start();
        include('template/' . $post['template'] . '.html');
        $html = ob_get_contents();
        ob_end_clean();
        
        /*
         * Create a file in the publish directory for this post
         * If a file exists already, it will be overwritten.
         */
        $publishFile = $publish_dir . $post['slug'] . ".html";
        $fh = fopen($publishFile, 'w') or die("can't open file");
        fwrite($fh, $html);
        fclose($fh);
        
        printf("Published: %s\n", $post['title']);
    }
    
    /*
     * Sorts the posts array by post date.
     * Most recent post first.
     */
    usort($postData, "sortPosts");
    function sortPosts($a,$b) {
        return strtotime($a['date']) < strtotime($b['date']);
    }
    
    /*
     * Publish the blog index
     *
     * If the GET paramater 'noindex' is specified, this step is skipped.
     * Although this script is meant to be run from the command line, I went
     * with the GET paramater instead of argv to allow it to be run from a 
     * web browser as well.
     */
    if(!isset($_GET['noindex'])) {
        /*
         * Split up the posts array into parts for the full-length posts
         * and the archive. For the full-length posts, we have to get the
         * post content from the original file.
         */
        $posts = array_slice($postData, 0, $posts_on_home);
        $index_posts = array();
        foreach($posts as $post) {
            $index_posts[] = parse_file($post['file']);
        }
        
        /*
         * The data for the other posts is already in the $postData array so no
         * processing goes on here.
         */
        $archive = array_slice($postData, $posts_on_home, count($postData));
        
        ob_start();
        include('template/index.html');
        $html = ob_get_contents();
        ob_end_clean();
        
        $publishFile = $publish_dir . "/index.html";
        $fh = fopen($publishFile, 'w') or die("can't open file");
        fwrite($fh, $html);
        fclose($fh);
        echo "Published: index\n";
    }
    
    echo "\n";
    /*
     * Copies the posts/content directory to the publish directory.
     * Content is duplicated but since these files are not in the public_html,
     * there really isn't any other option.
     */
    copy_directory('posts/content', $publish_dir . 'content');
    echo "Copied content directory\n";
    
    /*
     * Copy the template directory
     */
    copy_directory('template', $publish_dir . 'template');
    echo "Copied template directory\n";
    
    echo "Done!\n\n";
?>