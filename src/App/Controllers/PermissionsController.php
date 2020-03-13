<?php

namespace Systemson\Blankboard\App\Controllers;

use App\Http\Controllers\Controller;
use Systemson\Blankboard\App\Models\Permission as Model;

/**
 *
 */
class PermissionsController extends Controller
{
    use ResourceCrud;

    protected $baseRoute = 'admin.permissions';

    protected $modelClass = Model::class;
}
