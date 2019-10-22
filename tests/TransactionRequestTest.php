<?php

namespace tests;

use APIClient\Requests\RequestFactory;
use PHPUnit\Framework\TestCase;

final class TransactionRequestTest extends TestCase{

    public function testCheckTransactionFailure()
    {
        $url = 'http://api.gulfbox.ae';
        $id = 2309;
        $token = '9b4802c053a884ed0bde';

        $factory = new RequestFactory($url, $id, $token);
        $request = $factory->createTransactionRequest();
        $response = $request->checkTransaction('94679548649', 1.00, 'du-md-25aed', null, true);

        $this->assertTrue($response->failure());
    }

    public function testCheckTransaction()
    {
        $url = 'http://api.gulfbox.ae';
        $id = 2309;
        $token = '9b4802c053a884ed0bde';

        $factory = new RequestFactory($url, $id, $token);
        $request = $factory->createTransactionRequest();
        $response = $request->checkTransaction('94679548649', 1.00, 'du-md-25aed', null, true);

        $this->assertObjectHasAttribute('error', $response->getOutput());
    }

}