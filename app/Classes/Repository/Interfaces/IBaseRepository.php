<?php

namespace App\Classes\Repository\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface IBaseRepository
 *
 */
interface IBaseRepository
{
    /**
     * Find all records that match a given conditions
     *
     * @param array $conditions
     *
     * @return Collection
     */
    public function find(array $conditions = []);

    /**
     * Find all records that match a given conditions with paginate
     *
     * @param array $conditions
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate(int $pageSize, array $conditions = [], array $relation = []);

    /**
     * Find a specific record that matches a given conditions
     *
     * @param array $conditions
     *
     * @return Model
     */
    public function findOne(array $conditions);

    /**
     * Find a specific record by its ID
     *
     * @param int $id
     *
     * @return Model
     */
    public function findById(?int $id = null);

    /**
     * Create a record
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes);

    /**
     * Update a record
     *
     * @param Model $model
     * @param array $attributes
     *
     * @return bool
     */
    public function update(Model $model, array $attributes = []);

    /**
     * Update a record by id
     *
     * @param $id
     * @param array $attributes
     *
     * @return bool
     */
    public function updateById($id, array $attributes = []);

    /**
     * Save a given record
     *
     * @param Model $model
     *
     * @return boolean
     */
    public function save(Model $model);

    /**
     * Delete the record from the database.
     *
     * @param Model $model
     *
     * @return bool
     *
     * @throws Exception
     */
    public function delete(Model $model);
}
