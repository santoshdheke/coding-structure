<?php

namespace SsGroup\Repo;

use Illuminate\Database\Eloquent\Collection;


interface RepositoryInterface
{
    /**
     * Get all resources
     * @param array $columns
     * @return Collection
     */
    public function all($columns = array('*'));

    /**
     * Get paginated resources with given limit
     * @param $limit
     * @return Collection
     */
    public function paginate($limit);

    /**
     * Store newly created resource
     * @param array $data
     * @return Object
     */
    public function store(array $data);

    /**
     * Update specific resource.
     * @param array $data
     * @param $id
     * @return bool
     */
    public function update($id,array $data);

    /**
     * Delete specific resource
     * @param $id
     * @return bool
     */
    public function delete($id);

    /**
     * find first resource
     * @param $id
     * @return bool
     */
    public function first($id,$data = array('*'));

    /**
     * Find specific resource
     * @param $id
     * @param array $columns
     * @return Object
     */
    public function find($id, $columns = array('*'));

    /**
     * Find specific resource or abort
     * @param $id
     * @param array $columns
     * @return Object
     */
    public function findOrFail($id, $columns = array('*'));

    /**
     * Find specific resource by given attribute
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return Object
     */
    public function findBy($attribute,$value,$columns = array('*'));

    /**
     * Find specific resource by given attribute
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return Collection
     */
    public function getBy($attribute,$value,$columns = array('*'));

    /**
     * Find specific resource by given attribute
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return Object
     */
    public function findByOrFail($attribute,$value,$columns = array('*'));


}