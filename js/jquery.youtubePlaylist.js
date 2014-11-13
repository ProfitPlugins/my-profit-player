inited = 0;

(function(e, t, n, r) {
    function o(e) {
        if (e.length === 8) {
            return false
        }

        return true
    }

    function u(e) {
        var t = null;
        if (e.indexOf("vim") !== -1) {
            var n = /vimeo.*\/(\d+)/i.exec(e);
            if (n) {
                t = n[1]
            }
        } else if (e.indexOf("yout") !== -1) {
            var r = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            var n = e.match(r);
            if (n && n[2].length == 11) {
                t = n[2]
            }
        } else if (e.indexOf("wistia") !== -1) {
            var exploded = e.split("/");
            t = exploded[(exploded.length - 1)];
        }
        return t
    }

    function a(t) {
        var n = t.link,
            r = t.url;

        e.ajax({
            url: r,
            dataType: "jsonp",
            success: function(e) {
                var t = e[0].title;
                var r = "by " + e[0].user_name;
                if (t.length > 50) {
                    n.find(".rp_title").html(t.substr(0, 50) + "â€¦")
                } else {
                    n.find(".rp_title").html(t)
                }
                n.find(".rp_author").html(r);
                n.find(".rp_thumbnail img").attr("src", e[0].thumbnail_small)
            }
        });
    }

    function f(t) {
        var n = t.link,
            r = t.url;

        e.ajax({
            url: r,
            dataType: "jsonp",
            success: function(e) {
                var t = e.entry["title"].$t;
                var r = "by " + e.entry["author"][0].name.$t;
                if (t.length > 50) {
                    n.find(".rp_title").html(t.substr(0, 50) + "â€¦")
                } else {
                    n.find(".rp_title").html(t)
                }
                n.find(".rp_author").html(r)
            }
        });
    }

    function l(t, n) {
        e.ajax({
            url: "https://www.googleapis.com/youtube/v3/channels?part=contentDetails&forUsername=" + t + "&key=AIzaSyCIlwa-7d7qpKS0Nj5vhI7tb-0minC-qZ8",
            dataType: "jsonp",
            success: function(e) {
                n(e.items[0].contentDetails.relatedPlaylists.uploads)
            }
        });
    }

    function c(t, n) {
        e.ajax({
            url: "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=50&playlistId=" + t + "&key=AIzaSyCIlwa-7d7qpKS0Nj5vhI7tb-0minC-qZ8",
            dataType: "jsonp",
            success: function(e) {
                n(e.items.reverse())
            }
        });
    }




    function h(t, n) {
        var r, i;
        for (var s = 0, o = t.length; s < o; s++) {
            r = t[s];
            i = r.snippet.resourceId.videoId;
            li = '<li><a href="https://www.youtube.com/watch?v=' + i + '"></a></li>';
            e(li).prependTo("#rp_playlist")
        }
        n();
    }

    function p(t, n) {
        e.ajax({
            url: "http://vimeo.com/api/v2/" + t + "/videos.json",
            dataType: "jsonp",
            success: function(e) {
                n(e.reverse())
            }
        })
    }

    function d(t, n) {
        var r, i;
        for (var s = 0, o = t.length; s < o; s++) {
            r = t[s];
            i = r.id;
            li = '<li><a href="https://www.vimeo.com/' + i + '"></a></li>';
            e(li).prependTo("#rp_playlist")
        }
        n()
    }

    function v(n, r) {
        this.element = n;
        this.options = e.extend({}, s, r);
        this._defaults = s;
        this._name = i;
        this._protocol = this.options.secure === "auto" ? t.location.protocol === "https:" ? "https://" : "http://" : this.options.secure ? "https://" : "http://";
        this.init()
    }

    var i = "youtubePlaylist";

    var s = {
        id: "test",
        autoPlay: false,
        allowFullScreen: true,
        deepLinks: true,
        onChange: function() {},
        start: 1,
        youtube: {
            autohide: "2",
            rel: "1",
            theme: "dark",
            color: "white",
            showinfo: "1",
            vq: "medium"
        },

        vimeo: {
            title: "1",
            byline: "1",
            portrait: "1",
            color: "ffffff"
        },
        holderId: "rp_video",
        secure: "auto"
    };

    v.prototype = {
        init: function() {
            var r = this;
            var i = r.options.deepLinks && t.location.hash.indexOf("#mpp_" + r.options.id + "video-") !== -1 ? t.location.hash : null;
            var s = function() {
                e(r.element).find("li:not(.mpp_this_is_done)").each(function(t) {
                    var n = e(this),
                        s = t + 1;

                    n.addClass('.mpp_this_is_done');

                    n.find("a:first").each(function() {
                        var t = e(this),
                            i = u(t.attr("href")),
                            l = n.text();
                        t.data("yt-href", t.attr("href"));

                        var the_href = t.attr("href");

                        t.attr("href", "#mpp_" + r.options.id + "video-" + s);
                        t.data("video-id", i);
                        t.data("the_href", the_href);
                        var c, h = "";

                        if (the_href.indexOf("vimeo") !== -1) {
                            a({
                                link: t,
                                url: r._protocol + "vimeo.com/api/v2/video/" + i + ".json"
                            })
                        } else {
                            f({
                                link: t,
                                url: r._protocol + "gdata.youtube.com/feeds/api/videos/" + i + "?v=2&alt=json"
                            });
                            h = r._protocol + "i.ytimg.com/vi/" + i + "/default.jpg"
                        }
                        c = '<span class="rp_thumbnail"><img src="' + h + '" alt="' + l + '" /></span><p class="rp_title"></p><p class="rp_author"></p>';
                        t.empty().html(c + l).attr("title", l);
                        if (!r.options.deepLinks) {
                            t.click(function(e) {
                                e.preventDefault();
                                r.handleClick(t, r.options);
                                r.options.onChange.call()
                            })
                        }
                    });

                    var l = e(n.children("a")[0]);
                    if (i) {
                        if (l.attr("href") === i) {
                            r.handleClick(l, r.options)
                        }
                    } else if (s === r.options.start) {
                        r.handleClick(l, r.options)
                    }
                });

                if (r.options.deepLinks) {
                    e(t).bind("hashchange", function(n) {
                        var i = t.location.hash;
                        var s = e(r.element).find('a[href="' + i + '"]');
                        if (s.length > 0) {
                            r.handleClick(s, r.options)
                        } else if (i === "") {
                            r.handleClick(e(r.element).find("a:first"), r.options)
                        }
                    })
                }

                var s = n.createElement("div"),
                    l = n.getElementsByTagName("base")[0] || n.getElementsByTagName("script")[0];
                s.innerHTML = "Â­<style> iframe { visibility: visible; } </style>";
                l.parentNode.insertBefore(s, l);
                t.onload = function() {
                    s.parentNode.removeChild(s)
                }
            };

            if (r.options.youtubeUsername && r.options.vimeoUsername) {
                l(r.options.youtubeUsername, function(e) {
                    c(e, function(e) {
                        h(e, function() {
                            p(r.options.vimeoUsername, function(e) {
                                d(e, s)
                            })
                        })
                    })
                })
            } else if (r.options.youtubeUsername) {
                l(r.options.youtubeUsername, function(e) {
                    c(e, function(e) {
                        h(e, s)
                    })
                })
            } else if (r.options.vimeoUsername) {
                p(r.options.vimeoUsername, function(e) {
                    d(e, s)
                })
            } else if (!r.options.youtubeUsername && !r.options.vimeoUsername) {
                s()
            }
        },

        getEmbedCode: function(e, t, the_href) {
            if (the_href.indexOf("vimeo") !== -1) {
                var embedCode = "";
                embedCode += "<iframe class='mpp_frame vimeoPlayer' id='mpp_iframe_" + e.id + "'";
                embedCode += ' src="' + this._protocol + "player.vimeo.com/video/" + t;
                embedCode += "?";
                embedCode += "&api=1";  
                embedCode += "&title=" + e.vimeo.title;
                embedCode += "&byline=" + e.vimeo.byline;
                embedCode += "&portrait=" + e.vimeo.portrait;
                embedCode += "&color=" + e.vimeo.color;
                embedCode += "&api=1";  
                embedCode += "&player_id=mpp_iframe_" + e.id;
                embedCode += '" ';
                if (e.allowFullScreen) {
                    embedCode += " webkitAllowFullScreen mozallowfullscreen allowFullScreen "
                }
                embedCode += ' autoPlayMe="' + (e.autoPlay ? "yes" : "no") + '" ';
                embedCode += ' type="text/html" frameborder="0" ></iframe>'
            }
            else if (the_href.indexOf("wistia") !== -1) {
                var embedCode = "";
                embedCode += "<iframe class='mpp_frame wistia_embed' id='mpp_iframe_" + e.id + "'";
                embedCode += ' src="' + this._protocol + 'fast.wistia.net/embed/iframe/' + t + '?';
                embedCode += ((e.youtube.controls == 1) ? "controlsVisibleOnLoad=true" : "controlsVisibleOnLoad=false");
                embedCode += '&playerColor=688AAD&version=v1&videoHeight=360&videoWidth=640&wmode=transparent" ';
                embedCode += ' autoPlayMe="' + (e.autoPlay ? "yes" : "no") + '" ';
                embedCode += ' type="text/html" frameborder="0" ></iframe>'
            } else {
                var embedCode = "";
                embedCode += "<iframe class='mpp_frame' id='mpp_iframe_" + e.id + "'";
                embedCode += ' src="' + this._protocol + "www.youtube.com/embed/" + t;
                embedCode += "?";
                embedCode += e.autoPlay ? "autoplay=1" : "autoplay=0";
                embedCode += "&enablejsapi=1";
                embedCode += "&autohide=" + e.youtube.autohide;
                embedCode += "&rel=0";
                embedCode += "&theme=" + e.youtube.theme;
                embedCode += "&controls=" + e.youtube.controls;
                embedCode += "&showinfo=" + e.youtube.showinfo;
                embedCode += "&vq=" + e.youtube.vq;
                embedCode += '" ';
                if (e.allowFullScreen) {
                    embedCode += " webkitAllowFullScreen mozallowfullscreen allowFullScreen "
                }
                embedCode += ' frameborder="0" ></iframe>'
            }
            return embedCode
        },

        handleClick: function(e, t) {
            t.onChange.call();
            return this.handleVideoClick(e, t)
        },

        handleVideoClick: function(t, n) {
            var r = this;
            console.log(r);
            var i = n.holder ? n.holder : e("." + n.holderId);
            console.log(r.options.id);
            if(mpp_video_called[r.options.id] >=1)
            {
                r.options.autoPlay = 1;
            }
            mpp_video_called[r.options.id]++;
            i.html(r.getEmbedCode(r.options, t.data("video-id"), t.data("the_href")));
            t.parent().parent("ul").find("li.rp_currentVideo").removeClass("rp_currentVideo");
            t.parent("li").addClass("rp_currentVideo");

            if(inited ==1)
            {
                YT_ready(function() {
                    t.parents("div.rp_plugin").find("iframe").each(function() {
                        var identifier = this.id;
                        //var identifier = "test";
                        var frameID = getFrameID(identifier);
                        console.log(identifier);
                        var theId = identifier.replace("mpp_iframe_", "");

                        if (frameID) { //If the frame exists
                            yt_players[frameID] = new YT.Player(frameID, {
                                events: {
                                    "onStateChange": function(newState) {
                                        if (newState.data == 0) {
                                            processFinishedVideo(theId);
                                        }
                                    }
                                }
                            });
                        }
                    });
                });
            }
            return false
        }
    };

    e.fn[i] = function(t) {
        return this.each(function() {
            if (!e.data(this, "plugin_" + i)) {
                e.data(this, "plugin_" + i, new v(this, t))
            }
        })
    }



})(jQuery, window, document)

function getFrameID(id) {
    var elem = document.getElementById(id);
    if (elem) {
        if (/^iframe$/i.test(elem.tagName)) return id; //Frame, OK
        // else: Look for frame
        var elems = elem.getElementsByTagName("iframe");
        if (!elems.length) return null; //No iframe found, FAILURE
        for (var i = 0; i < elems.length; i++) {
            if (/^https?:\/\/(?:www\.)?youtube(?:-nocookie)?\.com(\/|$)/i.test(elems[i].src)) break;
        }
        elem = elems[i]; //The only, or the best iFrame
        if (elem.id) return elem.id; //Existing ID, return it
        // else: Create a new ID
        do { //Keep postfixing `-frame` until the ID is unique
            id += "-frame";
        } while (document.getElementById(id));
        elem.id = id;
        return id;
    }
    // If no element, return null.
    return null;
}

// Define YT_ready function.
var YT_ready = (function() {
    var onReady_funcs = [],
    api_isReady = false;

    return function(func, b_before) {
        if (func === true) {
            api_isReady = true;
            for (var i = 0; i < onReady_funcs.length; i++) {
                // Removes the first func from the array, and execute func
                onReady_funcs.shift()();
            }
        }
        else if (typeof func == "function") {
            if (api_isReady) func();
            else onReady_funcs[b_before ? "unshift" : "push"](func);
        }
    }
})();
// This function will be called when the API is fully loaded


function onYouTubePlayerAPIReady() {
    YT_ready(true);
    inited = 1;
}

//Define a player storage object, to enable later function calls,
//  without having to create a new class instance again.



YT_ready(function() {
    jQuery("iframe").each(function() {
        var identifier = this.id;
        var theId = identifier.replace("mpp_iframe_", "");
        //var identifier = "test_" + this.id;
        var frameID = getFrameID(identifier);

        console.log(identifier);
        if (frameID) { //If the frame exists
            yt_players[frameID] = new YT.Player(frameID, {
                events: {
                    "onStateChange": function(newState) {

                                        if (newState.data == 0) {
                                            processFinishedVideo(theId);
                                        }
                                    }
                }
            });
        }
    });
});

var mpp_vimeo_int;
jQuery(document).ready(function() {
    mpp_vimeo_int = setInterval(function() {
        if (jQuery("iframe.mpp_frame").length > 0) {
            setupVimeo();
            setupWistia();
            clearInterval(mpp_vimeo_int);
            mpp_vimeo_int = null;
        }
    }, 1000);
});

function setupVimeo() {
    var vimeoPlayers = document.querySelectorAll('iframe'),
        player;

    for (var i = 0, length = vimeoPlayers.length; i < length; i++) {
        if (!jQuery(vimeoPlayers[i]).hasClass("vimeoPlayer")) continue;
        if (jQuery(vimeoPlayers[i]).attr("vimeo-binded")) continue;

        player = vimeoPlayers[i];
        var fPlayer =  $f(player);
        fPlayer.addEvent('ready', ready);
        
        jQuery(vimeoPlayers[i]).attr("vimeo-binded", 'yes');
    }

    function ready(player_id) {
        var container = document.getElementById(player_id).parentNode.parentNode;
        vimeo_players[player_id] = $f(player_id);

        if (jQuery(vimeoPlayers[i]).attr("autoPlayMe") == "yes") {
            vimeo_players[player_id].api('play');
        }

        vimeo_players[player_id].addEvent('finish', function(data) {
            processFinishedVideo(data.replace("mpp_iframe_", ""));
            vimeo_players[player_id] = null;
        });
    }
}

function setupWistia() {
    wistiaBindIframes();

    var wistiaPlayers = document.querySelectorAll('iframe');

    for (var i = 0, length = wistiaPlayers.length; i < length; i++) {
        if (!wistiaPlayers[i].wistiaApi) continue;
        if (jQuery(wistiaPlayers[i]).attr("wistia-binded")) continue;

        if (jQuery(wistiaPlayers[i]).attr("autoPlayMe") == "yes") {
            wistiaPlayers[i].wistiaApi.play();
        }

        var theId = wistiaPlayers[i].id.replace("mpp_iframe_", "");

        wistiaPlayers[i].wistiaApi.bind("end", function() {
            processFinishedVideo(this.uuid.replace("mpp_iframe_", ""));
        });

        jQuery(wistiaPlayers[i]).attr("wistia-binded", 'yes');
    }
}

function processFinishedVideo(theId) {
    mpp_current_element[theId]++;

    if (mpp_total_elements[theId][mpp_current_element[theId]].type == "cta") {
        displayCta(mpp_total_elements[theId][mpp_current_element[theId]].data, theId);
    }
    else {
        jQuery("#rp_playlist_" + theId + ">.rp_currentVideo").next().find("a span").click();
    }

    setTimeout(function() { setupVimeo(); }, 500);
    setTimeout(function() { setupWistia(); }, 500);
}

/*
 // Returns a function to enable multiple events
 function createYTEvent(frameID, identifier) {
 return function (event) {
 var player = players[frameID]; // player object
 var the_div = $('#'+identifier).parent();
 the_div.children('.thumb').click(function() {
 var $this = $(this);
 $this.fadeOut().next().addClass('play');
 if ($this.next().hasClass('play')) {
 player.playVideo();
 }
 });
 }
 }*/
// Load YouTube Frame API

(function(){ //Closure, to not leak to the scope
    var s = document.createElement("script");
    s.src = "http://www.youtube.com/player_api"; /* Load Player API*/
    var before = document.getElementsByTagName("script")[0];
    before.parentNode.insertBefore(s, before);
})();