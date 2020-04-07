<?php

namespace Systemson\Blankboard\App\Controllers;

use App\Http\Controllers\Controller;
use Systemson\Blankboard\App\Models\User as Model;

/**
 * 
 */
class UsersController extends Controller
{
    use ResourceCrud;

    protected $baseRoute = 'admin.users';

    protected $modelClass = Model::class;

    /**
     * The avaliable actions for this resource.
     *
     * @var array
     */
    protected $actions = [
        'create',
        //'read',
        'update',
        'delete',
    ];
}
