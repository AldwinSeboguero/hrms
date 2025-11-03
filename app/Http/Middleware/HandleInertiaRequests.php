<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Http\Middleware\Permission;
class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth'=> [
                'user' => $request->user() ? $request->user() : null,
                'permissionNames' => $request->user() ? $request->user()->getPermissionNames() : null, // collection of name strings
                'permissions' => $request->user() ? $request->user()->permissions : null, // collection of permission objects

                // get all permissions for the user, either directly, or from roles, or from both
                'DirectPermissions' => $request->user() ? $request->user()->getDirectPermissions() : null,
                'PermissionsViaRoles' => $request->user() ? $request->user()->getPermissionsViaRoles() : null,
                'AllPermissions' => $request->user() ? $request->user()->getAllPermissions() : null,

                // get the names of the user's roles
                'roles' => $request->user() ? $request->user()->getRoleNames() : null, // Returns a collection
            ],
                 'can' => [
            'createTask' => auth()->user() ? auth()->user()->can('task_create'): null,
            'editTask' => auth()->user() ? auth()->user()->can('edit timesheets'): null,
            'destroyTask' => auth()->user() ? auth()->user()->can('task_destroy'): null,
        ],
      
        ]);
    }
}
