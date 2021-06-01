<?php

namespace App\Repositories;

interface LimitRepositoryInterface
{
    /**
     * limitsの全ての内容を返す
     *
     * @param
     * @return model Limit
     */
    public function getLimitInfos();
}