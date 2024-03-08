<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepository as BaseRepositoryContract;
use Illuminate\Support\Arr;

abstract class BaseRepository implements BaseRepositoryContract
{
    protected mixed $model;

    /** BaseRepository constructor. */
    public function __construct(mixed $model = null)
    {
        $this->model = $model;
    }


    public function updateOrCreate(array $attributes): void
    {
//        TODO it is not recommended to use a foreach
        foreach ($attributes as $currencyData) {
            $this->model->updateOrCreate(
                ['char_code' => $currencyData['char_code']],
                Arr::only($currencyData, ['name', 'value'])
            );
        }
    }


}
