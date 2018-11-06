<?php
/**
 * Created by PhpStorm.
 * User: tam
 * Date: 6/11/18
 * Time: 5:24 PM
 */

namespace App\Repositories;



interface BaseRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     */
    public function getModel();

    /**
     * @return \Illuminate\Database\Eloquent\Model[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find($id);

    /**
     * @param $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($data);

    /**
     * @param $model
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($model, $data);

    /**
     * @param $model
     * @return boolean
     */
    public function destroy($model);
}
