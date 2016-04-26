<?php

use Mockery as m;
use Mark86092\Recaptcha\Recaptcha;

class RecaptchaTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testRecaptchaCanCheck()
    {
        $provider = m::mock(\ReCaptcha\ReCaptcha::class);
        $response = new \ReCaptcha\Response(true, []);
        $provider->shouldReceive('verify')->once()->andReturn($response);

        $captcha = new Recaptcha($provider);
        $this->assertTrue($captcha->verify('secret')->check());
    }
}
