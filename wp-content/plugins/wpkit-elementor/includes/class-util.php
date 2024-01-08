<?php
/** 
 * Common Functions Set
 * @package WPKit For Elementor
 */

if( ! class_exists( 'WKE_Util' ) ) {

    class WKE_Util {

        /* Generate a random string. */
        public static function random_string( $length, $max = FALSE ){
            if( is_int( $max ) && $max > $length ) {
                $length = mt_rand( $length, $max );
            }

            $output = '';
            
            for( $i = 0; $i < $length; $i++ ) {
                $which = mt_rand( 0, 2 );

                if( $which === 0 ) {
                    $output .= mt_rand( 0, 9 );
                }elseif ( $which === 1 ){
                    $output .= chr( mt_rand( 65,90 ) );
                }else{
                    $output .= chr( mt_rand( 97, 122 ) );
                }  
            }   

            return $output;
        }

        public static function strFilter( $str ) {
            $str = str_replace( '`', '', $str );
            $str = str_replace( '・', '', $str );
            $str = str_replace( ' ', '', $str );
            $str = str_replace( '~', '', $str );
            $str = str_replace( '!', '', $str );
            $str = str_replace( '！', '', $str );
            $str = str_replace( '@', '', $str );
            $str = str_replace( '#', '', $str );
            $str = str_replace( '$', '', $str );
            $str = str_replace( '￥', '', $str );
            $str = str_replace( '%', '', $str );
            $str = str_replace( '^', '', $str );
            $str = str_replace( '……', '', $str );
            $str = str_replace( '&', '', $str );
            $str = str_replace( '*', '', $str );
            $str = str_replace( '(', '', $str );
            $str = str_replace( ')', '', $str );
            $str = str_replace( '（', '', $str );
            $str = str_replace( '）', '', $str );
            $str = str_replace( '-', '', $str );
            $str = str_replace( '_', '', $str );
            $str = str_replace( '――', '', $str );
            $str = str_replace( '+', '', $str );
            $str = str_replace( '=', '', $str );
            $str = str_replace( '|', '', $str );
            $str = str_replace( '\\', '', $str );
            $str = str_replace( '[', '', $str );
            $str = str_replace( ']', '', $str );
            $str = str_replace( '【', '', $str );
            $str = str_replace( '】', '', $str );
            $str = str_replace( '{', '', $str );
            $str = str_replace( '}', '', $str );
            $str = str_replace( ';', '', $str );
            $str = str_replace( '；', '', $str );
            $str = str_replace( ':', '', $str );
            $str = str_replace( '：', '', $str );
            $str = str_replace( '\'', '', $str );
            $str = str_replace( '"', '', $str );
            $str = str_replace( '“', '', $str );
            $str = str_replace( '”', '', $str );
            $str = str_replace( ',', '', $str );
            $str = str_replace( '，', '', $str );
            $str = str_replace( '<', '', $str );
            $str = str_replace( '>', '', $str );
            $str = str_replace( '《', '', $str );
            $str = str_replace( '》', '', $str );
            $str = str_replace( '.', '', $str );
            $str = str_replace( '。', '', $str );
            $str = str_replace( '/', '', $str );
            $str = str_replace( '、', '', $str );
            $str = str_replace( '?', '', $str );
            $str = str_replace( '？', '', $str );

            return trim( $str );
        }

        /* Get category slug
         * Parameter:
         * $cate_name: Category name
        */
        public static function category_slug( $cate_name ) {
          $cat_ID = get_cat_ID( $cate_name ); 
          $thisCat = get_category( $cat_ID );
          $cat_slug = '';

          if( is_array( $thisCat ) && count( $thisCat ) > 1 ) {
            $cat_slug = $thisCat->slug;
          }
          
          return $cat_slug;
        }


        /* Truncate the long string
         * Parameter:
         * $full_start: The string you want to truncate.
         * $max_length: The max length of output. 
         */
        public static function truncate_string( $full_str, $max_length ) {
          if ( mb_strlen( $full_str,'utf-8' ) > $max_length ) {
            $full_str = mb_substr( $full_str, 0, $max_length, 'utf-8' ) . '...';
          }

          $full_str = apply_filters( 'wke_truncate', $full_str );
          
          return $full_str;
        }

        /* Convert the HEX to RGB color */
        public static function hex2rgb( $hex) {
            $hex = str_replace( "#", "", $hex );
            
            if( strlen( $hex ) == 3 ) {
                $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
                $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
                $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
            } else {
                $r = hexdec( substr( $hex, 0, 2 ) );
                $g = hexdec( substr( $hex, 2, 2) );
                $b = hexdec( substr( $hex, 4, 2) );
            }
            $rgb = array( $r, $g, $b );
            return $rgb; 
        }

        /* creates a compressed zip file */
        public static function create_zip( $files = array(), $destination = '', $overwrite = false ) {
          //if the zip file already exists and overwrite is false, return false
          if( file_exists( $destination ) && !$overwrite ) { return false; }
          //vars
          $valid_files = array();
          //if files were passed in...
          if( is_array( $files ) ) {
            //cycle through each file
            foreach( $files as $file ) {
              //make sure the file exists
              if( file_exists( $file ) ) {
                $valid_files[] = $file;
              }
            }
          }

          //if we have good files...
          if( count( $valid_files ) ) {
            //create the archive
            $zip = new ZipArchive();
            if( $zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE ) !== true ) {
              return false;
            }
            //add the files
            foreach( $valid_files as $file ) {
              $zip->addFile($file,$file);
            }
            //debug
            //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
            
            //close the zip -- done!
            $zip->close();
            
            //check to make sure the file exists
            return file_exists( $destination );
          }
          else
          {
            return false;
          }
        }

        /**
         * Downloader
         * @return file stream
         */
        public static function download_file( $archivo, $downloadfilename = null ) {
            if ( file_exists( $archivo ) ) {
                $downloadfilename = $downloadfilename !== null ? $downloadfilename : basename( $archivo );
                header( 'Content-Description: File Transfer' );
                header( 'Content-Type: application/octet-stream' );
                header( 'Content-Disposition: attachment; filename=' . $downloadfilename );
                header( 'Content-Transfer-Encoding: binary' );
                header( 'Expires: 0' );
                header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
                header( 'Pragma: public' );
                header( 'Content-Length: ' . filesize( $archivo ) );
                readfile( $archivo);
                exit;
            }
        }

       /**
        * Write file
        * @return file content 
        */
      public static function write_file( $url, $content, $path, $filename ) {
          
          $file = $path.$filename;

          if ( empty( $wp_filesystem ) ) {
              require_once ( ABSPATH.'/wp-admin/includes/file.php' );
          }
         
          WP_Filesystem();

          global $wp_filesystem;
          
          $url = wp_nonce_url( $url, '' );
          if ( false === ( $creds = request_filesystem_credentials( $url, '', false, false, null ) ) ) {
              return; 
          }
          //check if credentials are correct or not.
          if( ! WP_Filesystem( $creds ) ) {
              request_filesystem_credentials( $url, $method, true, $context );
              return false;
          }

          if ( !$wp_filesystem->put_contents( $file, $content, FS_CHMOD_FILE ) ){
             return false;
          }
          return $content;
      }

      /**
       * Read file
       * @return file content
       */
      public static function read_file( $path, $filename ) {
          global $wp_filesystem;

          if( empty( $wp_filesystem ) ) {
              require_once ( ABSPATH . '/wp-admin/includes/file.php' );
              WP_Filesystem();
          }

        // Define the path to file
         $file = trailingslashit( $wp_filesystem->wp_plugins_dir() . 'wpkit-elementor' ) . $path . $filename;

         if( ! $file ) {
              // File doesn't exist, output error
              die( 'file not found' );
         }
         else{
             return $wp_filesystem->get_contents( $file );
         }
      }

      /**
       * Bulk Merge files
       * @return null
       */
      public static function merge_files( $path, $destination_dir, $dest_file_name ) {
          $files = array_diff( scandir( $path ), array(
            '.', '..', '.DS_Store','.jpg','.git','.json','Thumbs.db','gif','jpeg','.png','.bmp','.svg','.mp3','.mp4'
          ) );
          $content = "";
          foreach( $files as $file ){ //loop through array list
              $content .= file_get_contents( $path . $file ) . PHP_EOL . PHP_EOL;
          }
          $new_file = fopen( $destination_dir . $dest_file_name, "w" ); //open file for writing
          fwrite( $new_file , $content ); //write to destination
          fclose( $new_file ); 
      }

  }
}