<?php
/**
 * Parses the contents of a post file.
 *
 * @param string file The file to parse
 * @return array Returns an array with the parts of the post:
 *               title
 *               slug
 *               date (the date as it was written in the post)
 *               date_formatted (the date converted into mmm dd, yyyy format)
 *               tags (an array of tags specified in the post)
 *               content (post body converted from Markdown to HTML)
 */
function parse_file($file) {
    $lines = file($file);

    $post = array(
        'tags' => '',
        'template' => 'post',
        'index' => 'true'
    );
    $dataLines = 0;
    foreach($lines as $line) {
        if(strlen(trim($line)) == 0)
            break;
        
        $lineParts = explode(':', $line, 2);
        if(count($lineParts) == 2) {
            $post[trim(strtolower($lineParts[0]))] = trim($lineParts[1]);
            $dataLines++;
        }
    }
    
    $post['slug'] = create_slug($post['title']);
    $post['content'] = Markdown(implode(array_slice($lines, $dataLines)));
    
    
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