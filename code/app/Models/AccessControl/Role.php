<?php

namespace App\Models\AccessControl;

use Spatie\Permission\Models\Role as OriginalRole;

class Role extends OriginalRole
{
    protected $connection = 'smsto_mysql';
}
