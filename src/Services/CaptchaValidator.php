<?php

namespace NFCaptcha\Services;

final class CaptchaValidator
{
    public function __construct(
        private CaptchaGenerator $generator
    ) {
    }

    public function validate(string $answer, string $hash): bool
    {
        return $this->generator->hash($answer) === $hash;
    }
}
