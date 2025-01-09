<?php

namespace NFCaptcha\Question;

use NFCaptcha\Captchacode\Code;
use NFCaptcha\Captchacode\Image;
use NFCaptcha\Captchacode\ImageOptions;

class CaptchaQuestionImage implements CaptchaQuestionFactory
{
    public function __construct(
        private ?string $bgcolor = null
    ) {
    }

    public function get(): CaptchaQuestionData
    {
        $answer = (string) new Code();

        $imageOptions = (new ImageOptions())->setBgcolor($this->bgcolor);
        // base64 image
        $question = new Image($answer, $imageOptions);

        return new CaptchaQuestionData(
            CaptchaQuestionData::IMAGE,
            $question,
            $answer
        );
    }
}
