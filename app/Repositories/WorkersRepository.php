<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Collection;

interface WorkersRepository
{
    public function search(string $query = ''): Collection;
}
