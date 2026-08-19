<?php

namespace CSTSI\Dbe2\interfaces;

interface iDAO
{
    public function create(object $data): bool;
    public function read(int | null $id = null): array | bool;
    public function update(object $data): bool;
    public function delete(int $id): bool;
}
