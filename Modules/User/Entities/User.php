<?php

namespace Modules\User\Entities;

use App\Models\BaseModel;
use Hash;

class User extends BaseModel
{
    protected $fillable = ["name", "email", "password"];
    protected $hidden = ["password"];

    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = Hash::make($value);
    }

}
