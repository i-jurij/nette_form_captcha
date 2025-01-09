<?php

namespace NFCaptcha\Services;

final class CaptchaGenerated
{
    public function __construct(
        private string $type,
        private string $question,
        private string $hash
    ) {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function getHash(): string
    {
        return $this->hash;
    }
}
