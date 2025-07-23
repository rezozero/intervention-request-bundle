# Changelog

All notable changes to project will be documented in this file.

## [5.1.0](https://github.com/rezozero/intervention-request-bundle/compare/5.0.2...5.1.0) - 2025-07-23

### Features

- Update intervention-request to v7 and upgrade DefaultController - ([989fba2](https://github.com/rezozero/intervention-request-bundle/commit/989fba29393f85ffde4d44ae333f20aa828f6363)) - Ambroise Maupate

### Refactor

- Update intervention-request version constraint to ^7.0 - ([d334df9](https://github.com/rezozero/intervention-request-bundle/commit/d334df987ae4927063668c4dba763fbfa7e3f55b)) - Ambroise Maupate

## [5.0.2](https://github.com/rezozero/intervention-request-bundle/compare/5.0.1...5.0.2) - 2025-07-23

### Bug Fixes

- Update intervention-request version constraint and relax phpstan dependencies - ([20fa631](https://github.com/rezozero/intervention-request-bundle/commit/20fa631f76c7d008c53ef69a77e2ddfb2f383a2e)) - Ambroise Maupate

## [5.0.1](https://github.com/rezozero/intervention-request-bundle/compare/5.0.0...5.0.1) - 2025-05-28

### Bug Fixes

- Update driver argument syntax in ImageManager ([#3](https://github.com/rezozero/intervention-request-bundle/issues/3)) - ([18bf04a](https://github.com/rezozero/intervention-request-bundle/commit/18bf04a5f03ed1e79c74ef1471e517e744a38198)) - Eliot
- Missing ImageEncoderInterface service declaration - ([4652af3](https://github.com/rezozero/intervention-request-bundle/commit/4652af3ff3b0fc9411c498d51f3aacb7f562206b)) - Ambroise Maupate

## [5.0.0](https://github.com/rezozero/intervention-request-bundle/compare/4.1.0...5.0.0) - 2025-05-27

### Features

- Update intervention-request to ^6.0 ([#2](https://github.com/rezozero/intervention-request-bundle/issues/2)) - ([58249e3](https://github.com/rezozero/intervention-request-bundle/commit/58249e3c973f6e15157a779fa26965aab6037cf1)) - Eliot

## [4.1.0](https://github.com/rezozero/intervention-request-bundle/compare/4.0.0...4.1.0) - 2025-04-07

### Features

- Upgrade IR dependency and route queryString regex to allow dot in processors - ([9b159d3](https://github.com/rezozero/intervention-request-bundle/commit/9b159d3e03b164f317cd27eb36522fedfdd0930e)) - Ambroise Maupate

## [4.0.0](https://github.com/rezozero/intervention-request-bundle/compare/3.0.1...4.0.0) - 2025-02-27

### ⚠ Breaking changes

- Requires php82 minimum and `ambroisemaupate/intervention-request` >= 5.0.0

### Features

-  [**breaking**]Requires php82 minimum and `ambroisemaupate/intervention-request` >= 5.0.0 - ([1023e46](https://github.com/rezozero/intervention-request-bundle/commit/1023e46ba8cde8f97912d63152e3cf5b5b05a7c2)) - Ambroise Maupate

## [3.0.1](https://github.com/rezozero/intervention-request-bundle/compare/3.0.0...3.0.1) - 2024-12-02

### CI/CD

- PHP_CS_FIXER_IGNORE_ENV - ([93d2268](https://github.com/rezozero/intervention-request-bundle/commit/93d2268c94e0b6724486fc2031d1ca56e74f3f09)) - Ambroise Maupate

### Features

- Updated dependencies and allow php8.4 - ([83d9248](https://github.com/rezozero/intervention-request-bundle/commit/83d924826a81f2ce811d1dfba7bd9cfefd086c0b)) - Ambroise Maupate

## [3.0.0](https://github.com/rezozero/intervention-request-bundle/compare/2.0.4...3.0.0) - 2023-02-10

### ⚠ Breaking changes

- Requires php80 minimum

### Features

- Update InterventionRequest signature with FileResolverInterface - ([a81af8d](https://github.com/rezozero/intervention-request-bundle/commit/a81af8d9d979a8e4830b146d1cb1f1dc73a68c0c)) - Ambroise Maupate
- Automatically wire existing Flysystem `intervention_request.storage` - ([a8d67aa](https://github.com/rezozero/intervention-request-bundle/commit/a8d67aa180e68cb5239d3eb9295f81f923fc5733)) - Ambroise Maupate
- Added compilerPass to get intervention_request.storage reference - ([79c7cc4](https://github.com/rezozero/intervention-request-bundle/commit/79c7cc4af56fe2da50e9497df8c7885ad47c7289)) - Ambroise Maupate
-  [**breaking**]Requires php80 minimum - ([e729358](https://github.com/rezozero/intervention-request-bundle/commit/e729358c16d35cc0505d19f2dfc34bd9e577e672)) - Ambroise Maupate

### Testing

- Added Github actions - ([30fd85d](https://github.com/rezozero/intervention-request-bundle/commit/30fd85d290f12811224343ba5956dc5ef141d878)) - Ambroise Maupate

## [2.0.4](https://github.com/rezozero/intervention-request-bundle/compare/2.0.3...2.0.4) - 2022-11-14

### Bug Fixes

- Do not validate configuration values, this is not compatible with DotEnv late-resolution - ([889e885](https://github.com/rezozero/intervention-request-bundle/commit/889e88521ab3dc6750f7d41afacf51bb1427a155)) - Ambroise Maupate

## [2.0.3](https://github.com/rezozero/intervention-request-bundle/compare/2.0.2...2.0.3) - 2022-11-10

### Bug Fixes

- Do not cast default quality and max pixel sizes parameters as it breaks DotEnv lazy resolution - ([4bb5327](https://github.com/rezozero/intervention-request-bundle/commit/4bb5327d791b39dad31d46a29d6ef79c63410831)) - Ambroise Maupate

## [2.0.2](https://github.com/rezozero/intervention-request-bundle/compare/2.0.1...2.0.2) - 2022-11-08

### Bug Fixes

- Deprecation fix with return type - ([27410b7](https://github.com/rezozero/intervention-request-bundle/commit/27410b739ba5609d8e9eeb8f11ea140e47623c1a)) - Ambroise Maupate

## [2.0.1](https://github.com/rezozero/intervention-request-bundle/compare/2.0.0...2.0.1) - 2022-09-07

### Features

- Register Intervention\Image\ImageManager as a service with the right driver configured - ([3d7181c](https://github.com/rezozero/intervention-request-bundle/commit/3d7181c5393c8b63bc1fe806071015dc2c9e5318)) - Ambroise Maupate

## [2.0.0](https://github.com/rezozero/intervention-request-bundle/compare/1.1.0...2.0.0) - 2022-06-27

### Bug Fixes

- Service configuration - ([9ab83f8](https://github.com/rezozero/intervention-request-bundle/commit/9ab83f8a87b8272bf96bb95b3e09626b7cb58f65)) - Ambroise Maupate

### CI/CD

- Added travis-ci.com - ([2349522](https://github.com/rezozero/intervention-request-bundle/commit/2349522eb36eb59535741d2b691c6d84644fdf51)) - Ambroise Maupate

### Features

- updated dependencies, PSR12 code style - ([ec3ddea](https://github.com/rezozero/intervention-request-bundle/commit/ec3ddea14599f9649fccda8fa6045099c97990f1)) - Ambroise Maupate

### Refactor

- hard-code _locale in route param to prevent resolving one - ([6debe5c](https://github.com/rezozero/intervention-request-bundle/commit/6debe5c8046150819cebd6774de4d619c30873e5)) - Ambroise Maupate

<!-- generated by git-cliff -->
