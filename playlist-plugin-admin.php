<?php



class playlistPluginAdmin

{

    function __construct()

    {

        add_action("admin_menu", array($this, "admin_menu"));





        add_action("admin_enqueue_scripts", array($this, "admin_load_scripts"));



        add_action("wp_ajax_plp_update_videos", array($this, "update_videos"));



        add_action("wp_ajax_plp_delete_video", array($this, "delete_video"));



        add_action("wp_ajax_plp_delete_cta", array($this, "delete_cta"));

    }





    public function delete_video()

    {

        $video_id = $_POST['video_id'];

        $videos = json_decode(get_option(PLP_VIDEOS), true);

        $videos[$video_id] = array();

        update_option(PLP_VIDEOS, json_encode($videos));

        die();

    }



    public function delete_cta()

    {

        $cta_id = $_POST['cta_id'];

        $ctas = json_decode(get_option(PLP_CALL_TO_ACTIONS), true);



        $ctas[$cta_id] = array();

        update_option(PLP_CALL_TO_ACTIONS, json_encode($ctas));

        die();

    }



    public function update_videos()

    {

        $do = $_POST['what'];

        $videos = json_decode(get_option(PLP_VIDEOS), true);

        $video_id = $_POST['video_id'];
        $video_name = $_POST['video_name'];
        $video_url = $_POST['video_url'];

        $videos[$video_id] = array(
            "name" => $video_name,
            "url" => $video_url
        );

        update_option(PLP_VIDEOS, json_encode($videos));

        die();

    }



    public function admin_load_scripts()

    {

        wp_register_script("plp_jsColor", PLP_URL.'js/jscolor.js?time='.time());

        wp_enqueue_script("plp_jsColor");



        wp_register_script("plp_jeditable", PLP_URL.'js/jquery.jeditable.js?time='.time(), array("jquery"));

        wp_enqueue_script("plp_jeditable");



        wp_register_script("plp_editinplace", PLP_URL.'js/editinplace.js?time='.time(), array("plp_jeditable"));

        wp_enqueue_script("plp_editinplace");



        wp_register_style("plp_admin", PLP_URL.'css/admin.css?time='.time());

        wp_enqueue_style("plp_admin");



    }

    public function admin_menu()

    {

        if(get_option(PLP_LICENSE_STATUS) == "valid") {

            add_menu_page(PLP_NAME, PLP_NAME, "manage_options", PLP_SLUG, array($this, "admin_page_content"));

        }

    }

    public function admin_page_content()

    {
        global $upload_dir;
        $view_data = array();



        if($_POST['submit'])

        {



            if(!empty($_POST['video_id']) && !empty($_POST['video_url']))

            {

                $video_id = $_POST['video_id'];

                $video_url = $_POST['video_url'];



                //if(strpos($video_url, "youtube")===FALSE && strpos($video_url, "vimeo") ===FALSE)
                if(strpos($video_url, "youtube")===FALSE && strpos($video_url, "vimeo") ===FALSE && strpos($video_url, "wistia") ===FALSE)

                {

                    //echo '<div class="error" style="width:99%; padding: 5px;"><p>We support Youtube and Vimeo links at the moment.</p></div>';
                    echo '<div class="error" style="width:99%; padding: 5px;"><p>We support Youtube links at the moment.</p></div>';

                }

                else

                {

                    // check if the video_id is unique

                    $videos = json_decode(get_option(PLP_VIDEOS), true);

                    $videos[] = array(
                        "name" => $video_id,
                        "url" => $video_url
                    );

                    update_option(PLP_VIDEOS, json_encode($videos));

                    echo '<div class="updated" style="width:99%; padding: 5px;"><p>Video Stored!</p></div>';



                }



            }

            else

            {

                echo '<div class="error" style="width:99%; padding: 5px;"><p>You must fill in the fields.</p></div>';

            }





        }



        if($_POST['submit2'])

        {

            if ($_POST['cta_type'] == "image") {

                $cta = array(

                    "name" => $_POST['cta_name'],

                    "image_url" => $_POST['cta_image_url'],

                    "background" => ""



                );


                if (!empty($_REQUEST['cta_image_file']))
                { 
                    $file = $_REQUEST['cta_image_file'];
                    $cta['background'] = $file;
                }

            }

            else {

                $cta = array(

                    "name" => $_POST['cta_name'],

                    "headline" => $_POST['cta_headline'],

                    "headline_font_size" => $_POST['cta_headline_font_size'],

                    "headline_font" => $_POST['cta_headline_font'],

                    "headline_color" => $_POST['cta_headline_color'],

                    "headline_align" => $_POST['cta_headline_align'],

                    "headline_fontweight" => $_POST['cta_headline_fontweight'],

                    "headline_margintop" => $_POST['cta_headline_margintop'],

                    "headline_marginbottom" => $_POST['cta_headline_marginbottom'],

                    "subheadline" => $_POST['cta_subheadline'],

                    "subheadline_font_size" => $_POST['cta_subheadline_font_size'],

                    "subheadline_font" => $_POST['cta_subheadline_font'],

                    "subheadline_color" => $_POST['cta_subheadline_color'],

                    "subheadline_align" => $_POST['cta_subheadline_align'],

                    "subheadline_fontweight" => $_POST['cta_subheadline_fontweight'],

                    "subheadline_margintop" => $_POST['cta_subheadline_margintop'],

                    "subheadline_marginbottom" => $_POST['cta_subheadline_marginbottom']

                );



                if ($_POST['cta_background_type'] == "color") {

                    $cta['background'] = array(

                        'type' => 'color',

                        'value' => $_POST['cta_background_color']

                    );

                }

                else {

                    $file = PLP_PATH.'/uploads/'.str_replace(" ", "_", basename($_FILES['background_image']['name'])); 

                    if (!empty($_REQUEST['background_image']))
                    { 
                        $filename = $_REQUEST['background_image'];
                    }

                    else {

                        if ($_POST['cta_id'] != "") {

                            $ctas = json_decode(get_option(PLP_CALL_TO_ACTIONS), true);

                            $cta['background'] = $ctas[$_POST['cta_id']]['background'];

                        }

                    }

                }



                $cta['button_text'] = $_POST['cta_button_text'];

                $cta['button_url'] = $_POST['cta_button_url'];

                $cta['button_font_size'] = $_POST['cta_button_font_size'];

                $cta['button_font'] = $_POST['cta_button_font'];

                $cta['button_color'] = $_POST['cta_button_color'];

                $cta['button_fontweight'] = $_POST['cta_button_fontweight'];

                $cta['button_margintop'] = $_POST['cta_button_margintop'];

                $cta['button_marginbottom'] = $_POST['cta_button_marginbottom'];

                $cta['button_width'] = $_POST['cta_button_width'];

                $cta['button_height'] = $_POST['cta_button_height'];



                $cta['button_background_color'] = $_POST['cta_button_bg_color'];

                $cta['button_border_color'] = $_POST['cta_button_border_color'];

            }



            $cta['length'] = $_POST['cta_length'];



            if (empty($cta['headline']) && false) {

                echo '<div class="error" style="width:99%; padding: 5px;"><p>Please add headline.</p></div>';

            }

            elseif (empty($cta['subheadline']) && false) {

                echo '<div class="error" style="width:99%; padding: 5px;"><p>Please add sub headline.</p></div>';

            }

            elseif (empty($cta['background']['value']) && false) {

                echo '<div class="error" style="width:99%; padding: 5px;"><p>Please add background.</p></div>';

            }

            elseif (empty($cta['button_text']) && false) {

                echo '<div class="error" style="width:99%; padding: 5px;"><p>Please add button text.</p></div>';

            }

            else {

                if ($_POST['cta_id'] == "") {

                    $ctas = json_decode(get_option(PLP_CALL_TO_ACTIONS), true);



                    $ctas[] = $cta;

                    update_option(PLP_CALL_TO_ACTIONS, json_encode($ctas));



                    echo '<div class="updated" style="width:99%; padding: 5px;"><p>Call to action Stored!</p></div>';

                }

                else {

                    $ctas = json_decode(get_option(PLP_CALL_TO_ACTIONS), true);



                    $ctas[$_POST['cta_id']] = $cta;

                    update_option(PLP_CALL_TO_ACTIONS, json_encode($ctas));



                    echo '<div class="updated" style="width:99%; padding: 5px;"><p>Call to action details Saved!</p></div>';                    

                }

            }

        }



        if($_POST['default_submit'])

        {

            $data = $_POST;

            update_option(PLP_DEFAULT, $_POST);





            echo '<div class="updated" style="width:99%; padding: 5px;"><p>Default settings updated!</p></div>';

        }

        $view_data['videos'] = json_decode(get_option(PLP_VIDEOS), true);

        $view_data['ctas'] =  json_decode(get_option(PLP_CALL_TO_ACTIONS), true);

        $view_data['default'] = get_option(PLP_DEFAULT);

        $view_data['google_fonts'] = json_decode(get_option(PLP_GOOGLE_FONTS), true);



        echo plp_load_view("admin/dashboard", $view_data);



    }

}