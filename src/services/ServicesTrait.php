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

use craft\helpers\ArrayHelper;
use nystudio107\fastcgicachebust\services\Cache as CacheService;
use yii\base\InvalidConfigException;

/**
 * @author    nystudio107
 * @package   FastcgiCacheBust
 * @since     1.0.11
 *
 * @property  CacheService cache
 */
trait ServicesTrait
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function __construct($id, $parent = null, array $config = [])
    {
        // Merge in the passed config, so it our config can be overridden by Plugins::pluginConfigs['recipe']
        // ref: https://github.com/craftcms/cms/issues/1989
        $config = ArrayHelper::merge([
            'components' => [
                'cache' => CacheService::class,
            ]
        ], $config);

        parent::__construct($id, $parent, $config);
    }

    /**
     * Returns the nutritionApi service
     *
     * @return CacheService The cache service
     * @throws InvalidConfigException
     */
    public function getCache(): CacheService
    {
        return $this->get('cache');
    }
}
