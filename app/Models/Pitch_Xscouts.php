<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Pitch_Xscouts extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'pitch_xscouts';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'name','company','phone','email','focus_field','spec_subject','prog','message','proposal','review_status','approval_status','meeting_status','review_date','approval_date','meeting_date'
	];
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				name LIKE ?  OR 
				company LIKE ?  OR 
				email LIKE ?  OR 
				focus_field LIKE ?  OR 
				spec_subject LIKE ?  OR 
				prog LIKE ?  OR 
				review_status LIKE ?  OR 
				approval_status LIKE ?  OR 
				meeting_status LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"id",
			"name",
			"company",
			"phone",
			"email",
			"focus_field",
			"spec_subject",
			"prog",
			"proposal",
			"created_date",
			"review_status",
			"review_date" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id",
			"name",
			"company",
			"phone",
			"email",
			"focus_field",
			"spec_subject",
			"prog",
			"proposal",
			"created_date",
			"review_status",
			"review_date" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id",
			"name",
			"company",
			"phone",
			"email",
			"focus_field",
			"spec_subject",
			"prog",
			"message",
			"proposal",
			"created_date",
			"review_status" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id",
			"name",
			"company",
			"phone",
			"email",
			"focus_field",
			"spec_subject",
			"prog",
			"message",
			"proposal",
			"created_date",
			"review_status" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id",
			"name",
			"company",
			"phone",
			"email",
			"focus_field",
			"spec_subject",
			"prog",
			"message",
			"proposal",
			"review_status",
			"review_date" 
		];
	}
	

	/**
     * return listReview page fields of the model.
     * 
     * @return array
     */
	public static function listReviewFields(){
		return [ 
			"id",
			"name",
			"company",
			"phone",
			"email",
			"focus_field",
			"spec_subject",
			"prog",
			"proposal",
			"created_date",
			"review_status",
			"review_date" 
		];
	}
	

	/**
     * return exportListReview page fields of the model.
     * 
     * @return array
     */
	public static function exportListReviewFields(){
		return [ 
			"id",
			"name",
			"company",
			"phone",
			"email",
			"focus_field",
			"spec_subject",
			"prog",
			"proposal",
			"created_date",
			"review_status",
			"review_date" 
		];
	}
}
