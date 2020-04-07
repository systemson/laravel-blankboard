<?php

namespace Systemson\Blankboard\App\Controllers;

use App\Http\Controllers\Controller;
use Systemson\Blankboard\App\Models\Role as Model;

/**
 * 
 */
class RolesController extends Controller
{
    use ResourceCrud;

    protected $baseRoute = 'admin.roles'; 

    protected $modelClass = Model::class;
}
