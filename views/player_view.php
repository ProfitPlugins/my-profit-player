<?php $id = rand();?>
<script type="text/javascript">
    var exploded = window.location.href.split("#mpp_");
    if (exploded.length > 1)
        window.location = exploded[0];
</script>

<?php
if ($google_fonts) {
    foreach ($google_fonts as $font) {
        if (!empty($font)) {
            if (strpos(json_encode($total_elements), $font) !== false) {
            ?>
                <link href='http://fonts.googleapis.com/css?family=<?php echo $font; ?>' rel='stylesheet' type='text/css'>

        <?php }
        }
    }
} ?>

<script type="text/javascript">
    if (typeof(yt_players) == "undefined") {
        var yt_players = {};
    }
    if (typeof(vimeo_players) == "undefined") {
        var vimeo_players = {};
    }
    if (typeof(wistia_players) == "undefined") {
        var wistia_players = {};
    }

    jQuery(function() {
        jQuery("ul#rp_playlist_<?php echo $id;?>").youtubePlaylist({
            id: <?php echo $id; ?>,
            autoPlay: <?php echo $atts['autoplay'];?>,
            allowFullScreen: true,
            deepLinks: true,
            onChange: function(){},
            start: 1,
            youtube: {
                controls: '<?php echo $atts['controls'];?>', // '2' = autohide title, '1' = autohide everything, '0' = show all
                autohide: '<?php echo $atts['autohide'];?>', // '2' = autohide title, '1' = autohide everything, '0' = show all
                rel: '<?php echo $atts['rel'];?>', // '1' = show related videos, '0' = hide related videos
                theme: '<?php echo $atts['theme'];?>', // 'light' = standard theme, 'dark' = dark theme
                color: '<?php echo $atts['color'];?>', // 'red' = red progress bar, 'white' = white progress bar
                showinfo: '<?php echo $atts['showinfo'];?>', // '1' = show title and info, '0' = hide title and info
                vq: 'hd720' // 'vq=small' = 240p, 'vq=medium' = 360p, 'vq=large' = 480p, 'vq=hd720' = 720p, 'vq=hd1080' = 1080p
            },
            vimeo: {
                title: '1', // '1' = show title, '0' = hide title
                byline: '1', // '1' = show byline, '0' = hide byline
                portrait: '1', // '1' = show portrait, '0' = hide portrait
                color: 'ffffff' // player interface color (do not include # symbol)
            },
            holderId: 'rp_video_<?php echo $id;?>',
            // youtubeUsername: 'username',
            // vimeoUsername: 'username',
            secure: 'auto' //false|true|'auto'
        });
    });
</script>

<div class="plugin_wrapper" style="width:<?php echo $atts['width'];?>;">
    <div class="rp_plugin">
        <div class="rp_ctaData_<?php echo $id;?>" style="display: none; position: relative; margin-bottom: 30px;">
            <div class="rp_ctaData_<?php echo $id;?>_wrapper" id="rp_ctaData_<?php echo $id;?>_wrapper" style="width:<?php echo $atts['width'];?>; height: 360px;">
                <div class="rp_ctaData_<?php echo $id;?>_headline" style="padding: 20px; text-align: center;"></div>
                <div class="rp_ctaData_<?php echo $id;?>_subheadline" style="padding: 20px;"></div>
                <div style="text-align: center; padding-top: 20px;">
                    <span class="rp_ctaData_<?php echo $id;?>_button" style="padding: 10px; cursor: pointer; border-radius: 5px; -webkit-border-radius: 5px; -moz-border-radius: 5px; display: inline-block;"></span>
                </div>
            </div>
            <div id="rp_ctaCounterWrapper_<?php echo $id;?>" style="display: none; position: absolute; right: 0px; bottom: 25px; padding: 10px; color: #FFFFFF; background: #27241e; opacity: 0.85; filter: alpha(opacity=85); /* For IE8 and earlier */">
                Next video in <span class="rp_ctaCounter_<?php echo $id; ?>">0</span> seconds
            </div>
        </div>

        <div class="rp_videoContainer rp_video_<?php echo $id;?>Container" style="display: none;">
            <div class="rp_video rp_video_<?php echo $id;?>">
            </div>
        </div>
        <div class="rp_playlistContainer rp_playlistContainer_<?php echo $id;?>">
            <ul id="rp_playlist_<?php echo $id;?>">
                <?php
                if (count($video_urls) == 0) $video_urls[] = "http://www.youtube.com/watch?v=znK652H6yQM";
                foreach($video_urls as $url) {
                    if (strpos($url, "youtube") !== false || strpos($url, "vimeo") !== false || strpos($url, "wistia") !== false) {
                    ?>
                        <li><a href="<?php echo $url;?>"></a></li>
                <?php }
                }?>
            </ul>
        </div>

        <?php
        $show_social_buttons = false;

        if ($default['social_buttons_global'] == "never_show") {
            $show_social_buttons = false;
        }
        elseif ($default['social_buttons_global'] == "always_show") {
            $show_social_buttons = true;
        }
        elseif ($default['social_buttons_global'] == "player_settings") {
            if (@$atts['social_buttons'] == 1)
                $show_social_buttons = true;
        }

        if ($show_social_buttons) { ?>

            <div class="rp_socialButtons_<?php echo $id;?>" style="width:<?php echo $atts['width'];?>;">
                <button style="width: 33.3%; margin: 0px; display: inline-block; background: #3370AA; font-weight: bold; font-size: 13px;" onclick="shareFacebook();"><img src="<?php echo PLP_IMAGES_URL; ?>facebook-24x24.png" style="vertical-align: middle; margin-right: 2px;" /> Facebook</button><button style="width: 33.3%; margin: 0px; display: inline-block; background: #0BBCFF; font-weight: bold; font-size: 13px;" onclick="shareTwitter();"><img src="<?php echo PLP_IMAGES_URL; ?>twitter-24x24.png" style="vertical-align: middle; margin-right: 5px;" /> Twitter</button><button style="width: 33.4%; margin: 0px; display: inline-block; background: #D6492B; font-weight: bold; font-size: 13px;" onclick="shareGooglePlus();"><img src="<?php echo PLP_IMAGES_URL; ?>google+-24x24.png" style="vertical-align: middle; margin-right: 5px;" /> Google+</button>
            </div>

            <script type="text/javascript">
                if (typeof(shareFacebook) == "undefined") {
                    function shareFacebook() {
                        var top = (screen.height/2) - (325/2);
                        var left = (screen.width/2) - (548/2);
                        window.open('http://www.facebook.com/sharer.php?u=' + window.location.href, 'sharer', 'toolbar=0, status=0, width=548, height=325, top=' + top + ', left=' + left);
                    }
                }

                if (typeof(shareTwitter) == "undefined") {
                    function shareTwitter() {
                        var top = (screen.height/2) - (325/2);
                        var left = (screen.width/2) - (548/2);
                        window.open('http://twitter.com/share?url=' + window.location.href, 'sharer', 'toolbar=0, status=0, width=548, height=325, top=' + top + ', left=' + left);
                    }
                }

                if (typeof(shareGooglePlus) == "undefined") {
                    function shareGooglePlus() {
                        var top = (screen.height/2) - (325/2);
                        var left = (screen.width/2) - (548/2);
                        window.open('http://apis.google.com/share?url=' + window.location.href, 'sharer', 'toolbar=0, status=0, width=548, height=325, top=' + top + ', left=' + left);
                    }
                }
            </script>

        <?php } ?>
    </div>
</div>

<div style="clear: both; margin-bottom: 10px;"></div>

<script type="text/javascript">
    if (typeof(mpp_total_elements) == "undefined") {
        var mpp_total_elements = {};
    }
    if (typeof(mpp_current_element) == "undefined") {
        var mpp_current_element = {};
    }
    if (typeof(mpp_video_called) == "undefined") {
        var mpp_video_called = {};
    }

    mpp_current_element[<?php echo $id;?>] = 0;
    mpp_video_called[<?php echo $id;?>] = 0;
    mpp_total_elements[<?php echo $id;?>] = jQuery.parseJSON('<?php echo addslashes(json_encode($total_elements, true)); ?>');
    jQuery(document).ready(function() {
        setTimeout(function() {
            onDocReady_<?php echo $id; ?>();
        }, 1000);
    });

    function onDocReady_<?php echo $id; ?>() {
        //console.log(yt_players);
        //if (!yt_players["mpp_iframe_<?php echo $id;?>"]) {
        if (jQuery("#mpp_iframe_<?php echo $id;?>").length == 0) {
            setTimeout(function() {
                onDocReady_<?php echo $id; ?>();
            }, 1000);
            return false;
        }

        if (mpp_total_elements[<?php echo $id;?>][mpp_current_element[<?php echo $id;?>]].type == "cta") {
            displayCta(mpp_total_elements[<?php echo $id;?>][mpp_current_element[<?php echo $id;?>]].data, <?php echo $id; ?>);
        }
        else {
            jQuery(".rp_video_<?php echo $id;?>Container").show();
        }
    }

    if (typeof(rp_ctaInt) == "undefined") {
        var rp_ctaInt = {};
    }
    if (typeof(rp_ctaCount) == "undefined") {
        var rp_ctaCount = {};
    }
    rp_ctaInt[<?php echo $id; ?>] = null;
    rp_ctaCount[<?php echo $id; ?>] = 0;

    if (typeof(displayCta) == "undefined") {
        function displayCta(cta_data, theId) {
            jQuery(".rp_ctaData_" + theId + "_wrapper").css('height', jQuery(".rp_video_" + theId + "Container").height() + 'px');
            jQuery(".rp_video_" + theId + "Container").hide();
            jQuery(".rp_ctaData_" + theId).show();

            if (cta_data.image_url) {
                jQuery(".rp_ctaData_" + theId + "_wrapper").css('background-image', 'url(' + cta_data.background + ')');
                jQuery(".rp_ctaData_" + theId + "_wrapper").css('background-color', "none");
                document.getElementById("rp_ctaData_" + theId + "_wrapper").style.backgroundSize = jQuery(".rp_ctaData_" + theId + "_wrapper").width() + 'px ' + jQuery(".rp_ctaData_" + theId + "_wrapper").height() + 'px';
                jQuery(".rp_ctaData_" + theId + "_button").parent().hide();
                jQuery(".rp_ctaData_" + theId + "_wrapper").html('<div style="cursor: pointer; width: ' + jQuery(".rp_ctaData_" + theId + "_wrapper").width() + 'px; height: ' + jQuery(".rp_ctaData_" + theId + "_wrapper").height() + 'px;" class="rp_clickableDiv_' + theId + '"></div>');
                jQuery(".rp_clickableDiv_" + theId + "").click(function() {
                    window.open(
                      cta_data.image_url,
                      '_blank' // <- This is what makes it open in a new window.
                    );
                });
            }
            else {
                jQuery(".rp_ctaData_" + theId + "_wrapper").html('<div class="rp_ctaData_' + theId + '_headline" style="padding: 20px; text-align: center;"></div>' +
                    '<div class="rp_ctaData_' + theId + '_subheadline" style="padding: 20px;"></div>' +
                    '<div style="text-align: center; padding-top: 20px;">' +
                        '<span class="rp_ctaData_' + theId + '_button" style="padding: 10px; cursor: pointer; border-radius: 5px; -webkit-border-radius: 5px; -moz-border-radius: 5px; display: inline-block;"></span>' +
                    '</div>');

                jQuery(".rp_ctaData_" + theId + "_wrapper").css('cursor', 'auto');
                if (cta_data.background.type == 'color') {
                    jQuery(".rp_ctaData_" + theId + "_wrapper").css('background-color', cta_data.background.value);
                    jQuery(".rp_ctaData_" + theId + "_wrapper").css('background-image', "none");
                }
                else {
                    jQuery(".rp_ctaData_" + theId + "_wrapper").css('background-image', 'url(' + cta_data.background.value + ')');
                    jQuery(".rp_ctaData_" + theId + "_wrapper").css('background-color', "none");
                }

                document.getElementById("rp_ctaData_" + theId + "_wrapper").style.backgroundSize = jQuery(".rp_ctaData_" + theId + "_wrapper").width() + 'px ' + jQuery(".rp_ctaData_" + theId + "_wrapper").height() + 'px';
                //document.getElementById("rp_ctaData_" + theId + "_wrapper").style.backgroundSize = '100px 100px';
                jQuery(".rp_ctaData_" + theId + "_headline").html(stripslashes_<?php echo $id; ?>(cta_data.headline));
                jQuery(".rp_ctaData_" + theId + "_headline").css('font-size', cta_data.headline_font_size + 'px');
                jQuery(".rp_ctaData_" + theId + "_headline").css('font-family', "'" + cta_data.headline_font + "'");
                jQuery(".rp_ctaData_" + theId + "_headline").css('text-align', cta_data.headline_align);
                jQuery(".rp_ctaData_" + theId + "_headline").css('color', cta_data.headline_color);
                jQuery(".rp_ctaData_" + theId + "_headline").css('font-weight', cta_data.headline_fontweight);
                jQuery(".rp_ctaData_" + theId + "_headline").css('padding-top', cta_data.headline_margintop + 'px');
                jQuery(".rp_ctaData_" + theId + "_headline").css('padding-bottom', cta_data.headline_marginbottom + 'px');
                jQuery(".rp_ctaData_" + theId + "_subheadline").html(stripslashes_<?php echo $id; ?>(cta_data.subheadline));
                jQuery(".rp_ctaData_" + theId + "_subheadline").css('font-size', cta_data.subheadline_font_size + 'px');
                jQuery(".rp_ctaData_" + theId + "_subheadline").css('font-family', "'" + cta_data.subheadline_font + "'");
                jQuery(".rp_ctaData_" + theId + "_subheadline").css('text-align', cta_data.subheadline_align);
                jQuery(".rp_ctaData_" + theId + "_subheadline").css('color', cta_data.subheadline_color);
                jQuery(".rp_ctaData_" + theId + "_subheadline").css('font-weight', cta_data.subheadline_fontweight);
                jQuery(".rp_ctaData_" + theId + "_subheadline").css('padding-top', cta_data.subheadline_margintop + 'px');
                jQuery(".rp_ctaData_" + theId + "_subheadline").css('padding-bottom', cta_data.subheadline_marginbottom + 'px');
                jQuery(".rp_ctaData_" + theId + "_button").html(stripslashes_<?php echo $id; ?>(cta_data.button_text));
                jQuery(".rp_ctaData_" + theId + "_button").css('font-size', cta_data.button_font_size + 'px');
                jQuery(".rp_ctaData_" + theId + "_button").css('font-family', "'" + cta_data.button_font + "'");
                jQuery(".rp_ctaData_" + theId + "_button").css('color', cta_data.button_color);
                jQuery(".rp_ctaData_" + theId + "_button").css('background', cta_data.button_background_color);
                jQuery(".rp_ctaData_" + theId + "_button").css('border', 'solid 1px ' + cta_data.button_border_color);
                jQuery(".rp_ctaData_" + theId + "_button").css('font-weight', cta_data.button_fontweight);
                jQuery(".rp_ctaData_" + theId + "_button").css('margin-top', cta_data.button_margintop + 'px');
                jQuery(".rp_ctaData_" + theId + "_button").css('margin-bottom', cta_data.button_marginbottom + 'px');
                jQuery(".rp_ctaData_" + theId + "_button").css('width', cta_data.button_width + 'px');
                jQuery(".rp_ctaData_" + theId + "_button").css('height', cta_data.button_height + 'px');
                jQuery(".rp_ctaData_" + theId + "_button").css('line-height', cta_data.button_height + 'px');

                jQuery(".rp_ctaData_" + theId + "_button").click(function() {
                    window.open(
                      cta_data.button_url,
                      '_blank' // <- This is what makes it open in a new window.
                    );
                });
            }

            jQuery(".rp_ctaCounter_" + theId + "").text(cta_data.length);

            if (mpp_total_elements[theId][(mpp_current_element[theId] + 1)]) {
                jQuery("#rp_ctaCounterWrapper_" + theId).show();
            }
            else {
                jQuery("#rp_ctaCounterWrapper_" + theId).hide();
            }

            rp_ctaCount[theId] = 0;
            rp_ctaInt[theId] = setInterval(function() {
                if (rp_ctaCount[theId] >= cta_data.length) {
                    mpp_current_element[theId]++;
                    if (mpp_total_elements[theId][mpp_current_element[theId]]) {
                        if (mpp_total_elements[theId][mpp_current_element[theId]].type == "cta") {
                            displayCta(mpp_total_elements[theId][mpp_current_element[theId]].data, <?php echo $id; ?>);
                        }
                        else {
                            jQuery(".rp_video_" + theId + "Container").show();
                            jQuery(".rp_ctaData_" + theId).hide();
                            jQuery("#rp_playlist_" + theId + ">.rp_currentVideo").next().find("a span").click();
                            setTimeout(function() { setupVimeo(); }, 500);
                            setTimeout(function() { setupWistia(); }, 500);
                        }
                        clearInterval(rp_ctaInt[theId]);
                        rp_ctaInt[theId] = null;
                    }          
                }
                else {
                    var time_left = cta_data.length - rp_ctaCount[theId] - 1;
                    jQuery(".rp_ctaCounter_" + theId).text(time_left);
                }  
                rp_ctaCount[theId]++;
            }, 1000);
        }
    }

    function stripslashes_<?php echo $id; ?>(str) {
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