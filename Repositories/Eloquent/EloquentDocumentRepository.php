<?php

namespace Modules\Certificate\Repositories\Eloquent;

use Modules\Certificate\Repositories\DocumentRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentDocumentRepository extends EloquentBaseRepository implements DocumentRepository
{
    /**
     * @inheritDoc
     */
    public function whereByKey(int $id, string $key)
    {
        return $this->model->where('id',$id)->where('key',$key)->first();
    }

    public function whereByIds(array $ids)
    {
        return $this->model->whereIn('id',$ids)->get();
    }
}
