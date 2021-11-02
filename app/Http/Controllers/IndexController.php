<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
/**
 * Index Page Controller
 * @category  Controller
 */
class IndexController extends Controller{
	/**
     * index Action
     * @return View
     */
	function index(){
		return view("pages.index.index");
	}

	/**
     * Login Action
     * @return View
     */
	function login(){
		return view("pages.index.login");
	}
}