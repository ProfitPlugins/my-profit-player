<?php











//licensing stuff



//set_site_transient( 'update_plugins', null );



// this is the URL our updater / license checker pings. This should be the URL of the site with EDD installed



define( 'PLP_SAMPLE_STORE_URL', 'http://profitplugins.com/' ); // you should use your own CONSTANT name, and be sure to replace it throughout this file







// the name of your product. This should match the download name in EDD exactly



define( 'PLP_SAMPLE_ITEM_NAME', 'My Profit Player' ); // you should use your own CONSTANT name, and be sure to replace it throughout this file







define("PLP_LICENSE", "nds_plp_license_key");



define("PLP_LICENSE_STATUS", "nds_plp_license_status");
define("PLP_LICENSE_STATUS", "nds_plp_license_params");


if( !class_exists( 'PLP_SL_Plugin_Updater' ) ) {



    // load our custom updater



    include( PLP_PATH.'/libraries/licensing/EDD_SL_Plugin_Updater.php' );



}







include "licensing.php";