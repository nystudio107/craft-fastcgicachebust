[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nystudio107/craft-fastcgicachebust/badges/quality-score.png?b=v1)](https://scrutinizer-ci.com/g/nystudio107/craft-fastcgicachebust/?branch=v1) [![Code Coverage](https://scrutinizer-ci.com/g/nystudio107/craft-fastcgicachebust/badges/coverage.png?b=v1)](https://scrutinizer-ci.com/g/nystudio107/craft-fastcgicachebust/?branch=v1) [![Build Status](https://scrutinizer-ci.com/g/nystudio107/craft-fastcgicachebust/badges/build.png?b=v1)](https://scrutinizer-ci.com/g/nystudio107/craft-fastcgicachebust/build-status/v1) [![Code Intelligence Status](https://scrutinizer-ci.com/g/nystudio107/craft-fastcgicachebust/badges/code-intelligence.svg?b=v1)](https://scrutinizer-ci.com/code-intelligence)

# FastCGI Cache Bust plugin for Craft CMS 3.x

Bust the Nginx FastCGI Cache when entries are saved or created.

![Screenshot](./resources/img/plugin-logo.png)

Related: [FastCGI Cache Bust for Craft 2.x](https://github.com/nystudio107/fastcgicachebust)

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

To install FastCGI Cache Bust, follow these steps:

1. Install with Composer via `composer require nystudio107/craft-fastcgicachebust` from your project directory
2. Install the plugin via `./craft install/plugin fastcgi-cache-bust` via the CLI, or in the Control Panel, go to Settings → Plugins and click the “Install” button for FastCGI Cache Bust.

You can also install FastCGI Cache Bust via the **Plugin Store** in the Craft Control Panel.

FastCGI Cache Bust works on Craft 3.x.

## FastCGI Cache Bust Overview

FastCGI Cache Bust is a simple plugin that clears your entire FastCGI Cache any time an entry is saved. This is somewhat of a scortched earth approach to cache invalidation, but it ensure cache coherency.

Check out the article [Static Page Caching with Craft CMS](https://nystudio107.com/blog/static-caching-with-craft-cms) for details on how to set up FastCGI Cache on your website.

## Configuring FastCGI Cache Bust

Click on the gear icon next to the plugin to configure it by adding the full absolute path to your Nginx FastCGI Cache directory. If you require more than one FastCGI Cache directory cleared, separate the paths with a comma (`,`).

## Using FastCGI Cache Bust

FastCGI Cache Bust listens for elements being saved, and busts the entire FastCGI Cache automatically when that happens.

FastCGI Cache Bust will also bust the entire FastCGI Cache whenever Template caches are deleted.

You can also manually clear the FastCGI Cache via Craft's 'Clear Caches' tool

## FastCGI Cache Bust Roadmap

Some things to do, and ideas for potential features:

* We could invalidate only affected caches onElementSave instead of the entire cache

Brought to you by [nystudio107](https://nystudio107.com)
