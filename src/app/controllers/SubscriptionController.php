<?php

class SubscriptionController {
  private static $wsdl = SOAP_URL . 'subscription?wsdl';

  public function getUserSubscriptionStatus($params) {
    $id = $_SESSION['user']['id'];

    $client = new SoapClient(
      self::$wsdl,
      [
        'trace' => 1,
        'stream_context' => stream_context_create([
          'http' => [
            'header' => 'api-key: ' . SOAP_API_KEY,
          ],
        ])
      ],
    );
    
    $response = $client->getUserSubscriptionStatus([
      'userId' => $id,
    ]);

    return $response;
  }

  public function createSubscriptionRequest($params) {
    $id = $_SESSION['user']['id'];

    $client = new SoapClient(
      self::$wsdl,
      [
        'trace' => 1,
        'stream_context' => stream_context_create([
          'http' => [
            'header' => 'api-key: ' . SOAP_API_KEY,
          ],
        ])
      ],
    );
    
    $response = $client->createSubscriptionRequest([
      'userId' => $id,
    ]);

    return $response;
  }
}