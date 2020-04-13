<?php
/**
 * FastCGI Cache Bust plugin for Craft CMS 3.x
 *
 * Bust the Nginx FastCGI Cache when entries are saved or created.
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2017 nystudio107
 */

namespace nystudio107\fastcgicachebust\assetbundles\fastcgicachebust;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    nystudio107
 * @package   FastcgiCacheBust
 * @since     1.0.0
 */
class FastcgiCacheBustAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = '@nystudio107/fastcgicachebust/assetbundles/fastcgicachebust/dist';

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/FastcgiCacheBust.js',
        ];

        $this->css = [
            'css/FastcgiCacheBust.css',
        ];

        parent::init();
    }
}
