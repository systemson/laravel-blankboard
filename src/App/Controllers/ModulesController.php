<?php

namespace Systemson\Blankboard\App\Controllers;

use App\Http\Controllers\Controller;
use Systemson\Blankboard\App\Models\Module as Model;

/**
 * 
 */
class ModulesController extends Controller
{
    use ResourceCrud;

    protected $baseRoute = 'admin.modules';

    protected $modelClass = Model::class;
}
