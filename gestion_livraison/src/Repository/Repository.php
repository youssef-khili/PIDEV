<?php declare(strict_types=1);

namespace App\Repository;

/**
 * Interface Repository
 * @package App\Repository
 */
interface Repository
{
    /**
     * @param int $id
     *
     * @return mixed
     */
    public function load(int $id);
}
