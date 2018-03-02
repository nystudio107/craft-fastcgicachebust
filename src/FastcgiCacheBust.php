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
use craft\base\Element;
use craft\base\Plugin;
use craft\elements\Entry;
use craft\events\ElementEvent;
use craft\events\RegisterCacheOptionsEvent;
use craft\services\Elements;
use craft\utilities\ClearCaches;

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
                Craft::debug(
                    'Elements::EVENT_AFTER_SAVE_ELEMENT',
                    __METHOD__
                );
                /** @var Element $element */
                $element = $event->element;
                $isNewElement = $event->isNew;
                $bustCache = true;
                // Only bust the cache if the element is ENABLED or LIVE
                if (($element->getStatus() != Element::STATUS_ENABLED)
                    && ($element->getStatus() != Entry::STATUS_LIVE)
                ) {
                    $bustCache = false;
                }
                // Only bust the cache if it's not certain excluded element types
                /* @TODO: These need to be updated once the plugins are released for Craft 3
                if (($element instanceof 'SproutSeo_Redirect')
                    || ($element instanceof 'PushNotifications_Device')
                ) {
                    $bustCache = false;
                }
                */
                if ($bustCache) {
                    Craft::debug(
                        "Cache busted due to saving: " . get_class($element) . " - " . $element->title,
                        __METHOD__
                    );
                    FastcgiCacheBust::$plugin->cache->clearAll();
                }
            }
        );

        // Handler: ClearCaches::EVENT_REGISTER_CACHE_OPTIONS
        Event::on(
            ClearCaches::class,
            ClearCaches::EVENT_REGISTER_CACHE_OPTIONS,
            function (RegisterCacheOptionsEvent $event) {
                $event->options[] = [
                    'key' => 'fastcgi-cache-bust',
                    'label' => Craft::t('fastcgi-cache-bust', 'FastCGI Cache'),
                    'action' => function () {
                        FastcgiCacheBust::$plugin->cache->clearAll();
                    },
                ];
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
