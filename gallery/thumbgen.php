<?php

    // ---- configuation ----

    // $directory will be overridden if the php has an inDir parameter.
    // $thumbsDirectory will be overridden if the php has an outDir parameter.

    $directory       = "wowconcept/"         // where our source images are stored
    $thumbsdirectory = "wowconcept/thumbs/"  // where generated thumbnails will be saved

    // ---- functions ----


    // creates a thumbnail image.
    // paramters are: original filename, new filename, output width, output height

    function createthumb($name, $filename, $width, $height){

        $system = explode('.', $name);

        if (preg_match('/png/', $system[1])){
            $src_img = imagecreatefrompng($name);
        } else {
            $src_img = imagecreatefromjpeg($name);
        }

        $oldWidth  = imageSX($src_img);
        $oldHeight = imageSY($src_img);

        if ($oldWidth > $oldHeight) {
            $thumb_w = $width;
            $thumb_h = $old_y*($height/$old_x);
        }

        if ($oldWidth < $oldHeight) {
            $thumb_w=$old_x*($width/$old_y);
            $thumb_h=$height;
        }

        if ($old_x == $old_y) {
            $thumb_w = $width;
            $thumb_h = $height;
        }

        $dst_img = ImageCreateTrueColor($thumb_w,$thumb_h);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $width, $height, $oldWidth, $oldHeight); 

        if (preg_match("/png/", $system[1])){
            imagepng($dst_img, $filename); 
        } else {
            imagejpeg($dst_img, $filename); 
        }

        imagedestroy($dst_img);
        imagedestroy($src_img);

    }

    // given an input directory, and an output directory, it scans the input directory and
    // generates thumbnails for all images contained within, saving them to the output
    // directory

    function convertDirectoryToThumbs($inDir, $outDir){
        
        // open input directory
        if ($handle = opendir($inDir)) {

            // scan the input directory
            while (($entry = readdir($handle)) !== false) {

                // for each file...

                // what are the input and output files?
                $inFile  = $inDir  . $entry;
                $outFile = $outDir . $entry;

                try{

                    // if it's an image...

                    if(strpos ($entry , "png") !== FALSE || 
                       strpos ($entry , "jpg") !== FALSE ||
                       strpos ($entry , "jpeg") !== FALSE){

                           // create the file

                        createthumb($inFile, $outFile, 100, 100);

                        print "created " . $entry;

                    }

                } catch(Exception e){

                    // on exception, print a failure message but keep on processing.

                    print "failed to create thumbnail for: $inFile";

                }

            }

            closedir($handle);
        }


    }


?>

<?php

    // ---- main ----

    // handle overrides

    if(isset($_REQUEST["inDir"])){
        $directory = $_REQUEST["inDir"];
    }

    if(isset($_REQUEST["outDir"])){
        $directory = $_REQUEST["outDir"];
    }

    // process the directory

    convertDirectoryToThumbs($directory, $thumbsdirectory);


?>