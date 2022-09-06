<?php

namespace App\DotpayManager;

class DotpayManager{

    private $api_version = 'next';
    private $currency = 'PLN';

    public $amount;
    public $email;
    public $firstname;
    public $lastname;
    public $control;
    public $description;
    public $type = '0';
    public $url;
    public string $street;
    public $city;
    public $postcode;
    public $phone;
    private $country = 'PL';


    public function __construct($amount, $email, $firstname, $lastname, $control, $description, $url){

        $this->amount = $amount;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->control = $control;
        $this->description = $description;
        $this->url = $url;

    }

    public function createParamtersArray(){

        $paramtersArray = [

            'id' => env('DOTPAY_ID'),
            'api_version' => $this->api_version,
            'amount' => $this->amount,
            'email' => $this->email,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'currency' => $this->currency,
            'control' => $this->control,
            'description' => $this->description,
            'type' => $this->type,
            'url' => $this->url,
            'street' => $this->street,
            'city' => $this->city,
            'postcode' => $this->postcode,
            'phone' => $this->phone,
            'country' => $this->country,

        ];

        $chk = $this->generateChk($paramtersArray);

        $paramtersArray['chk'] = $chk;

        return $paramtersArray;

    }

    public function generateChk($parameters){

        ksort($parameters);
        $paramList = implode(';', array_keys($parameters));
        $parameters['paramsList'] = $paramList;
        ksort($parameters);
        $json = json_encode($parameters, JSON_UNESCAPED_SLASHES);

        $chk = hash_hmac('sha256', $json, env('DOTPAY_PIN'), false);
        
        return $chk;
    }


    #Do zrobienia
    public function CheckSignature($paramtersArray ,$signature){


    }

}

