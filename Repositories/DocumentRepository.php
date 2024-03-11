<?php

namespace Modules\Certificate\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface DocumentRepository extends BaseRepository
{
    /**
     * @param int $id
     * @param string $key
     * @return mixed
     */
    public function whereByKey(int $id,string $key);


    /**
     * @param array $ids
     * @return mixed
     */
    public function whereByIds(array $ids);

}
