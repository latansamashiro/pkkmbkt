<?php

namespace App\Http\Middleware;

/* -------------------------------------
 terdapat 5 Roles:
- super-admin
- advisor (pembimbing)
- mentor
- student (mahasiswa)
- committee (panitia)
----------------------------------------*/

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $pageRoles = [];
        foreach ($roles as $role) {
            $pageRoles[] = $role;
        }
        $currentRole = '';
        $userRole = $request->user()->role_name;
        if ($userRole) {
            $currentRole = strtolower($userRole);
            if (!in_array($currentRole, $pageRoles)) {
                return redirect(route('dashboard'))->with('error', 'Anda tidak memiliki hak akses untuk mengakses halaman ini');
            }
            return $next($request);
        }
        return redirect(route('dashboard'))->with('error', 'Hak akses tidak terdaftar');
    }
}
