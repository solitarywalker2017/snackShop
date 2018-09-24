<?php

namespace app\api\model;

use think\Model;

class UserAddress extends Model
{
    protected $hidden = ['id', 'user_id', 'delete_time', 'update_time'];
}
