<?php

namespace App\Models\AccessControl;

use Spatie\Permission\Models\Permission as OriginalPermission;

class Permission extends OriginalPermission
{
    protected $connection = 'smsto_mysql';
}
