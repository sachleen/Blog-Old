<?php
/**
 * Parses the contents of a post file.
 *
 * @param string file The file to parse
 * @return array Returns an array with the parts of the post:
 *               title
 *               slug
 *               date_raw (the date as it was written in the post)
 *               date (the date converted into mmm dd, yyyy format)
 *               tags (an array of tags specified in the post)
 *               content (post body converted from Markdown to HTML)
 */
function parse_file($file) {
    $fh = fopen($file, 'r');
    $data = fread($fh, filesize($file));
    fclose($fh);
    
    /* 
     * Split the file into 4 parts:
     * Title, Date, Tags, and Post content
     * 
     * Each piece of inormation starts on a new line in that order.
     */
    $parts = explode("\n", $data, 4);
    $post = array();
    $post['title'] = $parts[0];
    $post['slug'] = create_slug($parts[0]);
    $post['date_raw'] = $parts[1];
    $post['date'] = date('M j, Y', strtotime($parts[1]));
    $post['tags'] = explode(',', $parts[2]);
    $post['content'] = Markdown($parts[3]);
    
    return $post;
}

/**
 * Creates URL slug from post title
 *
 * @param string post title to create slug of
 * @return string returns a slug with all non alphanumeric characters
 *                replaced with a dash.
 */
function create_slug($string) {
    return preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($string));
}

/**
 * Copies the contents of a directory
 * From: http://codestips.com/php-copy-directory-from-source-to-destination/
 *
 * @param string source The source directory to copy
 * @param string destination The destination directory
 */
function copy_directory($source, $destination) {
    if (is_dir($source)) {
        @mkdir($destination);
        $directory = dir($source);
        while (FALSE !== ($readdirectory = $directory->read())) {
            if ($readdirectory == '.' || $readdirectory == '..') {
                continue;
            }
            $PathDir = $source . '/' . $readdirectory; 
            if (is_dir($PathDir)) {
                copy_directory($PathDir, $destination . '/' . $readdirectory);
                continue;
            }
            copy($PathDir, $destination . '/' . $readdirectory);
        }
 
        $directory->close();
    } else {
        copy($source, $destination);
    }
}
?>