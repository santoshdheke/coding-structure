<?php

namespace SsGroup\Repo;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;

abstract class Repository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Repository constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->model = $this->makeModel($app);
    }

    /**
     * Get model name with namespace
     *
     * @return String
     */
    abstract function getModel();

    /**
     * Get model
     *
     * @param Application $app
     * @return Model
     */
    protected function makeModel($app)
    {
        return $app->make($this->getModel());
    }

    /**
     * Get all resources
     *
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = array('*'))
    {
        return $this->model->all($columns);
    }


    /**
     * Get paginated resources with given limit
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($limit = 15)
    {
        return $this->model->paginate($limit);
    }
    /**
     * Store newly created resource
     * @param array $data
     * @return Model
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update specific resource.
     * @param array $data
     * @param $id
     * @return bool
     */
    public function update($id,array $data)
    {
        return $this->model->find($id)->update($data);
    }

    /**
     * Delete specific resource
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Find specific resource
     * @param $id
     * @param array $columns
     * @return Object
     */
    public function find($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Find specific resource or fail
     * @param $id
     * @param array $columns
     * @return Object
     */
    public function findOrFail($id, $columns = array('*'))
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * get first resource
     *
     * @param array $columns
     * @return mixed
     */
    public function first($id,$columns = array('*'))
    {
        return $this->model->first($columns);
    }

    /**
     * Find specific resource by given attribute
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return Object
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * get resource by given attribute
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return Collection
     */
    public function getBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->get($columns);
    }

    public function getBySortable($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->orderBy('rank')->get($columns);
    }

    /**
     * Find specific resource by given attribute
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return Object
     */
    public function findByOrFail($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->firstorfail($columns);
    }


}
