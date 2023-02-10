## 3.0.0 (2023-02-10)

### ⚠ BREAKING CHANGES

* Requires php80 minimum
* Requires `ambroisemaupate/intervention-request` >= 4.0.0

### Features

* Added compilerPass to get intervention_request.storage reference ([79c7cc4](https://github.com/rezozero/intervention-request-bundle/commit/79c7cc4af56fe2da50e9497df8c7885ad47c7289))
* Automatically wire existing Flysystem `intervention_request.storage` ([a8d67aa](https://github.com/rezozero/intervention-request-bundle/commit/a8d67aa180e68cb5239d3eb9295f81f923fc5733))
* Requires php80 minimum ([e729358](https://github.com/rezozero/intervention-request-bundle/commit/e729358c16d35cc0505d19f2dfc34bd9e577e672))
* Update `InterventionRequest` signature with `FileResolverInterface` ([a81af8d](https://github.com/rezozero/intervention-request-bundle/commit/a81af8d9d979a8e4830b146d1cb1f1dc73a68c0c))

## 2.0.4 (2022-11-14)

### Bug Fixes

* Do not validate configuration values, this is not compatible with DotEnv late-resolution ([889e885](https://github.com/rezozero/intervention-request-bundle/commit/889e88521ab3dc6750f7d41afacf51bb1427a155))

## 2.0.3 (2022-11-10)

### Bug Fixes

* Do not cast default quality and max pixel sizes parameters as it breaks DotEnv lazy resolution ([4bb5327](https://github.com/rezozero/intervention-request-bundle/commit/4bb5327d791b39dad31d46a29d6ef79c63410831))

## 2.0.2 (2022-11-08)

### Bug Fixes

* Deprecation fix with return type ([27410b7](https://github.com/rezozero/intervention-request-bundle/commit/27410b739ba5609d8e9eeb8f11ea140e47623c1a))

## 2.0.1 (2022-09-07)

### Features

* Register `Intervention\Image\ImageManager` as a service with the right driver configured ([3d7181c](https://github.com/rezozero/intervention-request-bundle/commit/3d7181c5393c8b63bc1fe806071015dc2c9e5318))

## 2.0.0 (2022-06-27)

### Features

* updated dependencies, PSR12 code style ([ec3ddea](https://github.com/rezozero/intervention-request-bundle/commit/ec3ddea14599f9649fccda8fa6045099c97990f1))

### Bug Fixes

* Service configuration ([9ab83f8](https://github.com/rezozero/intervention-request-bundle/commit/9ab83f8a87b8272bf96bb95b3e09626b7cb58f65))

