<?php

namespace Mark86092\Recaptcha;

use ReCaptcha\ReCaptcha as GoogleReCaptcha;

class Recaptcha
{
    protected $recaptcha;
    protected $response;

    public function __construct(GoogleReCaptcha $recaptcha)
    {
        $this->recaptcha = $recaptcha;
        $this->response = null;
    }

    /**
     * Call out to reCAPTCHA and process the response.
     *
     * @param string $response
     *
     * @return bool
     */
    public function check()
    {
        if (is_null($this->response)) {
            return false;
        }

        if ($this->response->isSuccess()) {
            return true;
        } else {
            return false;
        }
    }

    public function verify($response, $remoteIp = null)
    {
        if (is_null($this->response)) {
            $this->response = $this->recaptcha->verify($response, $remoteIp);
        }

        return $this;
    }
}
