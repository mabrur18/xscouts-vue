<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Model_Has_RolesAddRequest;
use App\Http\Requests\Model_Has_RolesEditRequest;
use App\Models\Model_Has_Roles;
use Illuminate\Http\Request;
use Exception;
class Model_Has_RolesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.model_has_roles.list";
		$query = Model_Has_Roles::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Model_Has_Roles::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "model_has_roles.model_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Model_Has_Roles::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Model_Has_Roles::query();
		$record = $query->findOrFail($rec_id, Model_Has_Roles::viewFields());
		return $this->renderView("pages.model_has_roles.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.model_has_roles.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Model_Has_RolesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Model_Has_Roles record
		$record = Model_Has_Roles::create($modeldata);
		$rec_id = $record->model_id;
		return $this->redirect("model_has_roles", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Model_Has_RolesEditRequest $request, $rec_id = null){
		$query = Model_Has_Roles::query();
		$record = $query->findOrFail($rec_id, Model_Has_Roles::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("model_has_roles", "Record updated successfully");
		}
		return $this->renderView("pages.model_has_roles.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Model_Has_Roles::query();
		$query->whereIn("model_id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
	private function getNextRecordId($rec_id){
		$query = Model_Has_Roles::query();
		$query->where('model_id', '>', $rec_id);
		$query->orderBy('model_id', 'asc');
		$record = $query->first(['model_id']);
		if($record){
			return $record['model_id'];
		}
		return null;
	}
	private function getPreviousRecordId($rec_id){
		$query = Model_Has_Roles::query();
		$query->where('model_id', '<', $rec_id);
		$query->orderBy('model_id', 'desc');
		$record = $query->first(['model_id']);
		if($record){
			return $record['model_id'];
		}
		return null;
	}
}
