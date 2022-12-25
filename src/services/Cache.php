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

use Craft;
use craft\base\Component;
use craft\base\Element;
use craft\elements\Entry;
use craft\helpers\FileHelper;
use nystudio107\fastcgicachebust\FastcgiCacheBust;
use nystudio107\fastcgicachebust\models\Settings;
use yii\base\ErrorException;

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
         * @var Settings $settings
         */
        $settings = FastcgiCacheBust::$plugin->getSettings();
        if ($settings !== null && !empty($settings->cachePath)) {
            $cacheDirs = explode(',', $settings->cachePath);
            foreach ($cacheDirs as $cacheDir) {
                $cacheDir = Craft::parseEnv($cacheDir);
                $cacheDir = trim($cacheDir);
                try {
                    FileHelper::clearDirectory($cacheDir);
                } catch (ErrorException $e) {
                    Craft::error($e->getMessage(), __METHOD__);
                }
                Craft::info(
                    Craft::t(
                        'fastcgi-cache-bust',
                        'FastCGI Cache busted: `' . $cacheDir
                    ),
                    __METHOD__
                );
            }
        }
    }

    /**
     * Determine whether the cache should be busted or not based on the $element
     *
     * @param Element $element
     *
     * @return bool
     */
    public function shouldBustCache(Element $element): bool
    {
        $bustCache = true;
        // Only bust the cache if the element is ENABLED or LIVE
        if (($element->getStatus() !== Element::STATUS_ENABLED)
            && ($element->getStatus() !== Entry::STATUS_LIVE)
        ) {
            $bustCache = false;
        }

        return $bustCache;
    }
}
