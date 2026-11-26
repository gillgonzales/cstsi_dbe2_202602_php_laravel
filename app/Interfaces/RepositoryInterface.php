<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface RepositoryInterface {
    public function all(): ?Collection;
    public function findById(int $id): ?Model;
    public function create(array $data): ?Model;
    public function filter(Request $request): ?Collection;
}
