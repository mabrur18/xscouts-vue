<?php 
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Components data Model
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Model
 */
class ComponentsData{
	

	/**
     * Check if value already exist in User table
	 * @param string $value
     * @return bool
     */
	function user_username_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('user')->where('username', $value)->value('username');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * Check if value already exist in User table
	 * @param string $value
     * @return bool
     */
	function user_email_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('user')->where('email', $value)->value('email');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * user_role_option_list Model Action
     * @return array
     */
	function user_role_option_list(){
		$sqltext = "SELECT  DISTINCT name AS value,name AS label FROM roles ORDER BY name";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * getcount_newxscouts Model Action
     * @return int
     */
	function getcount_newxscouts(){
		$sqltext = "SELECT COUNT(*) AS num FROM pitch_xscouts WHERE review_status=''";
		$query_params = [];
		$val = DB::selectOne(DB::raw($sqltext), $query_params);
		return $val->num;
	}
	

	/**
     * getcount_reviewedxscouts Model Action
     * @return int
     */
	function getcount_reviewedxscouts(){
		$sqltext = "SELECT COUNT(*) AS num FROM pitch_xscouts WHERE review_status='Yes'";
		$query_params = [];
		$val = DB::selectOne(DB::raw($sqltext), $query_params);
		return $val->num;
	}
}
