<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pitch_XscoutsAddRequest;
use App\Http\Requests\Pitch_XscoutsEditRequest;
use App\Models\Pitch_Xscouts;
use Illuminate\Http\Request;
use Exception;
class Pitch_XscoutsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pitch_xscouts.list";
		$query = Pitch_Xscouts::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Pitch_Xscouts::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "pitch_xscouts.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("review_status" , "");
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Pitch_Xscouts::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Pitch_Xscouts::query();
		$record = $query->findOrFail($rec_id, Pitch_Xscouts::viewFields());
		return $this->renderView("pages.pitch_xscouts.view", ["data" => $record]);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Pitch_XscoutsEditRequest $request, $rec_id = null){
		$query = Pitch_Xscouts::query();
		$record = $query->findOrFail($rec_id, Pitch_Xscouts::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['proposal'] = $this->moveUploadedFiles($modeldata['proposal'], "proposal");
			$record->update($modeldata);
			return $this->redirect("pitch_xscouts", "Record updated successfully");
		}
		return $this->renderView("pages.pitch_xscouts.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function list_review(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pitch_xscouts.list_review";
		$query = Pitch_Xscouts::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Pitch_Xscouts::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "pitch_xscouts.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("review_status" , "Yes");
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Pitch_Xscouts::listReviewFields());
		return $this->renderView($view, compact("records"));
	}
	private function getNextRecordId($rec_id){
		$query = Pitch_Xscouts::query();
		$query->where('id', '>', $rec_id);
		$query->orderBy('id', 'asc');
		$record = $query->first(['id']);
		if($record){
			return $record['id'];
		}
		return null;
	}
	private function getPreviousRecordId($rec_id){
		$query = Pitch_Xscouts::query();
		$query->where('id', '<', $rec_id);
		$query->orderBy('id', 'desc');
		$record = $query->first(['id']);
		if($record){
			return $record['id'];
		}
		return null;
	}
}
