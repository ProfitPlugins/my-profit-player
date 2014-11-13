<div class="wrap">

    <div id="icon-options-general" class="icon32"></div>
    <h2><?php echo PLP_NAME;?></h2>

    <div id="poststuff">

        <div id="post-body" class="metabox-holder columns-2" style="width:80%">

            <!-- main content @TODO: check if campaigns exists, if they do, show the box-->
            <div id="post-body-content">

                <div class="meta-box-sortables ui-sortable" >

                    <div class="postbox">

                        <h3><span>Videos</span></h3>
                        <div class="inside">

                            <?php $id = 1;?>

                            <table class="wp-list-table widefat fixed tags">
                                <thead>
                                <tr>
                                    <th style="width:10%">ID</th>
                                    <th style="width:10%">Identifier</th>
                                    <th>URL</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                                </thead>
                                <tbody data-wp-lists="list:tag" id="the-list">
                                <?php
                                if(count($videos) > 0 && $videos) {
                                 foreach($videos as $video_id=>$video) {
                                    if (!empty($video)) { ?>

                                    <tr>
                                        <td class="video_id"><?php echo $video_id;?></td>
                                        <td><div class="plp_edit video_name"><?php echo stripslashes($video['name']);?></div></td>
                                        <td><div class="plp_edit video_url"><?php echo stripslashes($video['url']);?></div></td>
                                        <td>

                                        <input type="submit" class="button-primary delete_confirm" video-id="<?php echo $video_id;?>"  name="delete" value="Delete">&nbsp;


                                        </td>
                                    </tr>

                                <?php }
                                    }
                                } else {?>
                                    <tr class="no-items"><td colspan="5" class="colspanchange">No videos Found.</td></tr>
                                <?php } ?>
                                </tbody>
                            </table>




                        </div> <!-- .inside -->

                    </div> <!-- .postbox -->

                </div> <!-- .meta-box-sortables .ui-sortable -->

            </div> <!-- post-body-content -->

            <!-- main content @TODO: check if campaigns exists, if they do, show the box-->
            <div id="post-body-content">

                <div class="meta-box-sortables ui-sortable" >

                    <div class="postbox">

                        <h3><span>Add New Video</span></h3>
                        <div class="inside">
                            <form method="post">
                                <div class="form-field form-required">
                                    <label for="tag-name">Video Identifier</label><br/>
                                    <input type="text" style="width:200px" aria-required="true" id="video_id" name="video_id">
                                </div>
                                <div class="form-field form-required">
                                    <label for="tag-name">Video URL</label><br/>
                                     <input type="text" style="width:400px" aria-required="true" id="video_url" name="video_url">
                                </div>
                                <p class="submit">
                                    <input type="submit" value="Add Video" class="button button-primary" id="submit" name="submit">
                                </p>

                            </form>
                        </div> <!-- .inside -->

                    </div> <!-- .postbox -->

                </div> <!-- .meta-box-sortables .ui-sortable -->

            </div> <!-- post-body-content -->

            <!-- main content @TODO: check if campaigns exists, if they do, show the box-->
            <div id="post-body-content">

                <div class="meta-box-sortables ui-sortable" >

                    <div class="postbox">

                        <script type="text/javascript">
                            var ctas = [];
                        </script>

                        <h3><span>Calls To Action</span></h3>
                        <div class="inside">

                            <?php $id = 1;?>

                            <table class="wp-list-table widefat fixed tags">
                                <thead>
                                <tr>
                                    <th style="width:10%">ID</th>
                                    <th>Identifier</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                                </thead>
                                <tbody data-wp-lists="list:tag" id="the-list">
                                <?php if(count($ctas) == 0) {?>
                                    <tr class="no-items"><td colspan="2" class="colspanchange">No call to actions Found.</td></tr>
                                <?php } else foreach($ctas as $cta_id => $cta) {
                                    if (!empty($cta)) { 
                                    ?>

                                        <tr>
                                        <td><?php echo $cta_id;?></td>
                                        <td><div><?php echo stripslashes($cta['name']);?></div></td>
                                            <td>

                                            <input type="submit" class="button-primary" onclick="editCta(<?php echo $cta_id;?>);" name="delete" value="Edit">&nbsp;

                                            <input type="submit" class="button-primary delete_cta_confirm" cta-id="<?php echo $cta_id;?>"  name="delete" value="Delete">&nbsp;


                                            </td>
                                        </tr>

                                        <script type="text/javascript">
                                            ctas[<?php echo $cta_id; ?>] = jQuery.parseJSON('<?php echo addslashes(json_encode($cta)); ?>');
                                        </script>

                                    <?php } ?>

                                <?php } ?>
                                </tbody>
                            </table>

                            <script type="text/javascript">
                                var edit_cta = false;
                                function editCta(cta_id) {
                                    var cta = ctas[cta_id];
                                    edit_cta = cta;

                                    jQuery("#cta_id").val(cta_id);

                                    jQuery("#cta_name").val(cta.name);
                                    if (cta.image_url) {
                                        jQuery('#cta_type_image').click();
                                        jQuery("#cta_image_url").val(cta.image_url);
                                        jQuery("#cta_image_file").val(cta.background);
                                    }
                                    else {
                                        jQuery('#cta_type_custom').click();

                                        jQuery("#cta_headline").val(stripslashes(cta.headline));
                                        jQuery("#cta_headline_font_size").val(cta.headline_font_size);
                                        jQuery("#cta_headline_font").val(cta.headline_font);
                                        jQuery("#cta_headline_color").val(cta.headline_color).css('background', cta.headline_color);
                                        jQuery("#cta_headline_align").val(cta.headline_align);
                                        jQuery("#cta_headline_fontweight").val(cta.headline_fontweight);
                                        jQuery("#cta_headline_margintop").val(cta.headline_margintop);
                                        jQuery("#cta_headline_marginbottom").val(cta.headline_marginbottom);
                                        jQuery("#cta_subheadline").val(stripslashes(cta.subheadline));
                                        jQuery("#cta_subheadline_font_size").val(cta.subheadline_font_size);
                                        jQuery("#cta_subheadline_font").val(cta.subheadline_font);
                                        jQuery("#cta_subheadline_color").val(cta.subheadline_color).css('background', cta.subheadline_color);
                                        jQuery("#cta_subheadline_align").val(cta.subheadline_align);
                                        jQuery("#cta_subheadline_fontweight").val(cta.subheadline_fontweight);
                                        jQuery("#cta_subheadline_margintop").val(cta.subheadline_margintop);
                                        jQuery("#cta_subheadline_marginbottom").val(cta.subheadline_marginbottom);

                                        if (cta.background.type == "color") {
                                            jQuery('input[name="cta_background_type"][value="color"]').click();
                                            jQuery("input#cta_background_color").val(cta.background.value).css('background', cta.background.value);
                                        }
                                        else {
                                            jQuery('input[name="cta_background_type"][value="image"]').click();
                                            jQuery("#background_image").val(cta.background.value);
                                        }

                                        jQuery("#cta_button_text").val(stripslashes(cta.button_text));
                                        jQuery("#cta_button_url").val(cta.button_url);
                                        jQuery("#cta_button_font_size").val(cta.button_font_size);
                                        jQuery("#cta_button_font").val(cta.button_font);
                                        jQuery("#cta_button_color").val(cta.button_color).css('background', cta.button_color);
                                        jQuery("#cta_button_fontweight").val(cta.button_fontweight);
                                        jQuery("#cta_button_margintop").val(cta.button_margintop);
                                        jQuery("#cta_button_marginbottom").val(cta.button_marginbottom);
                                        jQuery("#cta_button_width").val(cta.button_width);
                                        jQuery("#cta_button_height").val(cta.button_height);

                                        jQuery("input#cta_button_bg_color").val(cta.button_background_color).css('background', cta.button_background_color);
                                        jQuery("input#cta_button_border_color").val(cta.button_border_color).css('background', cta.button_border_color);
                                    }

                                    jQuery("#cta_length").val(cta.length);

                                    jQuery('html, body').animate({
                                        scrollTop: jQuery("#plp-cta-form").offset().top
                                    }, 1000);
                                }

                                function stripslashes(str) {
                                  return (str + '')
                                    .replace(/\\(.?)/g, function(s, n1) {
                                      switch (n1) {
                                        case '\\':
                                          return '\\';
                                        case '0':
                                          return '\u0000';
                                        case '':
                                          return '';
                                        default:
                                          return n1;
                                      }
                                    });
                                }
                            </script>


                        </div> <!-- .inside -->

                    </div> <!-- .postbox -->

                </div> <!-- .meta-box-sortables .ui-sortable -->

            </div> <!-- post-body-content -->

            <!-- main content @TODO: check if campaigns exists, if they do, show the box-->
            <div id="post-body-content">

                <div class="meta-box-sortables ui-sortable" >

                    <div class="postbox" id="plp-cta-form">

                        <h3><span>Add New / Edit Call To Action</span></h3>
                        <div class="inside">
                            <form id="cta_form" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="cta_id" id="cta_id" value="" />
                                <div class="form-field form-required" style="padding-top: 15px; width: 600px; margin: auto;">
                                    <table cellpadding="5" style="width: 100%;">
                                        <tr>
                                            <td style="text-align: right; width: 100px;">Identifier:</td>
                                            <td><input type="text" style="width:200px" aria-required="true" id="cta_name" name="cta_name" /></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px;">Show for:</td>
                                            <td><input type="text" style="width: 60px" aria-required="true" id="cta_length" name="cta_length" value="5" /> (seconds)</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-field form-required" style="padding-top: 15px; width: 600px; margin: auto; display: none;">
                                    <label for="tag-name" style="font-weight: bold; padding-left: 126px;">Type</label><br/>
                                    <table cellpadding="5" style="width: 100%;">
                                        <tr>
                                            <td style="text-align: right; width: 100px;">&nbsp;</td>
                                            <td>
                                                <input type="radio" name="cta_type" value="image" id="cta_type_image" style="width: auto;" onclick="jQuery('#cta_image').show(); jQuery('#cta_custom').hide();" checked="checked" /> Image &nbsp;&nbsp;&nbsp; 
                                                <input type="radio" name="cta_type" value="custom" id="cta_type_custom" style="width: auto;" onclick="jQuery('#cta_image').hide(); jQuery('#cta_custom').show();" /> Custom
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div id="cta_image">
                                    <div class="form-field form-required" style="padding-top: 15px; width: 600px; margin: auto;">
                                        <table cellpadding="5" style="width: 100%;">
                                            <tr>
                                                <td style="text-align: right; width: 100px;">Upload:</td>
                                                <td>
                                                    <label for="cta_image_file">
                                                        <input id="cta_image_file" type="text" size="36" name="cta_image_file" value="" style="width:100%; display: inline-block !important;" />
                                                        <input id="upload_image_button" type="button" value="Upload Image" />
                                                        <br />Enter an URL or upload an image.
                                                    </label>
                                                    
                                                    <!--<input type="file" name="cta_image_file" id="cta_image_file" style="width: auto;" onchange="setImage(this);" /></td>-->
                                            </tr>
                                            <tr>
                                                <td style="text-align: right; width: 100px;">URL:</td>
                                                <td><input type="text" style="width:100%; display: inline-block !important;" aria-required="true" id="cta_image_url" name="cta_image_url" /></td>
                                            </tr>
                                        </table>

                                        <script type="text/javascript">
                                            jQuery(document).ready(function() {
                                                jQuery('#upload_image_button').click(function() {
                                                 formfield = jQuery('#cta_image_file').attr('name');
                                                 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
                                                 return false;
                                                });
                                                 
                                            });
                                        </script>
                                    </div>
                                </div>

                                <div id="cta_custom" style="display: none;">

                                    <div class="form-field form-required" style="padding-top: 15px; width: 600px; margin: auto;">
                                        <label for="cta_headline" style="font-weight: bold; padding-left: 126px;">Headline</label><br/>
                                        <table cellpadding="5" style="width: 100%;">
                                            <tr>
                                                <td style="text-align: right; width: 100px;">Text:</td>
                                                <td><input type="text" style="width: 100%; display: inline-block !important;" aria-required="true" id="cta_headline" name="cta_headline" /></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Font:</td>
                                                <td>
                                                    <select name="cta_headline_font" id="cta_headline_font" style="width: 200px; display: inline-block !important; margin-top: -3px;">
                                                        <?php foreach ($google_fonts as $google_font) { ?>
                                                            <option value="<?php echo $google_font; ?>" <?php if ($google_font == "Open Sans") { ?>selected="selected"<?php } ?>><?php echo $google_font; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <select name="cta_headline_font_size" id="cta_headline_font_size" style="width: 70px; display: inline-block !important; margin-top: -3px;">
                                                        <?php for ($i = 10; $i <= 40; $i++) { ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?>px</option>
                                                        <?php } ?>
                                                    </select>
                                                    <select name="cta_headline_fontweight" id="cta_headline_fontweight" style="width: 70px; display: inline-block !important; margin-top: -3px;">
                                                            <option value="normal">Regular</option>
                                                            <option value="bold">Bold</option>
                                                    </select>
                                                    <input style="width: 80px;" class="color {hash:true ,pickerClosable:true, pickerPosition:'right'}" name="cta_headline_color" id="cta_headline_color" value="#000000" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Align:</td>
                                                <td>
                                                    <select name="cta_headline_align" id="cta_headline_align" style="width: 70px; display: inline-block !important; margin-top: -3px;">
                                                            <option value="left">Left</option>
                                                            <option value="center">Center</option>
                                                            <option value="right">Right</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Margin:</td>
                                                <td>
                                                    Top: <input type="number" min="0" max="50" style="width: 50px;" name="cta_headline_margintop" id="cta_headline_margintop" value="0" /> px
                                                    &nbsp;&nbsp;&nbsp;
                                                    Bottom:
                                                    <input type="number" min="0" max="50" style="width: 50px;" name="cta_headline_marginbottom" id="cta_headline_marginbottom" value="0" /> px
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="form-field form-required" style="padding-top: 15px; width: 600px; margin: auto;">
                                        <label for="cta_subheadline" style="font-weight: bold; padding-left: 126px;">Sub Headline</label><br/>
                                        <table cellpadding="5" style="width: 100%;">
                                            <tr>
                                                <td style="text-align: right; width: 100px;">Text:</td>
                                                <td><input type="text" style="width:100%; display: inline-block !important;" aria-required="true" id="cta_subheadline" name="cta_subheadline" /><br/></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Font:</td>
                                                <td>
                                                    <select name="cta_subheadline_font" id="cta_subheadline_font" style="width: 200px; display: inline-block !important; margin-top: -3px;">
                                                        <?php foreach ($google_fonts as $google_font) { ?>
                                                            <option value="<?php echo $google_font; ?>" <?php if ($google_font == "Open Sans") { ?>selected="selected"<?php } ?>><?php echo $google_font; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <select name="cta_subheadline_font_size" id="cta_subheadline_font_size" style="width: 70px; display: inline-block !important; margin-top: -3px;">
                                                        <?php for ($i = 10; $i <= 40; $i++) { ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?>px</option>
                                                        <?php } ?>
                                                    </select>
                                                    <select name="cta_subheadline_fontweight" id="cta_subheadline_fontweight" style="width: 70px; display: inline-block !important; margin-top: -3px;">
                                                            <option value="normal">Regular</option>
                                                            <option value="bold">Bold</option>
                                                    </select>
                                                    <input style="width: 80px;" class="color {hash:true ,pickerClosable:true, pickerPosition:'right'}" name="cta_subheadline_color" id="cta_subheadline_color" value="#000000" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Align:</td>
                                                <td>
                                                    <select name="cta_subheadline_align" id="cta_subheadline_align" style="width: 70px; display: inline-block !important; margin-top: -3px;">
                                                            <option value="left">Left</option>
                                                            <option value="center">Center</option>
                                                            <option value="right">Right</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Margin:</td>
                                                <td>
                                                    Top: <input type="number" min="0" max="50" style="width: 50px;" name="cta_subheadline_margintop" id="cta_subheadline_margintop" value="0" /> px
                                                    &nbsp;&nbsp;&nbsp;
                                                    Bottom:
                                                    <input type="number" min="0" max="50" style="width: 50px;" name="cta_subheadline_marginbottom" id="cta_subheadline_marginbottom" value="0" /> px
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="form-field form-required" style="padding-top: 15px; width: 600px; margin: auto;">
                                        <label for="cta_headline" style="font-weight: bold; padding-left: 126px;">Background</label><br/>
                                        <table cellpadding="5" style="width: 100%;">
                                            <tr>
                                                <td style="text-align: right; width: 100px;">Type:</td>
                                                <td>
                                                    <input type="radio" name="cta_background_type" value="color" style="width: auto;" onclick="jQuery('#cta_background_color').show(); jQuery('#cta_background_image').hide();" checked="checked" /> Color &nbsp;&nbsp;&nbsp; 
                                                    <input type="radio" name="cta_background_type" value="image" style="width: auto;" onclick="jQuery('#cta_background_color').hide(); jQuery('#cta_background_image').show();" /> Image
                                                </td>
                                            </tr>
                                            <tr id="cta_background_color">
                                                <td style="text-align: right; width: 100px;">Select:</td>
                                                <td>
                                                    <input style="width: 80px;" class="color {hash:true ,pickerClosable:true, pickerPosition:'right'}" name="cta_background_color" id="cta_background_color" />
                                                </td>
                                            </tr>
                                            <tr id="cta_background_image" style="display: none;">
                                                <td style="text-align: right; width: 100px;">Upload:</td>
                                                <td>

                                                    <label for="background_image">
                                                        <input id="background_image" type="text" size="36" name="background_image" value="" style="width:100%; display: inline-block !important;" />
                                                        <input id="upload_image_button_bg" type="button" value="Upload Image" />
                                                        <br />Enter an URL or upload an image.
                                                    </label>
                                                </td>
                                            </tr>
                                        </table>

                                        <script type="text/javascript">
                                            jQuery(document).ready(function() {
                                                jQuery('#upload_image_button_bg').click(function() {
                                                 formfield = jQuery('#background_image').attr('name');
                                                 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
                                                 return false;
                                                });
                                                 
                                                window.send_to_editor = function(html) {
                                                 imgurl = jQuery('img',html).attr('src');
                                                 if (jQuery("#cta_image").is(":visible"))
                                                    jQuery('#cta_image_file').val(imgurl);
                                                 else
                                                    jQuery('#background_image').val(imgurl);
                                                 tb_remove();
                                                }
                                                 
                                            });
                                        </script>
                                    </div>

                                    <div class="form-field form-required" style="padding-top: 15px; width: 600px; margin: auto;">
                                        <label for="cta_headline" style="font-weight: bold; padding-left: 126px;">Button</label><br/>
                                        <table cellpadding="5" style="width: 100%;">
                                            <tr>
                                                <td style="text-align: right; width: 100px;">Text:</td>
                                                <td>
                                                    <input type="text" style="width:200px; display: inline-block !important;" aria-required="true" id="cta_button_text" name="cta_button_text" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right; width: 100px;">Font:</td>
                                                <td>
                                                    <select name="cta_button_font" id="cta_button_font" style="width: 200px; display: inline-block !important; margin-top: -3px;">
                                                        <?php foreach ($google_fonts as $google_font) { ?>
                                                            <option value="<?php echo $google_font; ?>" <?php if ($google_font == "Open Sans") { ?>selected="selected"<?php } ?>><?php echo $google_font; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <select name="cta_button_font_size" id="cta_button_font_size" style="width: 70px; display: inline-block !important; margin-top: -3px;">
                                                        <?php for ($i = 10; $i <= 40; $i++) { ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?>px</option>
                                                        <?php } ?>
                                                    </select>
                                                    <select name="cta_button_fontweight" id="cta_button_fontweight" style="width: 70px; display: inline-block !important; margin-top: -3px;">
                                                            <option value="normal">Regular</option>
                                                            <option value="bold">Bold</option>
                                                    </select>
                                                    <input style="width: 80px;" class="color {hash:true ,pickerClosable:true, pickerPosition:'right'}" name="cta_button_color" id="cta_button_color" value="#000000" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right; width: 100px;">URL:</td>
                                                <td>
                                                    <input type="text" style="width:100%; display: inline-block !important;" aria-required="true" id="cta_button_url" name="cta_button_url" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right; width: 100px;">Background:</td>
                                                <td>
                                                    <input style="width: 80px;" class="color {hash:true ,pickerClosable:true, pickerPosition:'right'}" name="cta_button_bg_color" id="cta_button_bg_color" value="#008c00" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right; width: 100px;">Border:</td>
                                                <td>
                                                    <input style="width: 80px;" class="color {hash:true ,pickerClosable:true, pickerPosition:'right'}" name="cta_button_border_color" id="cta_button_border_color" value="#008c00" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Margin:</td>
                                                <td>
                                                    Top: <input type="number" min="0" max="50" style="width: 50px;" name="cta_button_margintop" id="cta_button_margintop" value="0" /> px
                                                    &nbsp;&nbsp;&nbsp;
                                                    Bottom:
                                                    <input type="number" min="0" max="50" style="width: 50px;" name="cta_button_marginbottom" id="cta_button_marginbottom" value="0" /> px
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Width:</td>
                                                <td>
                                                    <input type="number" min="50" max="500" style="width: 50px;" name="cta_button_width" id="cta_button_width" value="100" /> px
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Height:</td>
                                                <td>
                                                    <input type="number" min="20" max="100" style="width: 50px;" name="cta_button_height" id="cta_button_height" value="20" /> px
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="form-field form-required" style="padding-top: 15px; width: 600px; margin: auto;">
                                    <table cellpadding="5" style="width: 100%;">
                                        <tr>
                                            <td style="text-align: right; width: 100px;">&nbsp;</td>
                                            <td>
                                                <input type="button" value="Preview" class="button button-primary" id="preview_btn" name="preview_btn" onclick="previewCta();">
                                                <input type="submit" value="Save" class="button button-primary" id="submit2" name="submit2">
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </form>

                            <div id="preview_cta_div" class="rp_ctaData" title="Preview call to action" style="display: none; width: 100%">
                                <div class="rp_ctaData_wrapper" id="rp_ctaData_wrapper" style="width: 640px; height: 360px; margin: auto;">
                                    <div class="rp_ctaData_headline" style="padding: 20px; text-align: center;"></div>
                                    <div class="rp_ctaData_subheadline" style="padding: 20px;"></div>
                                    <div style="text-align: center; padding-top: 20px;">
                                        <span class="rp_ctaData_button" style="padding: 10px; cursor: pointer; border-radius: 5px; -webkit-border-radius: 5px; -moz-border-radius: 5px; display: inline-block;"></span>
                                    </div>
                                </div>
                                <div style="text-align: center; padding-top: 10px;">
                                    <input type="button" value="Back" class="button button-primary" id="preview_btn" name="preview_btn" onclick="jQuery('#preview_cta_div').hide(); jQuery('#cta_form').show();">
                                </div>
                            </div>

                            <script type="text/javascript">
                                function previewCta() {
                                    jQuery("#preview_cta_div").show();
                                    jQuery("#cta_form").hide();

                                    jQuery(".rp_ctaData_wrapper").css('width', jQuery("#width").val());
                                    var width = jQuery(".rp_ctaData_wrapper").width();
                                    var height = Math.round((width/16)*9);
                                    jQuery(".rp_ctaData_wrapper").css('height', height + 'px');

                                    if (jQuery('input[name="cta_type"][value="image"]').is(":checked")) {
                                        var cta_data = {
                                            button_url: jQuery("#cta_image_url").val()
                                        };

                                        cta_data.background = jQuery("input#cta_image_file").val();

                                        jQuery(".rp_ctaData_wrapper").css('background', 'url(' + cta_data.background + ')');
                                        document.getElementById("rp_ctaData_wrapper").style.backgroundSize = width + 'px ' + height + 'px';
                                        jQuery(".rp_ctaData_wrapper").css('cursor', 'pointer');
                                        jQuery(".rp_ctaData_headline, .rp_ctaData_subheadline").hide();
                                        jQuery(".rp_ctaData_button").parent().hide();
                                    }
                                    else {
                                        var cta_data = {
                                            headline: jQuery("#cta_headline").val(),
                                            headline_font_size: jQuery("#cta_headline_font_size").val(),
                                            headline_font: jQuery("#cta_headline_font").val(),
                                            headline_color: jQuery("#cta_headline_color").val(),
                                            headline_align: jQuery("#cta_headline_align").val(),
                                            headline_fontweight: jQuery("#cta_headline_fontweight").val(),
                                            headline_margintop: jQuery("#cta_headline_margintop").val(),
                                            headline_marginbottom: jQuery("#cta_headline_marginbottom").val(),
                                            subheadline: jQuery("#cta_subheadline").val(),
                                            subheadline_font_size: jQuery("#cta_subheadline_font_size").val(),
                                            subheadline_font: jQuery("#cta_subheadline_font").val(),
                                            subheadline_color: jQuery("#cta_subheadline_color").val(),
                                            subheadline_align: jQuery("#cta_subheadline_align").val(),
                                            subheadline_fontweight: jQuery("#cta_subheadline_fontweight").val(),
                                            subheadline_margintop: jQuery("#cta_subheadline_margintop").val(),
                                            subheadline_marginbottom: jQuery("#cta_subheadline_marginbottom").val(),
                                            button_text: jQuery("#cta_button_text").val(),
                                            button_url: jQuery("#cta_button_url").val(),
                                            button_font_size: jQuery("#cta_button_font_size").val(),
                                            button_font: jQuery("#cta_button_font").val(),
                                            button_color: jQuery("#cta_button_color").val(),
                                            button_background_color: jQuery("#cta_button_bg_color").val(),
                                            button_border_color: jQuery("#cta_button_border_color").val(),
                                            button_fontweight: jQuery("#cta_button_fontweight").val(),
                                            button_margintop: jQuery("#cta_button_margintop").val(),
                                            button_marginbottom: jQuery("#cta_button_marginbottom").val(),
                                            button_width: jQuery("#cta_button_width").val(),
                                            button_height: jQuery("#cta_button_height").val(),
                                            background: {}
                                        };

                                        jQuery(".rp_ctaData_wrapper").css('cursor', 'auto');
                                        jQuery(".rp_ctaData_headline, .rp_ctaData_subheadline").show();
                                        jQuery(".rp_ctaData_button").parent().show();

                                        if (jQuery('input[name="cta_background_type"][value="color"]').is(":checked")) {
                                            cta_data.background.type = "color";
                                            cta_data.background.value = jQuery("input#cta_background_color").val();
                                        }
                                        else {
                                            cta_data.background.type = "image";
                                            cta_data.background.value = jQuery("input#background_image").val();

                                        }

                                        if (cta_data.background.type == 'color') {
                                            jQuery(".rp_ctaData_wrapper").css('background', cta_data.background.value);
                                        }
                                        else {
                                            jQuery(".rp_ctaData_wrapper").css('background', 'url(' + cta_data.background.value + ')');
                                        }
                                        
                                        document.getElementById("rp_ctaData_wrapper").style.backgroundSize = width + 'px ' + height + 'px';

                                        jQuery(".rp_ctaData_headline").html(stripslashes(cta_data.headline));
                                        jQuery(".rp_ctaData_headline").css('font-size', cta_data.headline_font_size + 'px');
                                        jQuery(".rp_ctaData_headline").css('font-family', "'" + cta_data.headline_font + "'");
                                        jQuery(".rp_ctaData_headline").css('text-align', cta_data.headline_align);
                                        jQuery(".rp_ctaData_headline").css('color', cta_data.headline_color);
                                        jQuery(".rp_ctaData_headline").css('font-weight', cta_data.headline_fontweight);
                                        jQuery(".rp_ctaData_headline").css('padding-top', cta_data.headline_margintop + 'px');
                                        jQuery(".rp_ctaData_headline").css('padding-bottom', cta_data.headline_marginbottom + 'px');

                                        jQuery(".rp_ctaData_subheadline").html(stripslashes(cta_data.subheadline));
                                        jQuery(".rp_ctaData_subheadline").css('font-size', cta_data.subheadline_font_size + 'px');
                                        jQuery(".rp_ctaData_subheadline").css('font-family', "'" + cta_data.subheadline_font + "'");
                                        jQuery(".rp_ctaData_subheadline").css('text-align', cta_data.subheadline_align);
                                        jQuery(".rp_ctaData_subheadline").css('color', cta_data.subheadline_color);
                                        jQuery(".rp_ctaData_subheadline").css('font-weight', cta_data.subheadline_fontweight);
                                        jQuery(".rp_ctaData_subheadline").css('padding-top', cta_data.subheadline_margintop + 'px');
                                        jQuery(".rp_ctaData_subheadline").css('padding-bottom', cta_data.subheadline_marginbottom + 'px');
                                        
                                        jQuery(".rp_ctaData_button").html(stripslashes(cta_data.button_text));
                                        jQuery(".rp_ctaData_button").css('font-size', cta_data.button_font_size + 'px');
                                        jQuery(".rp_ctaData_button").css('font-family', "'" + cta_data.button_font + "'");
                                        jQuery(".rp_ctaData_button").css('color', cta_data.button_color);
                                        jQuery(".rp_ctaData_button").css('background', cta_data.button_background_color);
                                        jQuery(".rp_ctaData_button").css('border', 'solid 1px ' + cta_data.button_border_color);
                                        jQuery(".rp_ctaData_button").css('font-weight', cta_data.button_fontweight);
                                        jQuery(".rp_ctaData_button").css('margin-top', cta_data.button_margintop + 'px');
                                        jQuery(".rp_ctaData_button").css('margin-bottom', cta_data.button_marginbottom + 'px');
                                        jQuery(".rp_ctaData_button").css('width', cta_data.button_width + 'px');
                                        jQuery(".rp_ctaData_button").css('height', cta_data.button_height + 'px');
                                        jQuery(".rp_ctaData_button").css('line-height', cta_data.button_height + 'px');
                                    }

                                    jQuery('html, body').animate({
                                        scrollTop: jQuery("#plp-cta-form").offset().top
                                    }, 100);
                                }
                            </script>
                        </div> <!-- .inside -->

                    </div> <!-- .postbox -->

                </div> <!-- .meta-box-sortables .ui-sortable -->

            </div> <!-- post-body-content -->


            <!-- main conten -->
            <div id="post-body-content">

                <div class="meta-box-sortables ui-sortable" >

                    <div class="postbox">

                        <form method="post">
                            <div style="float: left;">
                                <h3><span>Default Player Settings</span></h3>
                                <div class="inside">
                                    <div class="form-field form-required">
                                        <label for="tag-name">Width</label><br/>
                                        <input type="text" style="width: 200px;" aria-required="true" id="width" value="<?php echo $default['width'];?>" name="width"> (px or %)
                                    </div>

                                    <div class="form-field form-required">
                                        <label for="tag-name">Theme</label><br/>
                                        <select name="theme" style="width:200px !important;">
                                            <option <?php  selected($default['theme'], "dark");?> value="dark">Dark</option>
                                            <option <?php  selected($default['theme'], "light");?>  value="light">Light</option>
                                        </select>


                                    </div>

                                    <div class="form-field form-required">
                                        <label for="tag-name">Color</label><br/>
                                        <select name="color" style="width:200px !important;">
                                            <option <?php  selected($default['color'], "red");?> value="red">Red</option>
                                            <option <?php  selected($default['color'], "white");?>  value="white">White</option>
                                        </select>


                                    </div>

                                  <!--  <div class="form-field form-required">
                                        <label for="tag-name">Related Videos</label><br/>
                                        <select name="rel" style="width:200px !important;">
                                            <option <?php  selected($default['rel'], "1");?> value="1">Yes</option>
                                            <option <?php  selected($default['rel'], "0");?>  value="0">No</option>
                                        </select>


                                    </div> -->


                                    <div class="form-field form-required">
                                        <label for="tag-name">Show Info</label><br/>
                                        <select name="showinfo" style="width:200px !important;">
                                            <option <?php  selected($default['showinfo'], "1");?> value="1">Yes</option>
                                            <option <?php  selected($default['showinfo'], "0");?>  value="0">No</option>
                                        </select>


                                    </div>

                                    <div class="form-field form-required">
                                        <label for="tag-name">Autoplay</label><br/>
                                        <select name="autoplay" style="width:200px !important;">
                                            <option <?php  selected($default['autoplay'], "1");?> value="1">Yes</option>
                                            <option <?php  selected($default['autoplay'], "0");?>  value="0">No</option>
                                        </select>


                                    </div>

                                    <div class="form-field form-required">
                                        <label for="tag-name">Controls</label><br/>
                                        <select name="controls" style="width:200px !important;">

                                            <option <?php  selected($default['controls'], "1");?> value="1">Enabled</option>
                                            <option <?php  selected($default['controls'], "0");?>  value="0">Disabled</option>
                                        </select>


                                    </div>




                                    <div class="form-field form-required">
                                        <label for="tag-name">Controls</label><br/>
                                        <select name="autohide" style="width:200px !important;">
                                            <option <?php  selected($default['autohide'], "2");?>  value="2">Fade Progress Bar</option>
                                            <option <?php  selected($default['autohide'], "1");?> value="1">Show on mouse move</option>
                                            <option <?php  selected($default['autohide'], "0");?>  value="0">Show all time</option>
                                        </select>


                                    </div>


                                    <div class="form-field form-required">
                                        <label for="tag-name">Social Buttons</label><br/>
                                        <select name="social_buttons" style="width:200px !important;">
                                            <option <?php  selected($default['social_buttons'], "1");?> value="1">Yes</option>
                                            <option <?php  selected($default['social_buttons'], "0");?>  value="0">No</option>
                                        </select>


                                    </div>



                                    <p class="submit">
                                        <input type="submit" value="Update" class="button button-primary" id="submit" name="default_submit">
                                    </p>

                                </div> <!-- .inside -->
                            </div>

                            <div style="float: left; padding-left: 40px;">
                                <h3><span>Global Settings</span></h3>
                                <div class="inside">
                                    <form method="post">

                                        <div class="form-field form-required">
                                            <label for="tag-name">Social Buttons</label><br/>

                                            <select name="social_buttons_global" style="width:200px !important;">
                                                <option <?php  selected($default['social_buttons_global'], "player_settings");?>  value="player_settings">Use player settings</option>
                                                <option <?php  selected($default['social_buttons_global'], "never_show");?> value="never_show">Never show</option>
                                                <option <?php  selected($default['social_buttons_global'], "always_show");?>  value="always_show">Always show </option>
                                            </select>
                                        </div>

                                    </form>
                                </div> <!-- .inside -->
                            </div>

                            <div style="clear: both;"></div>
                        </form>

                    </div> <!-- .postbox -->

                </div> <!-- .meta-box-sortables .ui-sortable -->

            </div> <!-- post-body-content -->



        </div> <!-- #post-body .metabox-holder .columns-2 -->

        <br class="clear">
    </div> <!-- #poststuff -->

</div> <!-- .wrap -->

