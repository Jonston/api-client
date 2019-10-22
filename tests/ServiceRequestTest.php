<?php

namespace tests;

use APIClient\Requests\RequestFactory;
use PHPUnit\Framework\TestCase;

final class ServiceRequestTest extends TestCase{

    public function testGetServiceListSuccess()
    {
        $url = 'http://api.gulfbox.ae';
        $id = 2309;
        $token = '9b4802c053a884ed0bde';

        $factory = new RequestFactory($url, $id, $token);
        $request = $factory->createServiceRequest();
        $response = $request->getList();

        $this->assertTrue($response->success());
    }

    public function testGetServiceListFailure()
    {
        $url = 'http://api.gulfbox.ae';
        $id = 23090;
        $token = '9b4802c053a884ed0bde';

        $factory = new RequestFactory($url, $id, $token);
        $request = $factory->createServiceRequest();
        $response = $request->getList();

        $this->assertTrue($response->failure());
    }

}