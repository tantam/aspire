<?php
/**
 * Created by PhpStorm.
 * User: tam
 * Date: 6/11/18
 * Time: 5:23 PM
 */

namespace Modules\User\Repositories;

/**
 * Class UserRepository
 * @package Modules\User\Repositories
 *
 * @method  User find($id)
 * @method  User create($data)
 * @method  User update($model, array $data)
 * @method  bool|null destroy($model)
 * @method  \Illuminate\Database\Eloquent\Collection || User[] all
 */
use App\Repositories\BaseRepository;
use Modules\User\Entities\User;

interface UserRepository extends BaseRepository
{

}
