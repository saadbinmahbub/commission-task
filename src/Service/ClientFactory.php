<?php


namespace Acme\CommissionTask\Service;


use Exception;

class ClientFactory
{
    public function getClient(string $clientType)
    {
        switch ($clientType) {
            case 'private':
                return new PrivateClient();
            case 'business':
                return new BusinessClient();
            default:
                throw new Exception("Client type {$clientType} not find");
        }
    }
}