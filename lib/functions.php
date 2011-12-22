<?php
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

function copy_directory( $source, $destination ) {
    if ( is_dir( $source ) ) {
        @mkdir( $destination );
        $directory = dir( $source );
        while ( FALSE !== ( $readdirectory = $directory->read() ) ) {
            if ( $readdirectory == '.' || $readdirectory == '..' ) {
                continue;
            }
            $PathDir = $source . '/' . $readdirectory; 
            if ( is_dir( $PathDir ) ) {
                copy_directory( $PathDir, $destination . '/' . $readdirectory );
                continue;
            }
            copy( $PathDir, $destination . '/' . $readdirectory );
        }
 
        $directory->close();
    }else {
        copy( $source, $destination );
    }
}
?>