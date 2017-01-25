<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = ['name', 'display_name','description'];
}
