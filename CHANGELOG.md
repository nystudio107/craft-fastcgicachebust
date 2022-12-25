# FastCGI Cache Bust Changelog

## 4.0.0 - 2022.12.24
### Changed
* Don't bust the cache if the element being saved is a draft or revision ([#37](https://github.com/nystudio107/craft-fastcgicachebust/issues/37))
* Updated docs to use Vitepress `^1.0.0-alpha.29`
* Added `allow-plugins` to `composer.json` to fix CI

## 4.0.0-beta.1 - 2022.03.12
### Added
* Initial Craft CMS 4 compatibility

## 1.0.10 - 2022.03.12

### Added
* Added the ability to use environment variables and aliases in the **FastCGI Cache Path** setting ([#9](https://github.com/nystudio107/craft-fastcgicachebust/issues/9))
* Added `.gitattributes` & `CODEOWNERS`

### Changed

* Refactored from `composer.json` `extra` to `__construct()` and object properties
* Switched documentation system to VitePress

## 1.0.9 - 2020.04.16
### Added
* Fixed Asset Bundle namespace case

## 1.0.8 - 2018.04.14
### Added
* The FastCGI Cache will now also be cleared whenever Template caches are deleted

### Changed
* Refactored out to `shouldBustCache` method
* Code cleanup

## 1.0.7 - 2018.03.20
### Changed
* Added a config file override warning to the Settings page
* Fixed inconsistent quotes in the `config.php`

## 1.0.6 - 2018.03.02
### Changed
* Fixed deprecation errors from Craft CMS 3 RC13

## 1.0.5 - 2018.02.01
### Added
* Renamed the composer package name to `craft-fastcgicachebust`

## 1.0.4 - 2017.12.06
### Added
* You can have more than one cache to have it clear by separating the paths with a comma (`,`) in the config settings

### Changed
* Updated to require craftcms/cms `^3.0.0-RC1`

## 1.0.3 - 2017.11.27
### Changed
* Don't bust the FastCGI Cache unless the element being saved is ENABLED or LIVE
* Don't bust the FastCGI Cache for certain custom ElementTypes

## 1.0.2 - 2017.08.12
### Changed
* Added 'FastCGI Cache' to the list of things that can be cleared via Craft's Clear Caches tool

## 1.0.1 - 2017.07.15
### Changed
* Craft 3 beta 20 compatibility

## 1.0.0 - 2017.06.16
### Added
- Initial release
