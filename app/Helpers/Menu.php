
<?php
	class Menu{
		
	public static function navbarsideleft(){
		return [
		[
			'path' => 'home',
			'label' => "Home", 
			'icon' => '<i class="material-icons ">home</i>'
		],
		
		[
			'path' => 'pitch_xscouts',
			'label' => "XSCUTS List", 
			'icon' => '<i class="material-icons ">explore</i>','submenu' => [
		[
			'path' => 'pitch_xscouts',
			'label' => "New List", 
			'icon' => '<i class="material-icons ">format_list_bulleted</i>'
		],
		
		[
			'path' => 'pitch_xscouts/list_review',
			'label' => "Review List", 
			'icon' => '<i class="material-icons ">settings_backup_restore</i>'
		]
	]
		],
		
		[
			'path' => 'appoinment',
			'label' => "Appoinment", 
			'icon' => '<i class="material-icons ">assessment</i>'
		],
		
		[
			'path' => 'user',
			'label' => "User", 
			'icon' => '<i class="material-icons ">verified_user</i>'
		],
		
		[
			'path' => 'permissions',
			'label' => "Permissions", 
			'icon' => '<i class="material-icons ">lock_outline</i>'
		],
		
		[
			'path' => 'roles',
			'label' => "Roles", 
			'icon' => '<i class="material-icons ">details</i>'
		]
	] ;
	}
	
		
	public static function id(){
		return [] ;
	}
	
	public static function review_status(){
		return [
		[
			'value' => 'Yes', 
			'label' => "Yes", 
		],
		[
			'value' => 'Reject', 
			'label' => "Reject", 
		],] ;
	}
	
	}
