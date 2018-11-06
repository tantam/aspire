<?php
/**
 * Created by PhpStorm.
 * User: tam
 * Date: 6/11/18
 * Time: 5:52 PM
 */

namespace Modules\User\Repositories\Eloquent;


use App\Repositories\Eloquent\EloquentBaseRepository;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;

class EloquentUserRepository extends EloquentBaseRepository implements UserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
