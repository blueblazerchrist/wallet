<?php

namespace app\Soap;

use Laminas\Soap\Client as LaminasSoapClient;

class Client extends LaminasSoapClient
{
    public function getLastResponse()
    {
        $getLastResponse  = parent::getLastResponse();
        if($getLastResponse == '') return '';
        $xml = preg_replace('/xmlns[^=]*="[^"]*"/i', '', $getLastResponse);
        $xml = preg_replace('/\w+:(\w+)/', '$1', $xml);
        $xmlObject = new \SimpleXMLElement($xml);
        $key = array_keys(get_object_vars($xmlObject->Body));
        $items = json_decode(json_encode($xmlObject->Body->{$key[0]}->return), true)['item'];
        return $items;
    }
}
