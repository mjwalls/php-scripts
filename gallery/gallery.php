<?php

    // ---- super-simple php image gallery ----

    // A stupidly simple php image gallery.

    // ---- setup ----

    // create two directories: one for the master images, one for thumbnails.
    // put the directory names into the configuration section of this script.
    // System recognises png, jpg, and jpeg file extensions.

    // the thumbnails are assumed to have the same name as the master image.

     // ---- configuration ----

    $thumbsdirectory = 'wowconcept/thumbs/'; // thumbnail images
    $directory       = 'wowconcept/';        // full images

?>

<html>

    </head>

        <title>Gallery</title>

        <style>

            html {

                background-color: rgb(230, 230, 230);

                font-family: "HelveticaNeue",Helvetica,Arial,sans-serif;
                color:       #393939;
                font-weight: 400;
                line-height: 18.2px;
                margin:      0px;
                padding:     0px;

            }

            body {
              
                margin:  0px;
                padding: 0px;

            }

            img{
                
                display: inline;
                width:   64px;
                height:  64px;
                margin:  0px;

            }

            h1{

                border-bottom:  1px solid #CCCCCC;
                padding-top:    20px;
                padding-bottom: 20px;
                color:          #393939;
                font-weight:    700;
                font-size:      20px;

            }

            h2{

                color:          #393939;
                padding-top:    20px;
                padding-bottom: 20px;
                font-weight:    700;
                font-size:      18px;

            }

            #content{
  
                float:         left;
                padding:       20px;
                margin-top:    60px;
                margin-left:   70px;
                margin-bottom: 20px;
                min-height:    600px;
                width:         80%;
                border:        1px solid #CACACA;

                background-color: rgb(256, 256, 256);
                border-radius:    3px 3px 3px 3px;

            }

            .highlight{

                float:  left;
                border: 1px solid #CACACA;
                margin: 10px;
                height: 59px;

                padding-bottom:   5px;
                background-color: #FAFAFB;
                border-radius:    3px 3px 3px 3px;

            }

        </style>

    </head>

    <body>

        <div id="content">

        <h1>Gallery</h1>

            <?php

                // open the thumbnail directory

                if ($handle = opendir($thumbsdirectory)) {

                    // scan directory for files

                    while (($entry = readdir($handle)) !== false) {

                        // if it is a file

                        if(strpos ($entry , "png")  !== FALSE || 
                           strpos ($entry , "jpg")  !== FALSE ||
                           strpos ($entry , "jpeg") !== FALSE){

                               // then generate the relevant html code.
                            
                            echo "<span class='highlight'>\n";
                            echo "<a href=\"" . $directory . $entry . "\">";
                            echo "<img src='" . $thumbsdirectory . $entry . "'>\n";
                            echo "</a>";
                            echo "</span>\n";

                        }

                    }

                    closedir($handle);
                }

            ?>

        </div>

    </body>

</html>
