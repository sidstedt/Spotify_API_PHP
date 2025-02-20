<?php
class CurlClass
{
    private $access_token;

    function __construct()
    {
        $this->access_token = '';
    }

    function post_request($url, $post_data, $access_token)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . $access_token, 'Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        if ($server_output === false) {
            // Get cURL error message
            $error_msg = "cURL Error: " . curl_error($ch);
            // Log error message to a file
            $log_file = 'curl_errors.log';
            file_put_contents($log_file, date('Y-m-d H:i:s') . " - " . $error_msg . PHP_EOL, FILE_APPEND);
            // Output a generic error message to the user
            exit; // Stop further execution
        }
        curl_close($ch);
        $serverReponseObject = json_decode($server_output);

        // Debug
         print_r($server_output);
         print_r($serverReponseObject);

        return $serverReponseObject;

    }
    function get_request($url, $token)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $serverReponseObject = json_decode($server_output);

        return $serverReponseObject;

        // Debug
        //print_r ( $server_output );
        //print_r($serverReponseObject);
    }
}
?>