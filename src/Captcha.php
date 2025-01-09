<?php

namespace NFCaptcha;

use NFCaptcha\Question\CaptchaQuestionFactory;
use NFCaptcha\Services\CaptchaGenerator;
use NFCaptcha\Services\CaptchaValidator;

class Captcha implements CaptchaFactory
{
    public function __construct(
        private CaptchaQuestionFactory $captchaQuestionFactory
    ) {
    }

    public function createValidator(): CaptchaValidator
    {
        return new CaptchaValidator($this->createGenerator());
    }

    public function createGenerator(): CaptchaGenerator
    {
        return new CaptchaGenerator($this->captchaQuestionFactory);
    }
}
