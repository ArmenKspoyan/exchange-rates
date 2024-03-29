<?php

declare(strict_types=1);

namespace App\Repositories\Currency;

use App\Models\CurrencyRate;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\Currency\ICurrencyRepository;

final class CurrencyRepository extends BaseRepository implements ICurrencyRepository
{
    public function __construct(CurrencyRate $model)
    {
        parent::__construct($model);
    }



}
