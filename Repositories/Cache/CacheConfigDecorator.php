<?php

namespace Modules\Certificate\Repositories\Cache;

use Modules\Certificate\Repositories\ConfigRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheConfigDecorator extends BaseCacheDecorator implements ConfigRepository
{
    public function __construct(ConfigRepository $config)
    {
        parent::__construct();
        $this->entityName = 'certificate.configs';
        $this->repository = $config;
    }
}
