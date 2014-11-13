jQuery(document).ready(function() {
    var new_id = 20;
    jQuery(".plp_insert").click(function(e) {
        e.preventDefault();
        var currentString = "[my_profit_player ";
        currentString += "width=" + jQuery("#width").val();
        currentString += " theme=" + jQuery("#theme").val();
        currentString += " color=" + jQuery("#color").val();
        currentString += " showinfo=" + jQuery("#showinfo").val();
        currentString += " autoplay=" + jQuery("#autoplay").val();
        currentString += " controls=" + jQuery("#controls").val();
        currentString += " autohide=" + jQuery("#autohide").val();
        currentString += " social_buttons=" + jQuery("#social_buttons").val();
        currentString += "]";
        jQuery("#m1 li").each(function(index) {
            currentString += jQuery(this).attr("data-type") + ":" + jQuery(this).attr("data-id") + ", \n\            \            ";
        });
        currentString += "[/my_profit_player]";
        tinyMCEPopup.execCommand("mceReplaceContent", false, currentString);
        tinyMCEPopup.close()
    });
    jQuery('#button-url').click(function(e) {
        e.preventDefault();
        var url = jQuery("#button-value").val();
        var id = "";
        if (url != "") {
            if (url.search("youtube") != -1) {
                var int = url.split("watch?v=");
                id = int[1];
            } else if (url.search("vimeo") != -1) {
                var int = url.split("vimeo.com/");
                id = int[1];
            } else if (url.search("wistia") != -1) {
                var exploded = url.split("/");
                id = exploded[(exploded.length - 1)];
            }
        }
        if (id != "") {
            var $li = jQuery("<li class='ui-state-default' data-type='video' data-id='" + url + "'/>").text(id);
            jQuery(".ui-droppable").append($li);
            jQuery(".ui-droppable").sortable("refresh");
        }
    });
    jQuery(".draggable").draggable({
        cursor: 'move',
        revert: 'invalid',
        helper: function() {
            var cloned = jQuery(this).clone();
            cloned.attr('id', (++new_id).toString());
            return cloned;
        },
        distance: 20
    });
    jQuery(".droppable").droppable({
        hoverClass: 'ui-state-active',
        tolerance: 'pointer',
        out: function(event, ui) {
            var self = ui;
            ui.helper.off('mouseup').on('mouseup', function() {
                jQuery(this).remove();
            });
        },
        accept: function(event, ui) {
            return true;
        },
        drop: function(event, ui) {
            var obj;
            if (jQuery(ui.helper).hasClass('draggable')) {
                obj = jQuery(ui.helper).clone();
                obj.removeClass('draggable').addClass('editable').removeAttr('style');
                jQuery(this).append(obj);
            }
        }
    }).sortable({
        revert: false
    });
    jQuery(".updateMenus").click(function(e) {
        e.preventDefault();
        jQuery(".droppable").each(function(index) {
            var id = "f" + jQuery(this).prop("id");
            pagesList = "";
            jQuery(this).find(".ui-draggable").each(function(index) {
                if (pagesList == "") {
                    pagesList += jQuery(this).attr("data-type") + ":" + jQuery(this).attr("data-id");
                } else {
                    pagesList += "," + jQuery(this).attr("data-type") + ":" + jQuery(this).attr("data-id");
                }
            });
            jQuery("#" + id).val(pagesList);
        });
        jQuery("#menuForm").submit();
    });
});