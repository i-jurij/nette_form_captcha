<?php

namespace NFCaptcha\Form;

use Nette\Forms\Container;
use NFCaptcha\CaptchaFactory;

final class CaptchaBinder
{
    public static function bind(CaptchaFactory $factory): void
    {
        Container::extensionMethod(
            'addCaptcha',
            function (
                Container $container,
                string $name,
                string $requireMessage
            ) use ($factory): CaptchaContainer {
                $captcha = $container[$name] = new CaptchaContainer($factory);
                $captcha->setRequired($requireMessage);

                return $captcha;
            }
        );
    }
}
