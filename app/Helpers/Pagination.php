<?php

/**
 * Pagination view helper
 *
 * @category  View Helper
 */

class Pagination
{
	/**
	     The current page that has the pagination
	 * @var int
	 */
	public $page_path;

	/**
	     Total Record In The Database Table
	 * @var int
	 */
	public $total_records;

	/**
	 * Total Record For The Current Page
	 * @var int
	 */
	public $current_record_count;

	/**
	 * Max Item to Retrieve Per Request
	 * @var int
	 */
	public $limit = 20;

	public $arr_limits = [1, 5, 10, 15, 20, 50, 100, 200];

	/**
	 * Number of Link List Number
	 * @var int
	 */
	public $pager_link_range = 4;

	/**
	 * Display Page Count Control
	 * @var boolean
	 */
	public $show_page_count = true;


	/**
	 * Show Control for the Total Number of Page Record And Database Table Record Count
	 * @var boolean
	 */
	public $show_record_count = true;

	/**
	 * Show Control For Limiting Number of Record Per Page
	 * @var boolean
	 */
	public $show_page_limit = true;


	/**
	 * Show Control For Pagination Link List Number
	 * @var boolean
	 */
	public $show_page_number_list = true;

	/**
	 * use ajax paginator for page navigation
	 * @var boolean
	 */
	public $ajax_page = false;

	/**
	 * pagination control style (options: [pagination, load-more, infinite-scroll])
	 * @var string
	 */
	public $pager_type = "pagination";

	/**
	 * text for load more button
	 * @var string
	 */
	public $load_more_text = "Load more";

	/**
	 * Loading indicator text
	 * @var string
	 */
	public $loading_text = "Loading...";

	/**
	 * text when no more content
	 * @var string
	 */
	public $no_more_content_text = "No more content to load";

	/**
	 * Initialize the Class
	 * @param string $total_records (Total Record In The Current Database Table)
	 * @param string $current_record_count (Current Page Total Record)
	 * @return null
	 */
	function __construct($total_records, $current_record_count)
	{
		$this->total_records = $total_records;
		$this->current_record_count = $current_record_count;
	}

	/**
	 * Set Query String Parameters for the pagination such as $page , $page_name
	 * @return link
	 */
	function set_link($page = null)
	{
		$url = url()->current();
		if ($page) {
			$url = add_query_params(['page' => $page]);
		}
		print_link($url);
	}

	/**
	 * Display The Pagination Component On The Page View
	 * @return void
	 */
	public function render()
	{
		$form_id = random_str();
		$request = request();
		$limit = (!empty($request->limit) ? $request->limit : $this->limit);
		$page_num = (!empty($request->page) ? $request->page : 1);
		$numofpages = ceil($this->total_records / $limit);
		$record_position = min(($page_num * $limit), $this->total_records);

		$range_min = ($this->pager_link_range % 2 == 0) ? ($this->pager_link_range / 2) - 1 : ($this->pager_link_range - 1) / 2;
		$range_max = ($this->pager_link_range % 2 == 0) ? $range_min + 1 : $range_min;
		$page_min = $page_num - $range_min;
		$page_max = $page_num + $range_max;

		$page_min = ($page_min < 1) ? 1 : $page_min;
		$page_max = ($page_max < ($page_min + $this->pager_link_range - 1)) ? $page_min + $this->pager_link_range - 1 : $page_max;

		if ($page_max > $numofpages) {
			$page_min = ($page_min > 1) ? $numofpages - $this->pager_link_range + 1 : 1;
			$page_max = $numofpages;
		}
		$page_min = ($page_min < 1) ? 1 : $page_min;

		$list_page_class = "col-md-5";
		$detail_page_class = "col";

		$form_class = "pagination-form";
		if ($this->ajax_page) {
			$form_class = "ajax-pagination-form";
		}
?>
		<?php
		$pager_type = strtolower($this->pager_type);
		if ($pager_type == "load-more") {
			?>
			<div class="text-center p-3 load-more-holder">
				<div class="load-indicator" style="display: none;"><?php echo $this->loading_text ?></div>
				<div class="no-more-content" style="display: none;"><?php echo $this->no_more_content_text ?></div>
				<button data-current-page="<?php echo $page_num; ?>" class="btn btn-secondary btn-pager-load-more"><?php echo $this->load_more_text ?></button>
			</div>
			<?php
		}
		elseif($pager_type == "infinite-scroll"){
			?>
			<div class="text-center p-3 infinite-scroll load-more-holder">
				<div class="load-indicator" style="display: none;"><?php echo $this->loading_text ?></div>
				<div class="no-more-content" style="display: none;"><?php echo $this->no_more_content_text ?></div>
				<button data-current-page="<?php echo $page_num; ?>" class="btn btn-secondary btn-pager-load-more"><?php echo $this->load_more_text ?></button>
			</div>
			<script>
				$(document).ready(function(){
					observeInfiniteScroll('.infinite-scroll');
				})
			</script>
			<?php
		}
		elseif($numofpages > 1){
		?>
			<script>
				function submitForm(resetPage){
					if(resetPage){
						$('#formpage<?php echo $form_id ?>').val(1)
					}
					$('#form<?php echo $form_id ?>').submit()
				}
			</script>
			<form class="mt-3 <?php echo $form_class; ?>" id="form<?php echo $form_id ?>" action="<?php echo ($this->set_link()); ?>" method="get">
				<div class="row justify-content-between">
					<?php
					if ($this->show_record_count == true ||  $this->show_page_limit == true) {
						if ($numofpages > 1) {
							$detail_page_class = "col";
							$list_page_class = "col-md-5";
						}
					?>
						<div class="<?php echo $detail_page_class; ?>">
							<?php
							if ($this->show_record_count == true) {
							?>
								<small class="text-primary">
									Records :
									<span class="record-position font-weight-bold"><?php echo $record_position; ?></span>
									of
									<span class="total-records font-weight-bold"><?php echo $this->total_records; ?></span>

								</small>
							<?php
							}

							if ($this->show_page_count == true && $numofpages > 1) {
							?>
								| <small class="text-primary">Page :
									<select style="display:inline-block;width:70px" id="formpage<?php echo $form_id ?>" onchange="submitForm()" name="page" class="custom form-control form-control-sm page-num">
										<?php
										for ($i = 1; $i <= $numofpages; $i++) {
										?>
											<option <?php echo ($i == $page_num ? "selected" : null); ?>><?php echo $i; ?></option>
										<?php
										}
										?>
									</select>
									of
									<span class="total-page font-weight-bold"><?php echo $numofpages; ?></span>
								</small>
							<?php
							}

							if ($this->show_page_limit == true  && $numofpages > 1) {
							?> |
								<small class="text-muted">
									Limit
									<select style="display:inline-block;width:70px" id="formlimit<?php echo $form_id ?>" onchange="submitForm(true)" name="limit" class="custom form-control form-control-sm">
										<?php
										foreach ($this->arr_limits as $val) {
											$selected = ($val == $limit ? "selected" : null);
										?>
											<option <?php echo $selected; ?>>
												<?php echo $val; ?>
											</option>
										<?php
										}
										?>
									</select>
								</small>
							<?php
							}
							?>
						</div>

						<hr class="d-none d-block-sm" />
						<?php
					}
					if ($numofpages > 1) {
						if ($this->ajax_page) {
						?>
							<div class="<?php echo $list_page_class ?>">
								<div data-limit-count="<?php echo $limit ?>" data-total-records="<?php echo $this->total_records ?>" data-total-page="<?php echo $numofpages ?>" data-range="<?php echo $this->pager_link_range; ?>" class="ajax-pagination"></div>
							</div>
						<?php
						} else {
						?>
							<div class="<?php echo $list_page_class ?>">
								<ul class="pagination pagination-sm">
									<?php

									if ($page_num != 1) {
									?>
										<li class="page-item">
											<a class="page-link" title="Go to First Page" href="<?php $this->set_link(1); ?>">
												<i class="material-icons">first_page</i>
											</a>
										</li>
									<?php
									} else {
									?>
										<li class="page-item">
											<a class="page-link" title="First Page"><i class="material-icons">first_page</i></a>
										</li>
									<?php
									}

									if ($page_num != 1) {
									?>
										<li class="page-item">
											<a class="page-link" title="Go to Previous Page" href="<?php $this->set_link($page_num - 1); ?>">
												<i class="material-icons">arrow_back</i>
											</a>
										</li>
									<?php
									} else {
									?>
										<li class="page-item">
											<a class="page-link" title="Previous Page"><i class="material-icons">arrow_back</i></a>
										</li>
										<?php
									}

									if ($this->show_page_number_list == true) {
										for ($i = $page_min; $i <= $page_max; $i++) {
											if ($i == $page_num) {
												//Current Page Number
												// So Display No Link And Set in Active State
										?>
												<li class="page-item active">
													<a class="page-link" title="Page <?php echo $i; ?>"><?php echo $i; ?></a>
												</li>
											<?php
											} else {
											?>
												<li class="page-item">
													<a class="page-link" title="Go to Page <?php echo $i; ?>" href="<?php $this->set_link($i); ?>">
														<?php echo $i; ?>
													</a>
												</li>
										<?php
											}
										}
									}

									//next button
									if ($page_num < $numofpages) {
										?>
										<li class="page-item">
											<a class="page-link" title="Go to Next Page" href="<?php $this->set_link($page_num + 1); ?>">
												<i class="material-icons">arrow_forward</i>
											</a>
										</li>

									<?php
									} else {
									?>
										<li class="page-item">
											<a class="page-link" title="Next Page"><i class="material-icons">arrow_forward</i></a>
										</li>
									<?php
									}
									//last button
									if ($page_num >= 1 && $numofpages > 1 && $numofpages != $page_num) {
									?>
										<li class="page-item">
											<a class="page-link" title="Go to Last Page" href="<?php $this->set_link($numofpages); ?>">
												<i class="material-icons">last_page</i>
											</a>
										</li>
									<?php
									} else {
									?>
										<li class="page-item">
											<a class="page-link" title="Last Page"><i class="material-icons">last_page</i></a>
										</li>
									<?php
									}
									?>
								</ul>
							</div>
					<?php
						}
					}
					?>
				</div>
			</form>
		<?php
		}
		?>


<?php
	}
}
