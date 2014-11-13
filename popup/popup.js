function getButton() {



    var e = jQuery("#button-dialog input#button-url").val();



    var t = jQuery("#button-dialog input#button-text").val();



    var n = jQuery("#button-dialog select#button-size").val();



    var r = jQuery("#button-dialog input#button-color").val();



    var i = jQuery("#button-dialog input#text-color").val();



    var s = jQuery("#button-dialog select#button-type").val();



    var o = jQuery("#button-dialog select#button-align").val();



    var u = jQuery("#button-dialog input#new-window").prop("checked");



    var a = "";



    var f = "";



    var l = "";



    var c = "";



    var h = "";



    var p = "";



    var d = "";



    if (u == true) {



        p = ' target="_blank"'



    }



    if (s) {



        if (s != "") {



            l = " " + s



        }



    }



    if (n) {



        if (n != "") {



            c = " " + n



        }



    }



    var v = $($("#tab-2-content .ico-grid div.active").get(0));



    var m = "";



    var g = "";



    if (v.length == 1) {



        var y = v.attr("class").split(" ");



        var b = 0;



        var w = "dashicons";



        for (b = 0; b < y.length; b++) {



            if (y[b] != "active" && y[b] != "fa" && y[b] != "dashicons") {



                m += " " + y[b]



            }



            if (y[b] == "fa") {



                w = "fontawesome"



            }



        }



        if (b > 0) {



            if (w == "fontawesome") {



                m = " ico-fa fasc-ico-before" + m



            } else {



                m = " fasc-ico-before" + m



            }



        }



    }



    var E = '<a href="' + e + '" class="fasc-button' + c + l + m + '"' + p + ' style="background-color:' + r + ";color:" + i + ';" data-fasc-style="background-color:' + r + ";color:" + i + ';">' + t + "</a>";



    return E



}







function rgb2hex(e) {



    if (e.search("rgb") == -1) {



        return e



    } else {



        e = e.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+))?\)$/);







        function t(e) {



            return ("0" + parseInt(e).toString(16)).slice(-2)



        }



        return "#" + t(e[1]) + t(e[2]) + t(e[3])



    }



}



var $currentNode = null;



(function(e) {



    e(function() {



        e("#tab-header a").click(function() {



            $this = e(this);



            var t = $this.attr("href");



            $this.parent().parent().find("li").removeClass("active");



            $this.parent().addClass("active");



            e("#button-dialog .fasc-tab-content").hide();



            e("#button-dialog " + t).show();



            if (e(".ico-grid .grid-container div.active").length > 0) {



                e(".ico-grid").scrollTop(e(".ico-grid .grid-container div.active").position().top - 5)



            }



            return false



        });



        e("#tab-2-content #icon-type-select").change(function(t) {



            e("#tab-2-content .ico-grid .grid-container").removeClass("ico-screen-active");



            e("#tab-2-content #" + e(this).val()).addClass("ico-screen-active")



        });



        e("#tab-2-content .ico-grid div").click(function(t) {



            t.preventDefault();



            e("#tab-2-content .ico-grid div").removeClass("active");



            e(this).addClass("active");



            $previewButton.html(getButton());



            e("#tab-2-content .fasc-ico-position").removeAttr("checked");



            e('#tab-2-content .fasc-ico-position[value="before"]').prop("checked", true);



            return false



        });



        e("#tab-2-content .fasc-ico-position").change(function(t) {



            if (e(this).val() == "none") {



                e("#tab-2-content .ico-grid div div:not(.clear)").removeClass("active")



            } else if (e(this).val() == "before") {



                var n = e("#tab-2-content .ico-grid div.active");



                if (n.length == 1) {} else {



                    e(e("#tab-2-content .ico-grid div.ico-screen-active div:not(.clear)").get(0)).addClass("active")



                }



            }



            $previewButton.html(getButton())



        });



        $previewButton = jQuery(".preview-button-area .centered-button");



        e('#button-dialog select, #button-dialog input[type="checkbox"]').change(function() {



            $previewButton.html(getButton())



        });



        e('#button-dialog input[type="text"]').keyup(function() {



            $previewButton.html(getButton())



        });



        e('#button-dialog input[type="text"]').keyup(function() {



            $previewButton.html(getButton())



        });



        $previewButton.html(getButton())



    })



})(window.jQuery);



var ButtonDialog = {



    local_ed: "ed",



    init: function(e) {



        ButtonDialog.local_ed = e;



        tinyMCEPopup.resizeToInnerSize();



        var t = top.tinymce.activeEditor.windowManager.getParams();



        $currentNode = t.target;



        $("#tab-2-content .ico-grid .grid-container").removeClass("ico-screen-active");



        $("#tab-2-content #" + $("#tab-2-content #icon-type-select").val()).addClass("ico-screen-active");



        if (source == "click") {



            var n = "";



            var r = $currentNode.attr("href");



            jQuery("#button-dialog input#button-url").val(r);



            var i = $currentNode.attr("target");



            if (typeof i != "undefined") {



                if (i == "_blank") {



                    jQuery("#button-dialog input#new-window").prop("checked", true)



                }



            }



            var s = $currentNode.text();



            jQuery("#button-dialog input#button-text").val(s);



            var o = rgb2hex($currentNode.css("color"));



            jQuery("#text-color").val(o);



            var u = rgb2hex($currentNode.css("background-color"));



            jQuery("#button-color").val(u);



            var a = $currentNode.attr("class").split(/\s+/);



            for (var f = 0; f < a.length; f++) {



                if (a[f].substring(0, 9) == "fasc-type") {



                    var l = a[f];



                    if ($currentNode.hasClass("fasc-rounded-medium") || $currentNode.hasClass("rounded")) {



                        l = l + " " + "fasc-rounded-medium"



                    }



                    jQuery("#button-type option").removeAttr("selected");



                    jQuery('#button-type option[value="' + l + '"]').attr("selected", "selected");



                    $("#button-type").val(l)



                } else if (a[f].substring(0, 9) == "fasc-size") {



                    var c = a[f];



                    jQuery("#button-size option").removeAttr("selected");



                    jQuery('#button-size option[value="' + c + '"]').attr("selected", "selected");



                    $("#button-size").val(c)



                } else if (a[f].substring(0, 9) == "dashicons") {



                    $("#tab-2-content .ico-grid .grid-container").removeClass("ico-screen-active");



                    $("#tab-2-content #dashicons-grid").addClass("ico-screen-active");



                    $("#icon-type-select").val("dashicons-grid");



                    var h = a[f];



                    $(".ico-grid ." + h).addClass("active");



                    $('#tab-2-content .fasc-ico-position[value="before"]').attr("checked", "checked")



                } else if (a[f].substring(0, 3) == "fa-") {



                    $("#tab-2-content .ico-grid .grid-container").removeClass("ico-screen-active");



                    $button = $("#tab-2-content .ico-grid").find("." + a[f]);



                    var p = $button.parent().attr("id");



                    var d = $("#tab-2-content #" + p);



                    d.addClass("ico-screen-active");



                    $("#icon-type-select").val(p);



                    $(".ico-grid ." + a[f]).addClass("active");



                    $('#tab-2-content .fasc-ico-position[value="before"]').attr("checked", "checked")



                }



            }



        } else {



            var s = e.selection.getContent();



            jQuery("#button-dialog input#button-text").val(s)



        }



        $previewButton = jQuery(".preview-button-area .centered-button");



        $previewButton.html(getButton());



        /*$("#button-color, #text-color").minicolors({



            position: "top left",



            change: function(e, t) {



                $previewButton.html(getButton())



            }



        });*/



    },



    insert: function(t) {



        if (source == "click") {



            var n = t.selection.getNode();



            t.selection.select(n)



        }



        tinyMCEPopup.execCommand("mceReplaceContent", false, getButton());



        tinyMCEPopup.close()



    }



};



tinyMCEPopup.onInit.add(ButtonDialog.init, ButtonDialog)