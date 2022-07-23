<?php

namespace App\Repositories;

use App\Models\Workers;
use Illuminate\Database\Eloquent\Collection;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class WorkerRepository.
 */
class EloquentRepository implements WorkersRepository
{
    public function search(string $query = ''): Collection
    {
        return Workers::query()
            ->where('first_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->orWhere('role', 'like', "%{$query}%")
            ->orWhere('company', 'like', "%{$query}%")
            ->get();
    }
}
