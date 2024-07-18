<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

use function App\Helpers\setting;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        {
            $user = Auth::user();

            if(!Auth::check()){
                return redirect()->route('login');
            }

            if(!$user->active){
                Auth::logout();
                return redirect()->route('login')->with('error', 'Account inactive');
            }

            $as = $request->route()->action['as'];
            $permission = Permission::where('name', $as)->first();

            $asParts = explode('.', $as);
            $last = end($asParts);

            switch ($last) {
                case 'index':
                    $last = 'show';
                    break;
                case 'store':
                    $last = 'create';
                    break;
                case 'update':
                case 'destroy':
                    $last = 'edit';
                    break;
            }

            $asParts[count($asParts) - 1] = $last;
            $as = implode('.', $asParts);

            if (!$permission) {
                if (setting('auto-generate-permissions')) {
                    $permission = Permission::firstOrCreate([
                        'name' => $as,
                        'guard_name' => 'web'
                    ]);
                } else {
                    if ($user && $user->can($as)) {
                        return $next($request);
                    } else {
                        throw UnauthorizedException::forPermissions([$as]);
                    }
                }
            }

            if($user->hasRole('super-admin')){
                return $next($request);
            }

            if ($user && $user->hasPermissionTo($as)) {
                return $next($request);
            } else {
                throw UnauthorizedException::forPermissions([$as]);
            }
        }
    }
}
