<?php

namespace Modules\Certificate\Repositories\Cache;

use Modules\Certificate\Repositories\DocumentRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheDocumentDecorator extends BaseCacheDecorator implements DocumentRepository
{
    public function __construct(DocumentRepository $document)
    {
        parent::__construct();
        $this->entityName = 'certificate.documents';
        $this->repository = $document;
    }

    /**
     * @inheritDoc
     */
    public function whereByKey(int $id, string $key)
    {
        return $this->remember(function () use ($id,$key) {
            return $this->repository->whereByKey($id,$key);
        });
    }

    /**
     * @inheritDoc
     */
    public function whereByIds(array $ids)
    {
        return $this->remember(function () use ($ids) {
            return $this->repository->whereByIds($ids);
        });
    }
}
