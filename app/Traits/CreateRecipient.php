<?php

namespace App\Traits;

trait CreateRecipient
{
    public static function getList(Type $var = null)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.paystack.co/bank',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Authorization: sk_test_1d93b2656eb99d3c3334977538d638cfe0dab00d',
                'Cache-Control: no-cache',
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo 'cURL Error #:'.$err;
        } else {
            echo $response;
        }
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param  Type  $var Description
     * @return type
     *
     * @throws conditon
     **/
    public function createRecipient(Type $var = null17)
    {
        $url = 'https://api.paystack.co/transferrecipient';

        $fields = [
            'type' => 'nuban',
            'name' => 'Tolu Robert',
            'account_number' => '01000000010',
            'bank_code' => '058',
            'currency' => 'NGN',
        ];

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer SECRET_KEY',
            'Cache-Control: no-cache',
        ]);

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        echo $result;
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param  Type  $var Description
     * @return type
     *
     * @throws conditon
     **/
    public function updateRecipient(Type $var = null17)
    {
        $url = 'https://api.paystack.co/transferrecipient/:id_or_code';

        $fields = [
            'name' => 'Rick Sanchez',
        ];

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer SECRET_KEY',
            'Cache-Control: no-cache',
        ]);

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        echo $result;
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param  Type  $var Description
     * @return type
     *
     * @throws conditon
     **/
    public function deleteRecipient(Type $var = null17)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.paystack.co/transferrecipient/:id_or_code',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer SECRET_KEY',
                'Cache-Control: no-cache',
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo 'cURL Error #:'.$err;
        } else {
            echo $response;
        }
    }
}
