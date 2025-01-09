<?php

namespace NFCaptcha\Question;

interface CaptchaQuestionFactory
{
    public function get(): CaptchaQuestionData;
}
