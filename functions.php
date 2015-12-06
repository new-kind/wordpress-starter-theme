<?php

    /** 
     **  This file is organized in 5 main components:
     ** 
     **  i.   Wordpress Resets
     **  ii.  Custom Post Types
     **  iii. Custom Taxonomies
     **  iv.  Theme Functions
     **  v.   Short Codes
     ** 
     **/

    /*****************************************************************************
    *** i.   Wordpress Resets 
    ******************************************************************************/

    ## Resource: http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters

    /*****************************************************************************
    *** ii.   Custom Post Types
    ******************************************************************************/
     
    ## Documentation: http://codex.wordpress.org/Post_Types
        
    /*****************************************************************************
    *** iii.  Custom Taxonomies
    ******************************************************************************/
     
    ## Documentation: http://codex.wordpress.org/Taxonomies
      
    /*****************************************************************************
    *** iv.  Theme Functions
    ******************************************************************************/

    ## FYI: http://codex.wordpress.org/Functions_File_Explained
     
    function show_rss_feed( $source = "", $cnt = 5 , $class = "" ){

        if (!empty($source)) {

            // content of feed 
            $feedContent = "";

            // create curl object and set options
            if (strlen($feedContent) < 1){
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL,$source);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);

                // load xml object from curl execution
                $feedContent = curl_exec($curl);
                curl_close($curl);
            } 

            if ($feedContent == false || strstr($feedContent,"<title>WordPress &rsaquo; Error</title>"))
                return false;
           
            // load curl content into simplexml
            $feedObj = simplexml_load_string($feedContent);

            if (count($feedObj->channel->item) < 1)
                return;
        
            if (empty($class))      
                echo "<ul>";
            else                    
                echo "<ul class=\"$class\">";
                 		    
            foreach ($feedObj->channel->item as $item) {
                if ($cnt-- > 0) {
                	echo "<li>";
                    echo "<a href=\"" . $item->link . "\">";
                    echo $item->title;
                    echo "</a>";
                    echo "<span>" . date("n/j/Y",strtotime($item->pubDate)) . "</span>";
                    echo "</li>";
                }
            }

            echo "</ul>";

        }

    }
     
    /*****************************************************************************s
    *** v.  Short Codes
    ******************************************************************************/

    ## Docuementation: http://codex.wordpress.org/Shortcode_API

?>