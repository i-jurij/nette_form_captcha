<?php

namespace NFCaptcha;

use NFCaptcha\Services\CaptchaGenerator;
use NFCaptcha\Services\CaptchaValidator;

interface CaptchaFactory
{
    public function createValidator(): CaptchaValidator;

    public function createGenerator(): CaptchaGenerator;
}
