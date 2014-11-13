<?php
class plpLicensing
{
    public function __construct()
    {
        if(get_option(PLP_LICENSE_STATUS)!="valid")
        {
            add_action("admin_menu", array($this, "license_menu"));
        }
    }

    public function license_menu()
    {
        add_menu_page(PLP_NAME, PLP_NAME, "manage_options", PLP_SLUG, array($this, "license_page"));
    }

    public function license_page()
    {
        $data = array();
        if($_POST)
        {
            $license = trim($_POST['api_key']);
            $email = trim($_POST['email_address']);
            $result = $this->activate_license($email, $license);



            if($result == 1)
            {
                $data['success'] = "License Activated!";
            }
            if($result === 0)
            {
                $data['error'] = "Invalid key!";
            }
            if($result === null)
            {
                $data['error'] = "Could not contact the licensing server!";
            }


        }

        echo plp_load_view("license/license", $data);
    }

    function activate_license($email,$license)
    {

        // store the license

        update_option(PLP_LICENSE, $license);


        $length = 30;

        $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

        // data to send in our API request
        $api_params = array(
            'wc-api'=> 'am-software-api',
            'email' 	=> urlencode($email),
            'licence_key' => $license,
            'request' => 'activation',
            'product_id' => urlencode("My Profit Player"),
            'instance' => urlencode($randomString),
            'software_version' => PLP_VERSION,
        );

        // Call the custom API.
        //$response = wp_remote_get( add_query_arg( $api_params, PLP_SAMPLE_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, add_query_arg($api_params, PLP_SAMPLE_STORE_URL));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $response = curl_exec($ch);
        curl_close($ch);

        // make sure the response came back okay
        if ( is_wp_error( $response ) )
            return false;

        // decode the license data
        $license_data = json_decode($response);

        //$license_data->license = "valid";
        // $license_data->license will be either "valid" or "invalid"

        if ($license_data->activated)
            $license_data->license = "valid";
        else
            $license_data->license = "invalid";

        update_option( PLP_LICENSE_STATUS, $license_data->license );
        update_option( PLP_LICENSE_PARAMS, json_encode($api_params) );
        if(@$license_data->activated == true)
        {
            return 1;
        }
        return 0;

    }

}

$plpLicensing = new plpLicensing();