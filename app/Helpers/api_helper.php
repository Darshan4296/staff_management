<?php
namespace App\Helpers;

class Api {

    public static function callApi($endpoint, $data = [])
    {
        // Set the request parameters
        $url = site_url('api/' . $endpoint); // Replace with your API endpoint URL

        try {
            $client = \Config\Services::curlrequest();

            $response = $client->request('POST', $url, [
                'form_params' => $data
            ]);

            return $response->getJSON();
        } catch (\Throwable $th) {
            return json_encode([
                'status'   => $th->getCode(),
                'error'    => true,
                'messages' => [
                    'error' => $th->getMessage()
                ]
            ]);
        }

    }  
}

?>