# FastCGI Cache Bust plugin for Craft CMS 3.x

Bust the Nginx FastCGI Cache when entries are saved or created.

![Screenshot](resources/img/plugin-logo.png)

Related: [FastCGI Cache Bust for Craft 2.x](https://github.com/nystudio107/fastcgicachebust)

## Requirements

This plugin requires Craft CMS 3.0.0-RC1 or later.

## Installation

To install FastCGI Cache Bust, follow these steps:

1. Install with Composer via `composer require nystudio107/craft3-fastcgicachebust` from your project directory
2. Install plugin in the Craft Control Panel under Settings > Plugins

FastCGI Cache Bust works on Craft 3.x.

## FastCGI Cache Bust Overview

FastCGI Cache Bust is a simple plugin that clears your entire FastCGI Cache any time an entry is saved. This is somewhat of a scortched earth approach to cache invalidation, but it ensure cache coherency.

Check out the article [Static Page Caching with Craft CMS](https://nystudio107.com/blog/static-caching-with-craft-cms) for details on how to set up FastCGI Cache on your website.

## Configuring FastCGI Cache Bust

Click on the gear icon next to the plugin to configure it by adding the full absolute path to your Nginx FastCGI Cache directory. If you require more than one FastCGI Cache directory cleared, separate the paths with a comma (`,`).

## Using FastCGI Cache Bust

FastCGI Cache Bust listens for elements being saved, and busts the entire FastCGI Cache automatically when that happens.

You can also manually clear the FastCGI Cache via Craft's 'Clear Caches' tool

## FastCGI Cache Bust Roadmap

Some things to do, and ideas for potential features:

* We could invalidate only affected caches onElementSave instead of the entire cache

Brought to you by [nystudio107](https://nystudio107.com)
