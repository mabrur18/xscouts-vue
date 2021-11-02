<?php
namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;
class Rbac
{
	/**
	* Handle an incoming request.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \Closure  $next
	* @return mixed
	*/
	public function handle($request, Closure $next)
	{
		$page = $request->segment(1, "home");
		$action = $request->segment(2, "list");
		$user = $request->user();
		if ($action == "index") {
			$action = "list";
		}
		$page_action = strtolower("$page/$action");
		if (!$user->can($page_action)) {
			return abort(403, "Forbidden");
		}
		return $next($request);
	}
}
