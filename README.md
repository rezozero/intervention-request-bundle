# Intervention Request Bundle

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require rezozero/intervention-request-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    \RZ\InterventionRequestBundle\RZInterventionRequestBundle::class => ['all' => true],
];
```

Add the routing:

```yaml
# app/config/routing.yml

# ...
rz_intervention_request:
    resource: "@RZInterventionRequestBundle/Resources/config/routing.yml"
    prefix:   /

```
### Step 3: configuration

```yaml
# config/packages/rz_intervention_request.yaml
parameters:
    env(IR_DEFAULT_QUALITY): '90'
    env(IR_MAX_PIXEL_SIZE): '1920'
    ir_default_quality: '%env(int:IR_DEFAULT_QUALITY)%'
    ir_max_pixel_size: '%env(int:IR_MAX_PIXEL_SIZE)%'

rz_intervention_request:
    driver: 'gd'
    default_quality: '%ir_default_quality%'
    max_pixel_size: '%ir_max_pixel_size%'
    cache_path: "%kernel.project_dir%/public/assets"
    files_path: "%kernel.project_dir%/public/files"
    jpegoptim_path: /usr/bin/jpegoptim
    pngquant_path: /usr/bin/pngquant
    subscribers: []
```

Then add the following variables to your project `.env` file:

```dotenv
###> rezozero/intervention-request-bundle ###
IR_DEFAULT_QUALITY=90
IR_MAX_PIXEL_SIZE=2500
###< rezozero/intervention-request-bundle ###
```
