<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IRepository
{

    /**
     * Find the model with its id
     *
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model;

    /**
     * Returns a collection of model
     *
     * @return Collection|null
     */
    public function all(): Collection;

    /**
     * Saves a model
     *
     * @param array $attributes
     * @return Model|null
     */
    public function save(array $attributes): ?Model;

    /**
     * Updates a model
     *
     * @param Model $model
     * @param array $attributes
     * @return Model|null
     */
    public function update(Model $model, array $attributes): ?Model;

    /**
     * Delete the model by the id provided
     *
     * @param Model $model
     * @return Model|null
     */
    public function delete(Model $model): ?bool;
}
