<?php

namespace NFCaptcha\DI;

use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpLiteral;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use NFCaptcha\Captcha;
use NFCaptcha\Form\CaptchaBinder;
use NFCaptcha\Question\CaptchaQuestionData;
use NFCaptcha\Question\CaptchaQuestionImage;
use NFCaptcha\Question\CaptchaQuestionNumeric;
use NFCaptcha\Question\CaptchaQuestionText;

class CaptchaExtension extends CompilerExtension
{
    public const DATA_QUESTION = [
        CaptchaQuestionData::NUMERIC,
        CaptchaQuestionData::TEXT,
        CaptchaQuestionData::IMAGE,
    ];

    public function getConfigSchema(): Schema
    {
        return Expect::structure([
            'autoload' => Expect::bool()->default(true),
            'type' => Expect::anyOf(...self::DATA_QUESTION)->default(CaptchaQuestionData::NUMERIC),
            'bgcolor' => Expect::string($default = null),
            'questions' => Expect::arrayOf('string'),
        ]);
    }

    public function loadConfiguration(): void
    {
        $builder = $this->getContainerBuilder();

        // add data question factory
        $dataQuestion = $builder->addDefinition($this->prefix('data'));

        switch ($this->config->type) {
            case CaptchaQuestionData::TEXT:
                $dataQuestion->setFactory(CaptchaQuestionText::class, [$this->config->questions]);
                break;
            case CaptchaQuestionData::IMAGE:
                $bgcolor = $this->config->bgcolor ?? null;
                $dataQuestion->setFactory(CaptchaQuestionImage::class, [$bgcolor]);
                break;
            default:
                $dataQuestion->setFactory(CaptchaQuestionNumeric::class);
        }

        // add factory
        $builder->addDefinition($this->prefix('factory'))
            ->setFactory(Captcha::class);
    }

    public function afterCompile(ClassType $class): void
    {
        if (true == $this->config->autoload) {
            $method = $class->getMethod('initialize');
            $method->addBody(
                '?::bind($this->getService(?));',
                [
                    new PhpLiteral(CaptchaBinder::class),
                    $this->prefix('factory'),
                ]
            );
        }
    }
}
