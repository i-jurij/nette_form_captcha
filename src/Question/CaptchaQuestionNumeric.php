<?php

namespace NFCaptcha\Question;

class CaptchaQuestionNumeric implements CaptchaQuestionFactory
{
    public function get(): CaptchaQuestionData
    {
        $numberA = $this->generateNumber();
        $numberB = $this->generateNumber();

        $question = sprintf('%s + %s', $numberA, $numberB);
        $answer = $numberA + $numberB;

        return new CaptchaQuestionData(
            CaptchaQuestionData::NUMERIC,
            $question,
            (string) $answer
        );
    }

    private function generateNumber(): int
    {
        return rand(0, 50);
    }
}
