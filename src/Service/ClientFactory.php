<?php


namespace Acme\CommissionTask\Service;


use Exception;

class ClientFactory
{
    /**
     * @param string $clientType
     * @return Client
     * @throws Exception
     */
    public function getClient(string $clientType): Client
    {
        switch ($clientType) {
            case 'private':
                return new PrivateClient();
            case 'business':
                return new BusinessClient();
            default:
                throw new Exception("Client type {$clientType} not found");
        }
    }
}