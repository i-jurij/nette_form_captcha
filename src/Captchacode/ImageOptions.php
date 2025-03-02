<?php

declare(strict_types=1);

namespace NFCaptcha\Captchacode;

class ImageOptions
{
    public const FONT_CASE_UPPER = 2;
    public const FONT_CASE_LOWER = 1;

    public string $bgcolor = '255, 255, 255, 1';

    protected int $imageHeight = 60;
    protected int $imageWidth = 190;
    protected string $fontsFolder = __DIR__.'/../fonts';
    protected bool $fontShuffle = true;
    protected int $defaultFontSize = 26;

    /**
     * @var array<string, array<int>>
     */
    protected array $fontsConfiguration = [
        '3dlet.ttf' => [
            'size' => 38,
            'case' => self::FONT_CASE_LOWER,
        ],

        'baby_blocks.ttf' => [
            'size' => 16,
        ],

        'betsy_flanagan.ttf' => [
            'size' => 30,
        ],

        'karmaticarcade.ttf' => [
            'size' => 20,
        ],

        'tonight.ttf' => [
            'size' => 28,
        ],
    ];

    public function setBgcolor($bgcolor): self
    {
        if (is_string($bgcolor) && \preg_match('/(\d{1,3}),\s(\d{1,3}),\s(\d{1,3}),\s(\d{1,3})/', $bgcolor)) {
            $this->bgcolor = $bgcolor;
        }

        return $this;
    }

    public function getBgcolor(): array
    {
        $array = explode(', ', $this->bgcolor);

        return [
            'red' => (int) $array[0],
            'green' => (int) $array[1],
            'blue' => (int) $array[2],
            'alpha' => (int) $array[3],
        ];
    }

    public function setHeight(int $height): self
    {
        if ($height < 10) {
            throw new \InvalidArgumentException('Image size cannot be less than 20x10px');
        }

        $this->imageHeight = $height;

        return $this;
    }

    public function getHeight(): int
    {
        return $this->imageHeight;
    }

    public function setWidth(int $width): self
    {
        if ($width < 20) {
            throw new \InvalidArgumentException('Image size cannot be less than 20x10px');
        }

        $this->imageWidth = $width;

        return $this;
    }

    public function getWidth(): int
    {
        return $this->imageWidth;
    }

    public function setFontsFolder(string|\Stringable $folder): self
    {
        $this->fontsFolder = (string) $folder;

        if (!\is_dir($this->fontsFolder)) {
            throw new \InvalidArgumentException('The specified folder does not exist');
        }

        return $this;
    }

    public function getFontsFolder(): string
    {
        return (string) realpath($this->fontsFolder);
    }

    public function setFontShuffle(bool $shuffle): self
    {
        $this->fontShuffle = $shuffle;

        return $this;
    }

    public function getFontShuffle(): bool
    {
        return $this->fontShuffle;
    }

    public function setDefaultFontSize(int $size): self
    {
        if ($size < 5) {
            throw new \InvalidArgumentException('The specified font size is invalid');
        }

        $this->defaultFontSize = $size;

        return $this;
    }

    public function getFontSize(string $font = ''): int
    {
        return $this->fontsConfiguration[$font]['size'] ?? $this->defaultFontSize;
    }

    public function getFontCase(string $font): int
    {
        return $this->fontsConfiguration[$font]['case'] ?? 0;
    }

    public function adjustFont(
        string $fontName,
        int $size,
        int $case = 0
    ): self {
        if (\pathinfo($fontName, PATHINFO_EXTENSION) !== 'ttf') {
            throw new \InvalidArgumentException('The font file must be with the extension .ttf');
        }

        $this->fontsConfiguration[$fontName] = [
            'size' => $size,
            'case' => $case,
        ];

        return $this;
    }
}
