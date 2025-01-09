<?php

namespace NFCaptcha\Services;

use NFCaptcha\Question\CaptchaQuestionFactory;

final class CaptchaGenerator
{
    public function __construct(
        private CaptchaQuestionFactory $captchaQuestionFactory
    ) {
    }

    public function generate(): CaptchaGenerated
    {
        $captcha = $this->captchaQuestionFactory->get();

        return new CaptchaGenerated(
            $captcha->getType(),
            $captcha->getQuestion(),
            $this->hash($captcha->getAnswer())
        );
    }

    public function hash(string $answer): string
    {
        return sha1(strtolower($answer));
    }
}
