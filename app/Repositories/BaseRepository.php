<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepository as BaseRepositoryContract;

abstract class BaseRepository implements BaseRepositoryContract
{
    protected mixed $model;

    /** BaseRepository constructor. */
    public function __construct(mixed $model = null)
    {
        $this->model = $model;
    }

}
