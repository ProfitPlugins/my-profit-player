(function(e) {
    var t = "1.0.4";
    e(function() {
        tinymce.create("tinymce.plugins.plp_plugin", {
            init: function(n, r) {
                function i() {
                    var e = tinymce.activeEditor.dom.select(".fasc-button");
                    var t = false;
                    jQuery(e).each(function() {
                        if (jQuery(this).is("[data-fasc-style]")) {
                            var e = jQuery(this).attr("data-fasc-style").replace(/\s+/, "");
                            var r = "";
                            if (jQuery(this).is("[style]")) {
                                r = jQuery(this).attr("style").replace(/\s+/, "")
                            }
                            if (e != r) {
                                jQuery(this).attr("style", jQuery(this).attr("data-fasc-style"));
                                n.nodeChanged();
                                t = true
                            }
                        }
                    });
                    if (t == true) {
                        n.undoManager.removeLevel()
                    }
                }

                function s() {
                    var t = tinymce.activeEditor.dom.select(".fasc-button");
                    jQuery(t).each(function() {
                        if (jQuery(this).is("[data-fasc-style]")) {
                            var t = tinymce.activeEditor.dom.parseStyle(jQuery(this).attr("data-fasc-style"));
                            var n = tinymce.activeEditor.dom.parseStyle(jQuery(this).attr("style"));
                            if (e(t).not(n).length == 0 && e(n).not(t).length == 0) {} else {}
                        }
                    })
                }
                var o = n;
                var u = false;
                var a = {};
                var f = 520;
                var l = 720;

                n.addButton("plp_plugin", {
                    icon: "icon mpp-own-icon",
                    tooltip: "Playlist",
                    onclick: function() {

                        n.windowManager.open({
                            url: r + "/../popup/popup.php?ver=" + t + "&source=insert",
                            width: l,
                            height: f,
                            title: "My Profit Player"
                        }, {
                            plugin_url: r
                        })
                    }
                });
                n.on("change", function(e) {});
                n.on("PastePostProcess", function() {
                    i()
                });
                n.onInit.add(function(e) {
                    e.undoManager.onAdd.add(function(e, t) {});
                    e.undoManager.removeLevel = function() {
                        if (this.data.length > 1) {
                            this.data.splice(this.data.length - 1, 1)
                        }
                    }
                });
                n.on("undo", function(e, t) {
                    s()
                });
                n.on("redo", function(e) {});
                n.on("dblClick", function(e) {
                    if (jQuery(e.target).hasClass("fasc-button")) {
                        n.selection.select(e.toElement);
                        n.windowManager.open({
                            url: r + "/popup.php?ver=" + t + "&source=click",
                            width: l,
                            height: f
                        }, {
                            plugin_url: r,
                            target: jQuery(e.target)
                        })
                    }
                });
                n.on("click", function(e, t) {});
                n.on("keyDown", function(e, t) {})
            },
            createControl: function(e, t) {
                return null
            },
            getInfo: function() {
                return {
                    longname: "My Profit Player",
                    author: "Sorin Nunca",
                    authorurl: "",
                    infourl: "",
                    version: "1.0.0"
                }
            }
        });
        tinymce.PluginManager.add("plp_plugin", tinymce.plugins.plp_plugin)
    })
})(jQuery)