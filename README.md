# Nette Form Captcha

## Install
composer.json:   
```
{
	"repositories": [
		{
			"url": "https://github.com/i-jurij/nette_form_captcha.git",
			"type": "vcs"
		}
	],
	"require": {
		"i-jurij/nette_form_captcha": "dev-main"
	}
}
```

```
composer install
```

## Setup

Config

```
extensions:
    captcha: NFCaptcha\DI\CaptchaExtension
    
captcha:
    autoload: yes
    type: image # question | numeric | image
    bgcolor: '255, 255, 255, 50' # Only for type = image, set background and opacity of image of captcha
    questions: # only for type question
        "Question 1?": "1"
        "Question 2?": "2"
       
```

## Form

```php
use Nette\Application\UI\Form;

public function createComponentForm()
{
    $form = new Form();
    
    $form->addCaptcha('captcha', 'Wrong captcha');
    
    $form->addSubmit('send');
    
    $form->onSuccess[] = function (Form $form) {
        dump($form['captcha']);
    };
    
    return $form;
}
```

## Render

```
{control form}
```

## Example

![image](./captcha_example.png)