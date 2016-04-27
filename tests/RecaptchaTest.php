<?php

namespace Mark86092\Tests\Recaptcha;

use Mockery as m;
use Mark86092\Recaptcha\Recaptcha;
use ReCaptcha\ReCaptcha as GoogleReCaptcha;
use ReCaptcha\Response as GoogleReCaptchaResponse;

class RecaptchaTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testRecaptchaCanCheck()
    {
        $provider = m::mock(GoogleReCaptcha::class);
        $provider->shouldReceive('verify')->once()->andReturn(
            new GoogleReCaptchaResponse(true, [])
        );

        $captcha = new Recaptcha($provider);
        $this->assertTrue($captcha->verify('secret')->check());
    }
}
