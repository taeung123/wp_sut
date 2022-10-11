# Extension Kit
 > It's an extension kit for our theme https://github.com/hieu-pv/nf-theme 
 
- [Installation](#installation)
- [Configuration](#configuration)
- [Compile asset file](#compiler)
- [Service](#service)
- [Working with local repository](#local-reposoitory)
- [Extension Configuration](#extension-configuration)

 
<a name="installation"></a>
## Installation

### Clone repository
```
git clone https://github.com/hieu-pv/nf-extension-kit.git 
```

<a name="configuration"></a>

### Update your information

If you want provide some function that is bootstrapped when wordpress start, we will register them in `src/ExtensionKitServiceProvider.php`

> For example: register css/js file


then in `config/app.php` of the theme we have to register service provider

```php
  'providers'  => [
        // .... Others providers 
        \NightFury\ExtensionKit\ExtensionKitServiceProvider::class,
    ],
```

<a name="compiler"></a>

## Compile asset file

> {tip} You can write your own javascript in `/assets/scripts/app.js`
> and css in `/assets/styles/app.scss`

All compiled file will be located in `/assets/dist`

##### Install node module

```
npm install
```

##### Run asset compiler

```
npm run build
```

##### Run asset compiler on production mode

```
npm run prod
```

##### Watch file change and compile

```
npm run watch
```

> {tip} You can write your own config in `webpack.config.js`

<a name="service"></a>
## Service

Blade is the simple, yet powerful templating engine provided with this kit. You can use it via NightFury\ExtensionKit\Facades\View 

> {tip} Blade file are located in `/resources/views`

For example we have a file `/resources/views/example.blade.php` then we can use this file by following code

```
echo NightFury\ExtensionKit\Facades\View::render('example', ['data' => 'some test data here']);
```

For more information about blade engine [https://laravel.com/docs/5.5/blade](https://laravel.com/docs/5.5/blade)


<a name="local-reposoitory"></a>
## Working with local repository

In addition to the artifact repository, you can use the path one, which allows you to depend on a local directory, either absolute or relative. This can be especially useful when dealing with monolithic repositories.

To add local repository to your project, add the following code to your composer.json then run command `composer install`

```
{
    "repositories": [
        {
            "type": "path",
            "url": "../../packages/my-package"
        }
    ],
    "require": {
        "my/package": "*"
    }
}
```

For example 

```
    {
        "require": {
            "nf/extension-kit": "dev-master"
        },
        "repositories": [{
            "type": "path",
            "url": "../../../../nf-extension-kit" // use relative path here
        }]
    }
```
For more information [https://getcomposer.org/doc/05-repositories.md](https://getcomposer.org/doc/05-repositories.md)

<a name="extension-configuration"></a>
## Extension Configuration

In some case we need some configuration from user, we can use `nf/theme-option` package 

Checkout package repository for install and supported field [https://github.com/hieu-pv/nf-theme-option](https://github.com/hieu-pv/nf-theme-option)

##### Register option scheme in your service provider `src/ExtensionKitServiceProvider.php`

```php
use use NightFury\Option\Abstracts\Input;

\NightFury\Option\Facades\ThemeOptionManager::add([
    'name'   => 'Exetension Kit',
    'fields' => [
        [
            'label'    => 'Text',
            'name'     => 'theme_option_text',
            'type'     => Input::TEXT,
            'required' => true,
        ],
        [
            'label'    => 'Textarea',
            'name'     => 'theme_option_textarea',
            'type'     => Input::TEXTAREA,
            'required' => true,
        ],
        [
            'label'    => 'Email',
            'name'     => 'theme_option_email',
            'type'     => Input::EMAIL,
            'required' => true,
        ],
        [
            'label'       => 'Gallery',
            'name'        => 'theme_option_gallery',
            'type'        => Input::GALLERY,
            'description' => 'We can select multi file. Drag and Drop to re-order content',
        ],
        [
            'label'       => 'Gallery With Meta Field',
            'name'        => 'theme_option_gallery_with_meta',
            'type'        => Input::GALLERY,
            'description' => 'Gallery with meta field, for now we support text and textarea on meta field.',
            'meta'        => [
                [
                    'label' => 'Text',
                    'name'  => 'meta_text',
                    'type'  => Input::TEXT,
                ],
                [
                    'label' => 'Textarea',
                    'name'  => 'meta_textarea',
                    'type'  => Input::TEXTAREA,
                ],
            ],
        ], [
            'label'       => 'Image',
            'name'        => 'theme_option_image',
            'type'        => Input::IMAGE,
            'description' => 'Choose your image by clicking the button bellow',
        ],
        [
            'label'   => 'Select',
            'name'    => 'theme_option_select',
            'type'    => Input::SELECT,
            'options' => [
                [
                    'value'    => 'first',
                    'label'    => 'First Value',
                    'selected' => true,
                ],
                [
                    'value'    => 'second',
                    'label'    => 'Second Value',
                    'selected' => false,
                ],
            ],
        ],
    ],
]);
```


