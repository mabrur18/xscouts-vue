<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role_Has_PermissionsAddRequest;
use App\Http\Requests\Role_Has_PermissionsEditRequest;
use App\Models\Role_Has_Permissions;
use Illuminate\Http\Request;
use Exception;
class Role_Has_PermissionsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.role_has_permissions.list";
		$query = Role_Has_Permissions::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Role_Has_Permissions::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "role_has_permissions.role_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Role_Has_Permissions::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Role_Has_Permissions::query();
		$record = $query->findOrFail($rec_id, Role_Has_Permissions::viewFields());
		return $this->renderView("pages.role_has_permissions.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.role_has_permissions.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Role_Has_PermissionsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Role_Has_Permissions record
		$record = Role_Has_Permissions::create($modeldata);
		$rec_id = $record->role_id;
		return $this->redirect("role_has_permissions", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Role_Has_PermissionsEditRequest $request, $rec_id = null){
		$query = Role_Has_Permissions::query();
		$record = $query->findOrFail($rec_id, Role_Has_Permissions::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("role_has_permissions", "Record updated successfully");
		}
		return $this->renderView("pages.role_has_permissions.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Role_Has_Permissions::query();
		$query->whereIn("role_id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
	private function getNextRecordId($rec_id){
		$query = Role_Has_Permissions::query();
		$query->where('role_id', '>', $rec_id);
		$query->orderBy('role_id', 'asc');
		$record = $query->first(['role_id']);
		if($record){
			return $record['role_id'];
		}
		return null;
	}
	private function getPreviousRecordId($rec_id){
		$query = Role_Has_Permissions::query();
		$query->where('role_id', '<', $rec_id);
		$query->orderBy('role_id', 'desc');
		$record = $query->first(['role_id']);
		if($record){
			return $record['role_id'];
		}
		return null;
	}
}
