jQuery(document).ready(function(){
    jQuery('.plp_edit').editable(function(old_value, value, settings) {

        var video_id = jQuery(this).parent().parent().find(".video_id").html();

        if(jQuery(this).hasClass("video_name"))
        {
            var video_name = value;
        }
        else {
            var video_name = jQuery(this).parent().parent().find(".video_name").text();
        }

        if(jQuery(this).hasClass("video_url"))
        {
            var video_url = value;
        }
        else {
            var video_url = jQuery(this).parent().parent().find(".video_url").text();
        }

        jQuery.post(ajaxurl, {action:"plp_update_videos", video_id: video_id, video_name:video_name, video_url:video_url}, function(re){
        });

        return(value);
    }, {
        submit  : 'OK'
    });

    jQuery(".delete_confirm").click(function(e){
        e.preventDefault();



        if(confirm("Are you sure?"))
        {
            jQuery.post(ajaxurl, {action:"plp_delete_video", video_id: jQuery(this).attr("video-id")}, function(ev){

            });

            jQuery(this).parent().parent().fadeOut();
        }
    });

    jQuery(".delete_cta_confirm").click(function(e){
        e.preventDefault();



        if(confirm("Are you sure?"))
        {
            jQuery.post(ajaxurl, {action:"plp_delete_cta", cta_id: jQuery(this).attr("cta-id")}, function(ev){

            });

            jQuery(this).parent().parent().fadeOut();
        }
    });

})

