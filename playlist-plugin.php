<?php



/*

Plugin Name: My Profit Player

Plugin URI: http://MyProfitPlayer.com

Description: My Profit Player turns every video on your website into a Money Machine!

Version: 1.0.1

Author: ProfitPlugins.com

Author URI: http://ProfitPlugins.com

*/

define("PLP_NAME", "My Profit Player");

define("PLP_VERSION", '1.0.1');

define("PLP_SLUG", "plp_admin");

define("PLP_IMAGES_URL", plugins_url('images', __FILE__).'/');

define("PLP_UPLOADS_URL", plugins_url('uploads', __FILE__).'/');

define("PLP_URL", plugin_dir_url(__FILE__));

define("PLP_PATH", plugin_dir_path(__FILE__));

$upload_dir = wp_upload_dir();


define("PLP_VIDEOS", "plp_mpp_videos");

define("PLP_CALL_TO_ACTIONS", "plp_ctas");

define("PLP_DEFAULT", "plp_default");

define("PLP_GOOGLE_FONTS", "plp_google_fonts");



include "helper-functions.php";

include 'libraries/licensing/config.php';



@mkdir ($upload_dir['path'].'/mpp/',0777,true);

@chmod ($upload_dir['path'].'/mpp/',0777);



register_deactivation_hook(__FILE__, array("playlistPlugin", "deactivate"));

$update_data = array();

class playlistPlugin

{

    public function __construct()

    {

        add_shortcode("my_profit_player", array($this, "shortcode"));

        add_action("wp_enqueue_scripts", array($this, "load_scripts"));



        add_action("admin_init", array($this, "init_options"));



        add_action('init', array($this,'editor'));



        add_action("admin_init", array($this, "licensingInit"));



        $ctas = get_option(PLP_CALL_TO_ACTIONS);



        if (empty($ctas)) {

            add_option(PLP_CALL_TO_ACTIONS, json_encode(array()));

        }

        $videos = get_option(PLP_VIDEOS);

        if (empty($videos)) {

            add_option(PLP_VIDEOS, json_encode(array()));

        }



        $google_fonts = get_option(PLP_GOOGLE_FONTS);



        if (empty($google_fonts)) {

            $google_fonts = "ABeeZee

                Abel

                Abril Fatface

                Aclonica

                Acme

                Actor

                Adamina

                Advent Pro

                Aguafina Script

                Akronim

                Aladin

                Aldrich

                Alef

                Alegreya

                Alegreya Sans

                Alegreya Sans SC

                Alegreya SC

                Alex Brush

                Alfa Slab One

                Alice

                Alike

                Alike Angular

                Allan

                Allerta

                Allerta Stencil

                Allura

                Almendra

                Almendra Display

                Almendra SC

                Amarante

                Amaranth

                Amatic SC

                Amethysta

                Anaheim

                Andada

                Andika

                Angkor

                Annie Use Your Telescope

                Anonymous Pro

                Antic

                Antic Didone

                Antic Slab

                Anton

                Arapey

                Arbutus

                Arbutus Slab

                Architects Daughter

                Archivo Black

                Archivo Narrow

                Arimo

                Arizonia

                Armata

                Artifika

                Arvo

                Asap

                Asset

                Astloch

                Asul

                Atomic Age

                Aubrey

                Audiowide

                Autour One

                Average

                Average Sans

                Averia Gruesa Libre

                Averia Libre

                Averia Sans Libre

                Averia Serif Libre

                Bad Script

                Balthazar

                Bangers

                Basic

                Battambang

                Baumans

                Bayon

                Belgrano

                Belleza

                BenchNine

                Bentham

                Berkshire Swash

                Bevan

                Bigelow Rules

                Bigshot One

                Bilbo

                Bilbo Swash Caps

                Bitter

                Black Ops One

                Bokor

                Bonbon

                Boogaloo

                Bowlby One

                Bowlby One SC

                Brawler

                Bree Serif

                Bubblegum Sans

                Bubbler One

                Buda

                Buenard

                Butcherman

                Butterfly Kids

                Cabin

                Cabin Condensed

                Cabin Sketch

                Caesar Dressing

                Cagliostro

                Calligraffitti

                Cambo

                Candal

                Cantarell

                Cantata One

                Cantora One

                Capriola

                Cardo

                Carme

                Carrois Gothic

                Carrois Gothic SC

                Carter One

                Caudex

                Cedarville Cursive

                Ceviche One

                Changa One

                Chango

                Chau Philomene One

                Chela One

                Chelsea Market

                Chenla

                Cherry Cream Soda

                Cherry Swash

                Chewy

                Chicle

                Chivo

                Cinzel

                Cinzel Decorative

                Clicker Script

                Coda

                Coda Caption

                Codystar

                Combo

                Comfortaa

                Coming Soon

                Concert One

                Condiment

                Content

                Contrail One

                Convergence

                Cookie

                Copse

                Corben

                Courgette

                Cousine

                Coustard

                Covered By Your Grace

                Crafty Girls

                Creepster

                Crete Round

                Crimson Text

                Croissant One

                Crushed

                Cuprum

                Cutive

                Cutive Mono

                Damion

                Dancing Script

                Dangrek

                Dawning of a New Day

                Days One

                Delius

                Delius Swash Caps

                Delius Unicase

                Della Respira

                Denk One

                Devonshire

                Didact Gothic

                Diplomata

                Diplomata SC

                Domine

                Donegal One

                Doppio One

                Dorsa

                Dosis

                Dr Sugiyama

                Droid Sans

                Droid Sans Mono

                Droid Serif

                Duru Sans

                Dynalight

                Eagle Lake

                Eater

                EB Garamond

                Economica

                Ek Mukta

                Electrolize

                Elsie

                Elsie Swash Caps

                Emblema One

                Emilys Candy

                Engagement

                Englebert

                Enriqueta

                Erica One

                Esteban

                Euphoria Script

                Ewert

                Exo

                Exo 2

                Expletus Sans

                Fanwood Text

                Fascinate

                Fascinate Inline

                Faster One

                Fasthand

                Fauna One

                Federant

                Federo

                Felipa

                Fenix

                Finger Paint

                Fira Mono

                Fira Sans

                Fjalla One

                Fjord One

                Flamenco

                Flavors

                Fondamento

                Fontdiner Swanky

                Forum

                Francois One

                Freckle Face

                Fredericka the Great

                Fredoka One

                Freehand

                Fresca

                Frijole

                Fruktur

                Fugaz One

                Gabriela

                Gafata

                Galdeano

                Galindo

                Gentium Basic

                Gentium Book Basic

                Geo

                Geostar

                Geostar Fill

                Germania One

                GFS Didot

                GFS Neohellenic

                Gilda Display

                Give You Glory

                Glass Antiqua

                Glegoo

                Gloria Hallelujah

                Goblin One

                Gochi Hand

                Gorditas

                Goudy Bookletter 1911

                Graduate

                Grand Hotel

                Gravitas One

                Great Vibes

                Griffy

                Gruppo

                Gudea

                Habibi

                Halant

                Hammersmith One

                Hanalei

                Hanalei Fill

                Handlee

                Hanuman

                Happy Monkey

                Headland One

                Henny Penny

                Herr Von Muellerhoff

                Hind

                Holtwood One SC

                Homemade Apple

                Homenaje

                Iceberg

                Iceland

                IM Fell Double Pica

                IM Fell Double Pica SC

                IM Fell DW Pica

                IM Fell DW Pica SC

                IM Fell English

                IM Fell English SC

                IM Fell French Canon

                IM Fell French Canon SC

                IM Fell Great Primer

                IM Fell Great Primer SC

                Imprima

                Inconsolata

                Inder

                Indie Flower

                Inika

                Irish Grover

                Istok Web

                Italiana

                Italianno

                Jacques Francois

                Jacques Francois Shadow

                Jim Nightshade

                Jockey One

                Jolly Lodger

                Josefin Sans

                Josefin Slab

                Joti One

                Judson

                Julee

                Julius Sans One

                Junge

                Jura

                Just Another Hand

                Just Me Again Down Here

                Kalam

                Kameron

                Kantumruy

                Karla

                Karma

                Kaushan Script

                Kavoon

                Kdam Thmor

                Keania One

                Kelly Slab

                Kenia

                Khand

                Khmer

                Kite One

                Knewave

                Kotta One

                Koulen

                Kranky

                Kreon

                Kristi

                Krona One

                La Belle Aurore

                Laila

                Lancelot

                Lato

                League Script

                Leckerli One

                Ledger

                Lekton

                Lemon

                Libre Baskerville

                Life Savers

                Lilita One

                Lily Script One

                Limelight

                Linden Hill

                Lobster

                Lobster Two

                Londrina Outline

                Londrina Shadow

                Londrina Sketch

                Londrina Solid

                Lora

                Love Ya Like A Sister

                Loved by the King

                Lovers Quarrel

                Luckiest Guy

                Lusitana

                Lustria

                Macondo

                Macondo Swash Caps

                Magra

                Maiden Orange

                Mako

                Marcellus

                Marcellus SC

                Marck Script

                Margarine

                Marko One

                Marmelad

                Marvel

                Mate

                Mate SC

                Maven Pro

                McLaren

                Meddon

                MedievalSharp

                Medula One

                Megrim

                Meie Script

                Merienda

                Merienda One

                Merriweather

                Merriweather Sans

                Metal

                Metal Mania

                Metamorphous

                Metrophobic

                Michroma

                Milonga

                Miltonian

                Miltonian Tattoo

                Miniver

                Miss Fajardose

                Modern Antiqua

                Molengo

                Molle

                Monda

                Monofett

                Monoton

                Monsieur La Doulaise

                Montaga

                Montez

                Montserrat

                Montserrat Alternates

                Montserrat Subrayada

                Moul

                Moulpali

                Mountains of Christmas

                Mouse Memoirs

                Mr Bedfort

                Mr Dafoe

                Mr De Haviland

                Mrs Saint Delafield

                Mrs Sheppards

                Muli

                Mystery Quest

                Neucha

                Neuton

                New Rocker

                News Cycle

                Niconne

                Nixie One

                Nobile

                Nokora

                Norican

                Nosifer

                Nothing You Could Do

                Noticia Text

                Noto Sans

                Noto Serif

                Nova Cut

                Nova Flat

                Nova Mono

                Nova Oval

                Nova Round

                Nova Script

                Nova Slim

                Nova Square

                Numans

                Nunito

                Odor Mean Chey

                Offside

                Old Standard TT

                Oldenburg

                Oleo Script

                Oleo Script Swash Caps

                Open Sans

                Open Sans Condensed

                Oranienbaum

                Orbitron

                Oregano

                Orienta

                Original Surfer

                Oswald

                Over the Rainbow

                Overlock

                Overlock SC

                Ovo

                Oxygen

                Oxygen Mono

                Pacifico

                Paprika

                Parisienne

                Passero One

                Passion One

                Pathway Gothic One

                Patrick Hand

                Patrick Hand SC

                Patua One

                Paytone One

                Peralta

                Permanent Marker

                Petit Formal Script

                Petrona

                Philosopher

                Piedra

                Pinyon Script

                Pirata One

                Plaster

                Play

                Playball

                Playfair Display

                Playfair Display SC

                Podkova

                Poiret One

                Poller One

                Poly

                Pompiere

                Pontano Sans

                Port Lligat Sans

                Port Lligat Slab

                Prata

                Preahvihear

                Press Start 2P

                Princess Sofia

                Prociono

                Prosto One

                PT Mono

                PT Sans

                PT Sans Caption

                PT Sans Narrow

                PT Serif

                PT Serif Caption

                Puritan

                Purple Purse

                Quando

                Quantico

                Quattrocento

                Quattrocento Sans

                Questrial

                Quicksand

                Quintessential

                Qwigley

                Racing Sans One

                Radley

                Rajdhani

                Raleway

                Raleway Dots

                Rambla

                Rammetto One

                Ranchers

                Rancho

                Rationale

                Redressed

                Reenie Beanie

                Revalia

                Ribeye

                Ribeye Marrow

                Righteous

                Risque

                Roboto

                Roboto Condensed

                Roboto Slab

                Rochester

                Rock Salt

                Rokkitt

                Romanesco

                Ropa Sans

                Rosario

                Rosarivo

                Rouge Script

                Rozha One

                Rubik Mono One

                Rubik One

                Ruda

                Rufina

                Ruge Boogie

                Ruluko

                Rum Raisin

                Ruslan Display

                Russo One

                Ruthie

                Rye

                Sacramento

                Sail

                Salsa

                Sanchez

                Sancreek

                Sansita One

                Sarina

                Sarpanch

                Satisfy

                Scada

                Schoolbell

                Seaweed Script

                Sevillana

                Seymour One

                Shadows Into Light

                Shadows Into Light Two

                Shanti

                Share

                Share Tech

                Share Tech Mono

                Shojumaru

                Short Stack

                Siemreap

                Sigmar One

                Signika

                Signika Negative

                Simonetta

                Sintony

                Sirin Stencil

                Six Caps

                Skranji

                Slabo 13px

                Slabo 27px

                Slackey

                Smokum

                Smythe

                Sniglet

                Snippet

                Snowburst One

                Sofadi One

                Sofia

                Sonsie One

                Sorts Mill Goudy

                Source Code Pro

                Source Sans Pro

                Source Serif Pro

                Special Elite

                Spicy Rice

                Spinnaker

                Spirax

                Squada One

                Stalemate

                Stalinist One

                Stardos Stencil

                Stint Ultra Condensed

                Stint Ultra Expanded

                Stoke

                Strait

                Sue Ellen Francisco

                Sunshiney

                Supermercado One

                Suwannaphum

                Swanky and Moo Moo

                Syncopate

                Tangerine

                Taprom

                Tauri

                Teko

                Telex

                Tenor Sans

                Text Me One

                The Girl Next Door

                Tienne

                Tinos

                Titan One

                Titillium Web

                Trade Winds

                Trocchi

                Trochut

                Trykker

                Tulpen One

                Ubuntu

                Ubuntu Condensed

                Ubuntu Mono

                Ultra

                Uncial Antiqua

                Underdog

                Unica One

                UnifrakturCook

                UnifrakturMaguntia

                Unkempt

                Unlock

                Unna

                Vampiro One

                Varela

                Varela Round

                Vast Shadow

                Vesper Libre

                Vibur

                Vidaloka

                Viga

                Voces

                Volkhov

                Vollkorn

                Voltaire

                VT323

                Waiting for the Sunrise

                Wallpoet

                Walter Turncoat

                Warnes

                Wellfleet

                Wendy One

                Wire One

                Yanone Kaffeesatz

                Yellowtail

                Yeseva One

                Yesteryear

                Zeyada";



            $google_fonts = explode("\n", $google_fonts);



            foreach ($google_fonts as $key => $font) {

                $google_fonts[$key] = trim($font);

            }

            add_option(PLP_GOOGLE_FONTS, json_encode($google_fonts));

        }

    }



    public function licensingInit()

    {

        $license_key = trim( get_option( PLP_LICENSE ) );

        /*$this->request          = $request['request'];
        $this->plugin_name      = $request['plugin_name']; // same as plugin slug
        $this->version          = $request['version'];
        $this->product_id       = $request['product_id'];
        $this->api_key          = $request['api_key'];
        $this->activation_email = $request['activation_email'];
        $this->instance         = ( empty( $request['instance'] ) ) ? '' : $request['instance'];
        $this->domain           = ( empty( $request['domain'] ) ) ? '' : $request['domain'];
        $this->software_version = ( empty( $request['software_version'] ) ) ? '' : $request['software_version'];
        $this->extra            = ( empty( $request['extra'] ) ) ? '' : apply_filters( 'api_manager_extra_update_data', $request['extra'] );*/

        // Let's get started
        //$this->update_check();

        if (get_option(PLP_LICENSE_STATUS) == "valid")
            add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'pre_set_site_transient_update_plugins_filter' ) );

    }

    public function pre_set_site_transient_update_plugins_filter($transient) {

        $license_data = json_decode(get_option(PLP_LICENSE_PARAMS), true);
        //var_dump($license_data);

        $updater_data = array(
            "wc-api" => "upgrade-api",
            "request" => "pluginupdatecheck",
            "plugin_name" => urlencode("My Profit Player"),
            "version"   => PLP_VERSION,
            "product_id" => urlencode("My Profit Player"),
            "api_key" => $license_data["licence_key"],
            "activation_email" => $license_data["email"],
            "instance" => $license_data["instance"],
            "version"   => PLP_VERSION,
            "domain"   => urlencode("http://profitplugins.com/")
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, add_query_arg($updater_data, PLP_SAMPLE_STORE_URL));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $response = curl_exec($ch);
        curl_close($ch);

        $response = unserialize($response);

        if ($response->new_version != PLP_VERSION) {
            $obj = new stdClass();
            $obj->name = PLP_NAME;
            $obj->slug = "my-profit-player";
            $obj->new_version = $response->new_version;
            $obj->package = $response->package;

            $exploded = explode("plugins/", PLP_PATH);
            $transient->response[$exploded[1]."playlist-plugin.php"] = $obj;
        }

        return $transient;
    }

    public function deactivate()

    {
        $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

        $api_params = json_decode(get_option(PLP_LICENSE_PARAMS), true);
        $api_params['request'] = "deactivation";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, add_query_arg($api_params, PLP_SAMPLE_STORE_URL));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $response = curl_exec($ch);
        curl_close($ch);
        
        delete_option( PLP_LICENSE_STATUS );
        delete_option( PLP_LICENSE_PARAMS );
    }

    public function editor()

    {

        if ( get_user_option('rich_editing') == 'true' )

        {

            add_filter( 'mce_external_plugins', array($this, 'add_mce_plugin') );

            add_filter( 'mce_buttons', array($this, 'register_button') );

        }

    }



    public function add_mce_plugin()

    {

        $plugin_array["plp_plugin"] = PLP_URL."js/button.js?time=".time();

        return $plugin_array;

    }

    public function register_button($buttons)

    {

        array_push( $buttons, "|", 'plp_plugin' );

        return $buttons;

    }

    public function init_options()

    {

        $options = array(

            'autohide'=>'2',

            'width' => '100%',

            'theme' => 'dark',

            'color' => 'red',

            'rel' => '0',

            'showinfo'=> '0',

            'autoplay' => '0',

            'controls' => '1',

            'social_buttons'=> '0',

            'social_buttons_global'=> 'player_settings'

        );

        $values = get_option(PLP_DEFAULT);

        if(empty($values))
        {
            update_option(PLP_DEFAULT, $options);
            $values = get_option(PLP_DEFAULT);
        }

        if($values['social_buttons'] == null)
        {
            $values['social_buttons'] = 0;
            update_option(PLP_DEFAULT, $values);
        }

        if($values['social_buttons_global'] == null)
        {
            $values['social_buttons_global'] = 'player_settings';
            update_option(PLP_DEFAULT, $values);
        }

        add_thickbox();

    }



    public function load_scripts()

    {



        wp_register_script("plp_froogaloop", PLP_URL.'js/froogaloop/javascript/froogaloop.js?time='.time(), array("jquery"));

        wp_enqueue_script("plp_froogaloop");

        wp_register_script("plp_wistiaIframeAPI", PLP_URL.'js/wistia.iframe-api-v1.js?time='.time(), array("jquery"));

        wp_enqueue_script("plp_wistiaIframeAPI");        

        wp_register_script("plp_youtubePlaylist", PLP_URL.'js/jquery.youtubePlaylist.js?time='.time(), array("jquery"));

        wp_enqueue_script("plp_youtubePlaylist");

        //wp_register_script("plp_flowplayerJS", PLP_URL.'js/flowplayer/flowplayer.min.js?time='.time(), array("jquery"));

        //wp_enqueue_script("plp_flowplayerJS");


        wp_register_style("plp_youtubePlaylist", PLP_URL.'css/youtubePlaylist.css');

        wp_enqueue_style("plp_youtubePlaylist");


        //wp_register_style("plp_flowplayerCSS", PLP_URL.'js/flowplayer/skin/minimalist.css');

        //wp_enqueue_style("plp_flowplayerCSS");

    }

    public function shortcode($args, $content )

    {

        $default_options= get_option(PLP_DEFAULT);



        $atts = shortcode_atts( $default_options, $args );





        $videos = json_decode(get_option(PLP_VIDEOS), true);

        $ctas = json_decode(get_option(PLP_CALL_TO_ACTIONS), true);

        $new_videos = array();

        $new_ctas = array();

        $total_elements = array();



        if($content !="")

        {

            $exp = explode(",", $content);


            foreach($exp as $url)

            {

                $url = trim($url);

                if($url != "")

                {

                    $exploded = explode(":", $url);

                    $exploded[0] = trim($exploded[0]);

                    $exploded[1] = trim($exploded[1]);



                    if ($exploded[0] == "video") {

                        if(isset($videos[$exploded[1]]))
                            $url = $videos[$exploded[1]]['url'];

                            $url = str_replace("video:", "", $url);
                            $new_videos[] = $url;

                            $total_elements[] = array(

                                'type' => 'video',

                                'data' => $url

                            );

                    }

                    elseif ($exploded[0] == "cta") {

                        if (isset($ctas[$exploded[1]])) {

                            $new_ctas[] = $ctas[$exploded[1]];

                            $total_elements[] = array(

                                'type' => 'cta',

                                'identifier' => 'cta',

                                'data' => $ctas[$exploded[1]]

                            );

                        }

                    }

                    else {

                        if(isset($videos[$url]))

                            $url = $videos[$url];

                        $url = str_replace("video:", "", $url);

                        $new_videos[] = $url;

                    }

                   

                }



               //echo $url;





            }

        }

        $view_data['atts'] = $atts;

        $view_data['video_urls'] = $new_videos;

        $view_data['ctas'] = $new_ctas;

        $view_data['total_elements'] = $total_elements;

        $view_data['google_fonts'] = json_decode(get_option(PLP_GOOGLE_FONTS), true);

        $view_data['default'] = get_option(PLP_DEFAULT);

        return plp_load_view("player_view", $view_data);











    }

}





$playlistPlugin = new playlistPlugin();





// load the admin side

include "playlist-plugin-admin.php";

$playlistPluginAdmin = new playlistPluginAdmin();



