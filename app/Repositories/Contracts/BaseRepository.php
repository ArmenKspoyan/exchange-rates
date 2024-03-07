<?php

declare(strict_types=1);


namespace App\Repositories\Contracts;

/**
 * Interface BaseRepositoryInterface.
 */
interface BaseRepository
{

    public function updateOrCreate(array $attributes): void;

}
