<?php
/**
 * FastCGI Cache Bust plugin for Craft CMS 3.x
 *
 * Bust the Nginx FastCGI Cache when entries are saved or created.
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2017 nystudio107
 */

namespace nystudio107\fastcgicachebust;

use nystudio107\fastcgicachebust\services\Cache as CacheService;
use nystudio107\fastcgicachebust\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\events\ElementEvent;
use craft\services\Elements;

use yii\base\Event;

/**
 * Class FastcgiCacheBust
 *
 * @author    nystudio107
 * @package   FastcgiCacheBust
 * @since     1.0.0
 *
 * @property  CacheService cache
 */
class FastcgiCacheBust extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var FastcgiCacheBust
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Handler: Elements::EVENT_AFTER_SAVE_ELEMENT
        Event::on(
            Elements::class,
            Elements::EVENT_AFTER_SAVE_ELEMENT,
            function (ElementEvent $event) {
                Craft::trace(
                    'Elements::EVENT_AFTER_SAVE_ELEMENT',
                    __METHOD__
                );
                FastcgiCacheBust::$plugin->cache->clearAll();
            }
        );

        Craft::info(
            Craft::t(
                'fastcgi-cache-bust',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'fastcgi-cache-bust/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
