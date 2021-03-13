<?php

namespace App\Services;

use App\Repositories\LimitRepositoryInterface as LimitRepository;

class LimitService
{
    /**
     *
     * @var Limit
     */
    private $LimitRepository;

    /**
     *
     * @param LimitRepository $LimitRepository
     */
    public function __construct(LimitRepository $LimitRepository)
    {
        $this->LimitRepository = $LimitRepository;
    }

    /**
     * limitsの全ての内容を返す
     *
     * @param
     * @return model Limit
     */
    public function getLimitInfos()
    {
        return $this->LimitRepository->getLimitInfos();
    }
}
