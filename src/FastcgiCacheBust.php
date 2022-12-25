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

use Craft;
use craft\base\Element;
use craft\base\Plugin;
use craft\elements\Entry;
use craft\events\DeleteTemplateCachesEvent;
use craft\events\ElementEvent;
use craft\events\RegisterCacheOptionsEvent;
use craft\services\Elements;
use craft\services\TemplateCaches;
use craft\utilities\ClearCaches;
use nystudio107\fastcgicachebust\models\Settings;
use nystudio107\fastcgicachebust\services\ServicesTrait;
use yii\base\Event;
use yii\base\Exception;
use function get_class;

/**
 * Class FastcgiCacheBust
 *
 * @author    nystudio107
 * @package   FastcgiCacheBust
 * @since     1.0.0
 */
class FastcgiCacheBust extends Plugin
{
    // Traits
    // =========================================================================

    use ServicesTrait;

    // Static Properties
    // =========================================================================

    /**
     * @var FastcgiCacheBust
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    /**
     * @var bool
     */
    public $hasCpSection = false;

    /**
     * @var bool
     */
    public $hasCpSettings = true;

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
                // Only bust the cache if it's not certain excluded element types
                if ($this->shouldBustCache($element)) {
                    Craft::debug(
                        'Cache busted due to saving: ' . get_class($element) . ' - ' . $element->title,
                        __METHOD__
                    );
                    FastcgiCacheBust::$plugin->cache->clearAll();
                }
            }
        );
        // Handler: TemplateCaches::EVENT_AFTER_DELETE_CACHES
        Event::on(
            TemplateCaches::class,
            TemplateCaches::EVENT_AFTER_DELETE_CACHES,
            static function (DeleteTemplateCachesEvent $event) {
                FastcgiCacheBust::$plugin->cache->clearAll();
            }
        );
        // Handler: ClearCaches::EVENT_REGISTER_CACHE_OPTIONS
        Event::on(
            ClearCaches::class,
            ClearCaches::EVENT_REGISTER_CACHE_OPTIONS,
            static function (RegisterCacheOptionsEvent $event) {
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
     * Determine whether the cache should be busted or not based on the $element
     *
     * @param Element $element
     *
     * @return bool
     */
    protected function shouldBustCache(Element $element): bool
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
        try {
            return Craft::$app->view->renderTemplate(
                'fastcgi-cache-bust/settings',
                [
                    'settings' => $this->getSettings(),
                ]
            );
        } catch (Exception $e) {
            Craft::error($e->getMessage(), __METHOD__);
            return '';
        }
    }
}
