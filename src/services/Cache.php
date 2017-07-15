<?php
/**
 * FastCGI Cache Bust plugin for Craft CMS 3.x
 *
 * Bust the Nginx FastCGI Cache when entries are saved or created.
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2017 nystudio107
 */

namespace nystudio107\fastcgicachebust\services;

use nystudio107\fastcgicachebust\FastcgiCacheBust;
use nystudio107\fastcgicachebust\models\Settings;

use Craft;
use craft\base\Component;
use craft\helpers\FileHelper;

/**
 * @author    nystudio107
 * @package   FastcgiCacheBust
 * @since     1.0.0
 */
class Cache extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * Clears the entirety of the FastCGI Cache
     */
    public function clearAll()
    {
        /**
         * @var Settings settings
         */
        $settings = FastcgiCacheBust::$plugin->getSettings();
        if (!empty($settings)) {
            if (!empty($settings->cachePath)) {
                FileHelper::clearDirectory($settings->cachePath);
                Craft::info(
                    Craft::t(
                        'fastcgi-cache-bust',
                        'FastCGI Cache busted: `' . $settings->cachePath
                    ),
                    __METHOD__
                );
            }
        }
    }
}
