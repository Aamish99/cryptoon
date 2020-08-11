<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurlController extends Controller
{
    public static function curl($url, $header = '')
    {
        ini_set('max_execution_time', 8000);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                $header
            ),
        ));
        //dd(curl_getinfo($curl));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public static function curlMultiple($urls){
        $response = [];
        $mh = curl_multi_init();

        $channels = array();
        foreach ($urls as $key => $url) {
            $channels[$key] = curl_init();
            curl_setopt_array($channels[$key], array(
                CURLOPT_URL => $url,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET"
            ));

            curl_multi_add_handle($mh, $channels[$key]);
        }

        $active = null;
        do {
            $status = curl_multi_exec($mh, $active);
        }
        while ($active && $status == CURLM_OK);
        foreach ($channels as $key => $chan) {
            $res = curl_multi_getcontent($chan);
            $res = json_decode($res);
            if (is_object($res)) {
                $data = get_object_vars($res);
                if(isset($data['RAW'])){
                    $raw = $data['RAW'];
                    if (is_object($raw)) {
                        $res_data = get_object_vars($raw);
                        $response[$key] = $res_data;
                    }
                }else{
                   /* $get_uri = curl_getinfo($chan)['url'];
                    $f_uri = str_replace('USDT', 'USD', $get_uri);
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $f_uri,
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                    ));
                    $res = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);

                    $res = json_decode($res);
                    $data = get_object_vars($res);
                    if(isset($data['RAW'])){
                        $raw = $data['RAW'];
                        if (is_object($raw)) {
                            $res_data = get_object_vars($raw);
                            $response[] = $res_data;
                        }
                    }*/
                }
            }
            curl_multi_remove_handle($mh, $chan);
            curl_close($chan);
        }


        return $response;

    }

    public function curl_encoder($url, $header = '')
    {
        ini_set('max_execution_time', 8000);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                $header
            ),
        ));
        //dd(curl_getinfo($curl));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}
