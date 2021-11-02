<?php

/**
 * Html Helper Class
 * Use To Display Customisable Html Page Component
 * Better used for small html reusable html components
 * @category  View Helper
 */
class Html
{

	/**
	 * Build Menu List From Array
	 * Support Multi Level Dropdown Menu Tree
	 * Set Active Menu Base on The Current Page || url
	 * @example [
			[
				'path' => 'home',
				'label' => 'Home', 
				'icon' => '<i class="icon-globe"></i>'
			],
			[
				'path' => 'managers',
				'label' => 'Managers', 
				'icon' => '<i class="icon-globe"></i>'
			]
		]
	 * @param array $arrMenu
	 * @param string $menu_class
	 * @param string $menu_type example dropdow | collapse | accordion
	 * @return void
	 */
	public static function render_menu($arrMenu, $menu_class = "nav navbar-nav", $menu_type = "dropdown")
	{
		$user =  auth()->user();

		$page_name = request()->segment(1, "index");
		$page_action = request()->segment(2, "index");
		$page_path = "$page_name/$page_action";

		$menu_link_class = "dropdown";
		$submenu_link_class = "dropdown-toggle";
		$data_toggle = "dropdown";
		$menu_group_id = "";
		if ($menu_type == "collapse" || $menu_type == "accordion") {
			$menu_link_class = "";
			$submenu_link_class = "dropdown-toggle";
			$data_toggle = "collapse";
			if ($menu_type == "accordion") {
				$menu_group_id = "menu-" . random_str();
			}
		}

		if (!empty($arrMenu)) {
?>
			<ul id="<?php echo $menu_group_id; ?>" class="<?php echo $menu_class; ?>">
				<?php
				foreach ($arrMenu as $menu_obj) {
					$menu_url = $menu_obj['path'];
					$menu_path = trim(parse_url($menu_url, PHP_URL_PATH), "/");
					if ($user->canView($menu_path)) {
					$active_class = null;
					if ($page_name == $menu_path || $page_path == $menu_path) {
						$active_class = "active";
					}
					if (!empty($menu_obj['submenu'])) {
						$menu_id = "";
						if ($menu_type == "collapse" || $menu_type == "accordion") {
							$menu_id = "menu-" . random_str();
						}
				?>
						<li class="nav-item <?php echo $menu_link_class;  ?>">
							<a class="nav-link <?php echo $submenu_link_class;  ?>" href="#<?php echo $menu_id; ?>" data-boundary="viewport" data-toggle="<?php echo $data_toggle;  ?>">
								<span class="menu-icon"><?php echo (!empty($menu_obj['icon']) ? $menu_obj['icon'] : null); ?></span>
								<span class="menu-label"><?php echo $menu_obj['label']; ?></span>
							</a>
							<?php
							self::render_submenu($menu_obj['submenu'], $menu_type, $menu_id, $menu_group_id);
							?>
						</li>
					<?php
					} else {
					?>
						<li class="nav-item">
							<a class="nav-link <?php echo ($active_class) ?>" href="<?php print_link($menu_url); ?>">
								<span class="menu-icon"><?php echo (!empty($menu_obj['icon']) ? $menu_obj['icon'] : null); ?></span>
								<span class="menu-label"><?php echo $menu_obj['label']; ?></span>
							</a>
						</li>
				<?php
					}
					}
				}
				?>
			</ul>
		<?php
		}
	}

	/**
	 * Render Multi Level Dropdown menu 
	 * Recursive Function
	 * @return void
	 */
	public static function render_submenu($arrMenu, $menu_type = "dropdown", $parent_id = null, $group_id = null)
	{
		$user =  auth()->user();

		$page_name = request()->segment(1, "index");
		$page_action = request()->segment(2, "index");
		$page_path = "$page_name/$page_action";

		$menu_class = "dropdown-menu";
		$submenu_class = "dropdown-submenu";
		$submenu_link_class = "dropdown-item dropdown-toggle";
		$menu_link_class = "dropdown-item";
		$data_toggle = "dropdown";
		$data_parent = "";
		if ($menu_type == "collapse" || $menu_type == "accordion") {
			$menu_class = "collapse";
			$submenu_class = "";
			$submenu_link_class = "nav-link dropdown-toggle";
			$menu_link_class = "nav-link";
			$data_toggle = "collapse";
			if ($menu_type == "accordion") {
				$data_parent = "data-parent='#$group_id'";
			}
		}

		if (!empty($arrMenu)) {
		?>
			<ul id="<?php echo $parent_id; ?>" class="<?php echo $menu_class ?> submenu list-unstyled" <?php echo $data_parent; ?>>
				<?php
				foreach ($arrMenu as $key => $menu_obj) {
					$menu_url = $menu_obj['path'];
					$menu_path = trim(parse_url($menu_url, PHP_URL_PATH), "/");
					if ($user->canView($menu_path)) {
					$active_class = null;
					if ($page_name == $menu_path || $page_path == $menu_path) {
						$active_class = "active";
					}
					if (!empty($menu_obj['submenu'])) {
						$menu_id = "menu-" . random_str();
				?>
						<li class="nav-item <?php echo $submenu_class;  ?>">
							<a class="<?php echo $submenu_link_class;  ?>" href="#<?php echo $menu_id; ?>" data-toggle="<?php echo $data_toggle;  ?>">
								<span class="menu-icon"><?php echo (!empty($menu_obj['icon']) ? $menu_obj['icon'] : null); ?></span>
								<span class="menu-label"><?php echo $menu_obj['label']; ?></span>
							</a>
							<?php self::render_submenu($menu_obj['submenu'], $menu_type, $menu_id, $parent_id); ?>
						</li>
					<?php
					} else {
					?>
						<li class="nav-item">
							<a class="<?php echo $menu_link_class;  ?> <?php echo ($active_class) ?>" href="<?php print_link($menu_url); ?>">
								<span class="menu-icon"><?php echo (!empty($menu_obj['icon']) ? $menu_obj['icon'] : null); ?></span>
								<span class="menu-label"><?php echo $menu_obj['label']; ?></span>
							</a>
						</li>
				<?php
					}
					}
				}
				?>
			</ul>
		<?php
		}
	}

	/**
	 * Display laravel form validations errors
	 * @param array $errors
	 * @return void
	 */
	public static function display_page_errors($errors)
	{
		if($errors->any()){
			?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<ul class="p-0 m-0" style="list-style: none;">
						<?php 
							foreach($errors->all() as $error){
								?>
									<li><?php echo $error; ?></li>
								<?php
							}
						?>
					</ul>
				</div>
			<?php
		}
	}

	/**
	 * Render page navigation history as bread crumbs
	 * @param string $page_name
	 * @param string $field_name
	 * @param string $field_value
	 * @return void
	 */
	public static function page_bread_crumb($page_name, $field_name = null, $field_value = null)
	{
		if (!empty($field_name) || !empty(get_value('search'))) {
		?>
			
			<nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
				<ul class="breadcrumb m-0 p-1">
					<?php
					if (!empty($field_name)) {
					?>
						<li class="breadcrumb-item">
							<a class="text-decoration-none" href="<?php print_link($page_name); ?>">
								<i class="material-icons">arrow_back</i>
							</a>
						</li>
						<li class="breadcrumb-item">
							<?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
						</li>
						<li class="breadcrumb-item active text-capitalize font-weight-bold">
							<?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
						</li>
					<?php
					}
					?>

					<?php
					if (get_value("search")) {
					?>
						<li class="breadcrumb-item">
							<a class="text-decoration-none" href="<?php print_link($page_name); ?>">
								<i class="material-icons">arrow_back</i>
							</a>
						</li>
						<li class="breadcrumb-item text-capitalize">
							Search
						</li>
						<li class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
					<?php
					}
					?>

				</ul>
			</nav>
		<?php
		}
	}

	
	/**
	 * display page filter tag
	 * @param string $field_name
	 * @param string $field_tag
	 * @param array $options
	 * @return void
	 */
	public static function filter_tag($field_name, $field_tag, $options = null)
	{
		$field_value = get_value($field_name);
		if ($field_value) {
			if(!is_array($field_value)){
				$field_value = [$field_value];
			}
			$field_labels = $field_value;
			if (is_array($options)) {
				$field_labels = [];
				foreach($options as $option){
					if(in_array($option->value, $field_value)){
						$field_labels[] = $option->label;
					}
				}
			}
			?>
			<div class="filter-chip bg-light">
				<?php echo $field_tag ?>:
				<b><?php echo join(", ", $field_labels); ?></b>
				<a href="<?php echo remove_query_params([$field_name]); ?>" class="close-btn"> &times; </a>
			</div>
			<?php
		}
	}

	/**
	 * display page filter tag when filter is a date range or multi date
	 * @return string
	 */
	public static function filter_tag_date($fieldname, $field_tag, $date_format = null)
	{
		if (!empty(get_value($fieldname))) {
		?>
			<div class="filter-chip bg-light">
				<?php echo $field_tag ?> :
				<b>
					<?php
					$date_val = get_value($fieldname);
					$formated_date = "";
					if (stripos($date_val, '-to-') > 0 ) {
						//if value is a range date
						$vals = explode('-to-', $date_val);
						$startdate = $vals[0];
						$enddate = $vals[1];
						$formated_date = format_date($startdate, $date_format) . ' <span class="text-muted">&#10148;</span> ' . format_date($enddate, $date_format);
					} elseif (stripos(',', $date_val) > 0) {
						//multi date values
						$vals = explode(',', str_replace(' ', '', $date_val));
						$formated_arrs = array_map(function ($date) use($date_format){
							return format_date($date, $date_format);
						}, $vals);
						$formated_date = implode(' <span class="text-info">&#11161;</span> ', $formated_arrs);
					} else {
						$formated_date = format_date($date_val, $date_format);
					}

					echo  $formated_date;
					?>
				</b>
				<a href="<?php echo remove_query_params([$fieldname]); ?>" class="close-btn">
					&times;
				</a>
			</div>
			<?php
		}
	}


	/**
	 * Display Html Image Tag with preview or link
	 * Can be Use to Display Multiple Images Separated By Comma
	 * @param string $imgsrc
	 * @param int $width
	 * @param int $height
	 * @param int $imagesize // image thumbnail size example small | medium | large
	 * @param int $max //max number of images to display for multiple images
	 * @param int $link
	 * @param int $imgclass
	 * @return string
	 */
	public static function page_img($imgsrc, $width = 50, $height = 50, $imagesize = "small", $max = 1, $link = null, $imgclass = "img-fluid")
	{
		if (!empty($imgsrc)) {
			$arrsrc = explode(",", $imgsrc);
			if ($max >= 1) {
				$arrsrc = array_slice($arrsrc, 0, min(count($arrsrc), $max));
			}
			$gallery_id = "gallery-". random_str(10);
			?>
			<div id="<?php echo $gallery_id; ?>">
				<?php
				foreach ($arrsrc as $src) {
					$previewlink = $link;
					$previewattr = null;
					if (!$link) {
						$previewlink  = getImgSizePath($src, "large"); // get large image path for preview
						$previewattr = "data-gallery='#blueimp-gallery-$gallery_id'";
					}
					$sizeSrc = getImgSizePath($src, $imagesize);
					?>
						<a <?php echo $previewattr; ?> href="<?php echo url($previewlink) ?>">
							<img alt="<?php echo basename($src); ?>" class="<?php echo $imgclass ?>" width="<?php echo $width ?>" height="<?php echo $height ?>" src="<?php echo url($sizeSrc); ?>" />
						</a>
					<?php
				}
				?>
			</div>
			<?php
		}
	}

	/**
	 * Display Html Image Tag
	 * Can be Use to Display Multiple Images Separated By Comma
	 * @param string $imgsrc
	 * @param int $width
	 * @param int $height
	 * @param int $imagesize // image thumbnail size example small | medium | large
	 * @param int $imgclass
	 * @return string
	 */
	public static function img($imgsrc, $width = 50, $height = 50, $imagesize = "small",  $imgclass = "img-fluid")
	{
		if (!empty($imgsrc)) {
			$arrsrc = explode(",", $imgsrc);
			$arrsrc = array_slice($arrsrc, 0, min(count($arrsrc), 1));
			foreach ($arrsrc as $src) {
				$sizeSrc = getImgSizePath($src, $imagesize);
				?>
					<img class="<?php echo $imgclass ?>" width="<?php echo $width ?>" height="<?php echo $height ?>"  src="<?php echo url($sizeSrc); ?>" />
				<?php
			}
		}
	}

	/**
	 * display star rating
	 * @param int $value
	 * @param int $num_star //maximum nunber of stars
	 * @return void
	 */
	public static function star_rating($value, $num_star = 5)
	{
		?>
		<div class="star-rating">
			<?php
			for ($i = 1; $i <= $num_star; $i++) {
				$active = ($i <= $value ? "active" : null);
			?>
				<span class="star <?php echo $active ?>">☆</span>
			<?php
			}
			?>
		</div>
	<?php
	}

	/**
	 * display a progress bar
	 * @param int $value
	 * @param int $max_value
	 * @param string $class
	 * @return void
	 */
	public static function progress_bar($value, $max_value = 100, $class = "")
	{
		$percent = ($value / $max_value * 100);
	?>
		<div class="progress has-tooltip" title="<?php echo $value; ?>" style="height: 15px;">
			<div class="progress-bar <?php echo $class; ?>" role="progressbar" style="width: <?php echo $percent; ?>%" aria-valuenow="<?php echo $percent; ?>" aria-valuemin="0" aria-valuemax="<?php echo $max_value; ?>">
				<span class="progress-label"><?php echo round($percent, 2); ?>%</span>
			</div>
		</div>
	<?php
	}

	/**
	 * display check button
	 * @param string $value
	 * @param string $check_value
	 * @return void
	 */
	public static function check_button($value, $check_value = "true")
	{
		$checked = (strtolower($value) == strtolower($check_value) ? "checked" : null);
	?>
		<div class="td-check-button <?php echo $checked ?>">
			<i class="material-icons">check_circle</i>
		</div>
		<?php
	}

	/**
	 * display files link (files can be separated by comma)
	 * @return void
	 */
	public static function page_link_file($src, $btnclass = "btn btn-outline-primary btn-sm", $target = "_blank")
	{
		if (!empty($src)) {
			$arrpath = explode(",", $src);
			foreach ($arrpath as $path) {
				if (!empty($path)) {
		?>
					<a class="<?php echo $btnclass ?> has-tooltip" title="<?php echo basename($path); ?>" target="<?php echo $target ?>" href="<?php print_link($path); ?>">
						<i class="material-icons">attachment</i>
					</a>
		<?php
				}
			}
		}
	}


	/**
	 * Display import data form
	 * @param string $form_path
	 * @param string $button_text
	 * @return void
	 */
	public static function import_form($form_path, $button_text = "")
	{
		$formid = random_str();
		?>
		<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#import-data-form-<?php echo $formid ?>">
			<i class="material-icons">insert_drive_file</i> <?php echo $button_text; ?>
		</button>

		<form method="post" action="<?php print_link($form_path); ?>" enctype="multipart/form-data" id="#import-data-form-<?php echo $formid ?>" class="modal fade" role="dialog" tabindex="-1" data-backdrop="false" role="dialog" aria-labelledby="myModalLabel">
			<?php echo csrf_field(); ?>
			<div class="modal-dialog modal-dialog-centered modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Import Data</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="custom-file" id="customFile" lang="<?php echo app()->getLocale(); ?>">
							<input type="file" required="required" class="custom-file-input" id="inputfile" name="file" aria-describedby="fileHelp">
							<label class="custom-file-label" for="inputfile">
								Select a file to import 
							</label>
						</div>
						<small class="text-muted">Supported file types(csv)</small>
					</div>
					<div class="modal-footer">
						<button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Import Data</button>
					</div>
				</div>
			</div>
		</form>
	<?php
	}


	/**
	 * display list of uploaded files. Support multi files separated by comma
	 * @param string $files
	 * @param string $inputid
	 * @return string
	 */
	public static function uploaded_files_list($files, $inputid, $delete_file = "false")
	{
	?>
		<div class="uploaded-file-holder clearfix">
			<?php
			if (!empty($files)) {
				$arrsrc = explode(",", $files);
				$i = 0;
				$img_exts =  array('gif', 'png', 'jpg', 'jpeg');

				foreach ($arrsrc as $src) {
					$i++;
					$previewattr = "";
					$is_img = false;
					$ext = strtolower(pathinfo($src, PATHINFO_EXTENSION));
					if (in_array($ext, $img_exts)) {

						$is_img = true;
					}

			?>
					<div class="d-inline-block p-1 card m-1" id="file-holder-<?php echo $i; ?>">
						<?php
						if ($is_img) {
							self::page_img($src, 50, 50);
						} else {
						?>
							<a class="btn btn-sm btn-light" target="_blank" href="<?php url($src) ?>">
								<?php echo basename($src); ?>
							</a>
						<?php
						}
						?>
						<button data-input="<?php echo $inputid; ?>" data-delete-file="<?php echo $delete_file; ?>" type="button" data-file="<?php echo $src ?>" data-file-num="<?php echo $i; ?>" class="close removeEditUploadFile">
							&times;
						</button>
					</div>
			<?php
				}
			}
			?>
		</div>
<?php
	}

	/**
	 * Displaying page order by field link
	 * uses the current page url and modify only the orderby and ordertype query string parameter
	 * @param string $fieldname
	 * @param string $fieldlabel
	 * @return void
	 */
	public static function get_field_order_link($fieldname, $fieldlabel, $icon=null)
	{

		$currentordertype = strtoupper(get_value("ordertype", "ASC"));
		$newordertype = ($currentordertype == 'ASC' ? 'DESC' : 'ASC');
		$orderlink = add_query_params(["orderby" => $fieldname, "ordertype" => $newordertype]);
		$linkbtnclass = (get_value('orderby') == $fieldname ? 'active' : '');
		$sorticon = ($currentordertype == 'DESC' ? '&#8595' : '&#8593;'); //icon direction
	?>
		<a class="th-sort-link d-flex <?php echo $linkbtnclass; ?>" data-orderby="<?php echo $fieldname;  ?>" href="<?php print_link($orderlink); ?>">
			<?php if($icon){ ?><div class="pr-1"><?php echo $icon; ?></div><?php } ?>
			<div class="title"><?php echo $fieldlabel; ?></div>
			<div class="pl-3 sort-icon"><?php echo $sorticon ?></div>
		</a>
	<?php
	}

	/**
	 * Get form field value on form post back
	 * Support multi Field Form
	 * @param string $fieldname
	 * @param string $default_value
	 * @return  string
	 */
	public static function get_field_value($fieldname, $default_value = null, $index = null)
	{
		$post =  filter_var_array($_REQUEST, FILTER_SANITIZE_STRING);
		if (!empty($post[$fieldname])) {
			if ($index === null) {
				return $post[$fieldname];
			} 
			else {
				return $post["row$index"][$fieldname];
			}
		} 
		else {
			return $default_value;
		}
	}

	/**
	 * Check if edit record field value contain a value 
	 * @return  string
	 */
	public static function get_record_checked($srcdata, $value)
	{
		if (!empty($srcdata)) {
			$arr = explode(",", $srcdata);
			if (in_array($value, $arr)) {
				return "checked";
			}
		}
		return null;
	}

	/**
	 * Check if edit record field value contain a value 
	 * @return  string
	 */
	public static function get_record_selected($srcdata, $value)
	{
		if (!empty($srcdata)) {
			$arr = explode(",", $srcdata);
			if (in_array($value, $arr)) {
				return "selected";
			}
		}
		return null;
	}

	/**
	 * Return 'checked' if a Request field contains a value on form Post Back
	 * @param string $fieldname
	 * @param string $value
	 * @param string $default_value
	 * @return  string
	 */
	public static function get_field_checked($fieldname, $value, $default_value = null)
	{
		$post =  filter_var_array($_REQUEST, FILTER_SANITIZE_STRING);
		$req_val =  $post[$fieldname] ?? $default_value;
		if (is_array($req_val)) {
			return (in_array($value, $req_val) ? 'checked' : null);
		} elseif ($req_val == $value) {
			return "checked";
		}
		return null;
	}

	/**
	 * Return 'selected' if a Request field contains a value on form Post Back
	 * @param string $fieldname
	 * @param string $value
	 * @param string $default_value
	 * @return string
	 */
	public static function get_field_selected($fieldname, $value, $default_value = null)
	{
		$post =  filter_var_array($_REQUEST, FILTER_SANITIZE_STRING);
		$req_val =  $post[$fieldname] ?? $default_value;
		if (is_array($req_val)) {
			return (in_array($value, $req_val) ? 'selected' : null);
		} elseif ($req_val == $value) {
			return "selected";
		}
		return null;
	}
}
