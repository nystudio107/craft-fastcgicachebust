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
    public function clearAll(): void
    {
        $settings = FastcgiCacheBust::$plugin->getSettings();
        if (!empty($settings) && !empty($settings->cachePath)) {
            $cacheDirs = explode(',', $settings->cachePath);
            foreach ($cacheDirs as $cacheDir) {
                $cacheDir = Craft::parseEnv($cacheDir);
                $cacheDir = trim($cacheDir);
                try {
                    FileHelper::clearDirectory($cacheDir);
                } catch (ErrorException $errorException) {
                    Craft::error($errorException->getMessage(), __METHOD__);
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
}
