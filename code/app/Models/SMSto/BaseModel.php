<?php

namespace App\Models\SMSto;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $connection = 'smsto_mysql';
}
