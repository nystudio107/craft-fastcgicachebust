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

use nystudio107\fastcgicachebust\services\Cache as CacheService;
use yii\base\InvalidConfigException;

/**
 * @author    nystudio107
 * @package   FastcgiCacheBust
 * @since     4.0.0
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
        $config['components'] = [
            'cache' => CacheService::class,
        ];

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
