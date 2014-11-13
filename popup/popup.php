<?php



include "../../../../wp-load.php";



// this file contains the contents of the popup window



$source = "insert";

$title = "Insert Button";

$insert_text = "Insert";

if(isset($_GET['ver']))

{

    $fasc_plugin_ver = $_GET['ver'];

}

else

{

    $fasc_plugin_ver = "";

}





if(isset($_GET['source']))

{

    if($_GET['source']=="click")

    {

        $source = "click";

        $title = "Edit Button";

        $insert_text = "Update";

    }

}



?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>







    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="popup.css?ver=<?php echo $fasc_plugin_ver; ?>">

    <link rel="stylesheet" href="video.css"/>

</head>



<body>



<div id="button-dialog">



    <form action="/" method="get" accept-charset="utf-8">

        <div id="tab-header">

            <ul>

                <li class="active"><a href="#tab-1-content">Videos</a></li>

                <li><a href="#tab-2-content">Playlist Settings</a></li>

           </ul><div class="clear"></div>

        </div>



        <div id="tab-1-content" class="fasc-tab-content" style="max-height: 380px; overflow-y: auto;">

            <div class="inputrow main">

                <label for="button-url">Video URL</label>

                <div class="inputwrap">

                    <input type="submit" name="button-url" class="button button-primary button-large" value="Add Video" id="button-url" />

                    <input type="text" name="button-value" value="" id="button-value" style="width: 420px;" />

                </div>

                <div class="clear"></div>

            </div>



            <div class="inputrow">

                <div class="span12">

                    <div data-force="18" class="layer block">

                        <div class="layer title">Available Videos</div>

                        <ul id="items" class="block__list block__list_tags" style="margin-bottom: 0px; padding: 10px;">

                            <?php $videos = json_decode(get_option(PLP_VIDEOS), true);
                                $i = 1;
                                if ($videos) {
                                   foreach($videos as $video_id=>$video) {
                                        if (!empty($video)) {
                            ?>

                            <li data-id="<?php echo $video_id;?>" data-type="video" class="draggable ui-draggable ui-draggable-handle"><?php echo $video['name'];?></li>

                                <?php $i++;
                                    }
                                }
                            } ?>

                        </ul>

                    </div>



                    <div data-force="18" class="layer block">

                        <div class="layer title">Available Calls to action</div>

                        <ul id="items" class="block__list block__list_tags" style="margin-bottom: 0px; padding: 10px;">

                            <?php $ctas = json_decode(get_option(PLP_CALL_TO_ACTIONS), true);
                                foreach($ctas as $key=>$cta) {
                                    if (!empty($cta['name'])) {
                            ?>
                                <li data-id="<?php echo $key;?>" data-type="cta" class="draggable ui-draggable ui-draggable-handle"><?php echo stripslashes($cta['name']);?></li>
                            <?php }



                            } ?>

                        </ul>

                    </div>



                    <div data-force="18" class="layer block">

                        <div class="layer title">Current Playlist</div>

                        <ul id="m1" class="block__list block__list_tags droppable ui-droppable ui-sortable" style="margin-bottom: 0px; padding: 10px;">

                        </ul>

                    </div>



                    <div class="preview-button-area" style="height:30px; margin-top: 0px;">

                        <div class="scentered-button" style="color:grey">

                             Drop here to remove from playlist

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div id="tab-2-content" class="fasc-tab-content">

            <?php $default = get_option(PLP_DEFAULT);?>

            <h1><span> Settings</span></h1>



            <div class="inside">

                <form method="post">

                    <div class="form-field form-required">

                        <label for="tag-name">Width</label><br/>

                        <input type="text" style="width:50px" aria-required="true" id="width" value="<?php echo $default['width'];?>" name="width"> (px ur %)

                    </div>



                    <div class="form-field form-required">

                        <label for="tag-name">Theme</label><br/>

                        <select name="theme" id="theme" style="width:200px">

                            <option <?php  selected($default['theme'], "dark");?> value="dark">Dark</option>

                            <option <?php  selected($default['theme'], "light");?>  value="light">Light</option>

                        </select>

                    </div>



                    <div class="form-field form-required">

                        <label for="tag-name">Color</label><br/>

                        <select name="color" id="color" style="width:200px">

                            <option <?php  selected($default['color'], "red");?> value="red">Red</option>

                            <option <?php  selected($default['color'], "white");?>  value="white">White</option>

                        </select>

                    </div>



                    <div class="form-field form-required">

                        <label for="tag-name">Show Info</label><br/>

                        <select name="showinfo" id="showinfo" style="width:200px">

                            <option <?php  selected($default['showinfo'], "1");?> value="1">Yes</option>

                            <option <?php  selected($default['showinfo'], "0");?>  value="0">No</option>

                        </select>

                    </div>



                    <div class="form-field form-required">

                        <label for="tag-name">Autoplay</label><br/>

                        <select name="autoplay" id="autoplay" style="width:200px">

                            <option <?php  selected($default['autoplay'], "1");?> value="1">Yes</option>

                            <option <?php  selected($default['autoplay'], "0");?>  value="0">No</option>

                        </select>

                    </div>



                    <div class="form-field form-required">

                        <label for="tag-name">Controls</label><br/>

                        <select name="controls" id="controls" style="width:200px">

                            <option <?php  selected($default['controls'], "1");?> value="1">Enabled</option>

                            <option <?php  selected($default['controls'], "0");?>  value="0">Disabled</option>

                        </select>

                    </div>

                    <div class="form-field form-required">

                        <label for="tag-name">Controls</label><br/>

                        <select name="autohide" id="autohide" style="width:200px">

                            <option <?php  selected($default['autohide'], "2");?>  value="2">Fade Progress Bar</option>

                            <option <?php  selected($default['autohide'], "1");?> value="1">Show on mouse move</option>

                            <option <?php  selected($default['autohide'], "0");?>  value="0">Show all time</option>

                        </select>

                    </div>


                    <div class="form-field form-required">
                        <label for="tag-name">Social Buttons</label><br/>
                        <select name="social_buttons" id="social_buttons" style="width:200px !important;">
                            <option <?php  selected($default['social_buttons'], "1");?> value="1">Yes</option>
                            <option <?php  selected($default['social_buttons'], "0");?>  value="0">No</option>
                        </select>


                    </div>

            </div>

        </div>

        <div id="sfasc-footer">

            <a  id="insert" class="plp_insert" style="display: block; line-height: 24px;"><?php echo $insert_text; ?></a>

        </div>

    </form>

</div>



    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script type="text/javascript" src="jquery-ui.js"></script>



    <script type="text/javascript" src="video.js?time=<?php echo time(); ?>&ver=<?php echo $fasc_plugin_ver; ?>"></script>

    <script type="text/javascript" src="../../../../wp-includes/js/tinymce/tiny_mce_popup.js?ver=<?php echo $fasc_plugin_ver; ?>"></script>



    <script type="text/javascript">

        var source = "<?php echo $source; ?>";

    </script>

    <script type="text/javascript" src="popup.js?ver=<?php echo $fasc_plugin_ver; ?>"></script>



</body>

</html>