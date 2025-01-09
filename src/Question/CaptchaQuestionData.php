<?php

namespace NFCaptcha\Question;

final class CaptchaQuestionData
{
    public const NUMERIC = 'numeric';
    public const TEXT = 'text';
    public const IMAGE = 'image';

    public function __construct(
        public string $type,
        public string $question,
        public string $answer
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

    public function getAnswer(): string
    {
        return $this->answer;
    }
}
