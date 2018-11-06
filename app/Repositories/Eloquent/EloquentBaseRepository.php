<?php
/**
 * Created by PhpStorm.
 * User: tam
 * Date: 6/11/18
 * Time: 5:25 PM
 */

namespace App\Repositories\Eloquent;


use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentBaseRepository implements BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * EloquentBaseRepository constructor.
     * @param Model $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function all()
    {
        return $this->getModel()->all();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find($id)
    {
        return $this->getModel()->findOrFail($id);
    }

    /**
     * @param $data
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    public function create($data)
    {
        return $this->getModel()->create($data);
    }

    /**
     * @param $model
     * @param array $data
     * @return Model
     */
    public function update($model, $data)
    {
        $model->fill($data);
        $model->save();
        return $model;
    }


    /**
     * @param $model
     * @return bool
     */
    public function destroy($model)
    {
        return $model->delete();
    }

}
