<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface TeamRepositoryInterface
{
    /**
     * @return Collection
     */
    public function index(): Collection;
}
