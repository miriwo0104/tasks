<?php

namespace App\Repositories;

use App\Models\Limit;

class LimitRepository implements LimitRepositoryInterface
{
    /**
     *
     * @var Limit
     */
    private $Limit;

    /**
     *
     * @param Limit $Limit
     */
    public function __construct(Limit $Limit)
    {
        $this->Limit = $Limit;
    }

    /**
     * limitsの全ての内容を返す
     *
     * @param
     * @return model Limit
     */
    public function getLimitInfos()
    {
        return $this->Limit->get();
    }
}