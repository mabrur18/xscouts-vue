@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("pitch_xscouts/add");
    $can_edit = $user->can("pitch_xscouts/edit");
    $can_view = $user->can("pitch_xscouts/view");
    $can_delete = $user->can("pitch_xscouts/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "New Pitch Xscouts";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page ajax-page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="card-4 bg-light mb-3">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-12 col-md-auto ">
                    <div class="row  q-col-gutter-sm q-px-sm">
                        <div class="col">
                            <div class="h5 font-weight-bold text-primary">Pitch Xscouts</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto ">
                </div>
                <div class="col-md-3 ">
                    <form  class="search" action="{{ url()->current() }}" method="get">
                        <input type="hidden" name="page" value="1" />
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control page-search" type="text" name="search"  placeholder="Search" />
                            <div class="input-group-append">
                                <button class="btn btn-primary"><i class="material-icons">search</i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php Html::display_page_errors($errors); ?>
                    <div  class=" page-content">
                        <div id="pitch_xscouts-list-records">
                            <div id="page-main-content" class="table-responsive">
                                <div class="ajax-page-load-indicator" style="display:none">
                                    <div class="text-center d-flex justify-content-center load-indicator">
                                        <span class="loader mr-3"></span>
                                        <span class="font-weight-bold">Loading...</span>
                                    </div>
                                </div>
                                <?php Html::page_bread_crumb("pitch_xscouts/", $field_name, $field_value); ?>
                                <table class="table  table-striped table-sm text-left">
                                    <thead class="table-header ">
                                        <tr>
                                            <?php if($can_delete){ ?>
                                            <th class="td-checkbox">
                                            <label class="custom-control custom-checkbox custom-control-inline">
                                            <input class="toggle-check-all custom-control-input" type="checkbox" />
                                            <span class="custom-control-label"></span>
                                            </label>
                                            </th>
                                            <?php } ?>
                                            <th class="td-btn"></th>
                                            <th class="td-sno">#</th>
                                            <th class="td-name" > Name</th>
                                            <th class="td-company" > Company</th>
                                            <th class="td-phone" > Phone</th>
                                            <th class="td-email" > Email</th>
                                            <th class="td-focus_field" > Focus Field</th>
                                            <th class="td-spec_subject" > Spec Subject</th>
                                            <th class="td-prog" > Prog</th>
                                            <th class="td-proposal" > Proposal</th>
                                            <th class="td-created_date" > Apply Date</th>
                                            <th class="td-review_status" > Review Status</th>
                                            <th class="td-review_date" > Review Date</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        if($total_records){
                                    ?>
                                    <tbody class="page-data">
                                        <!--record-->
                                        <?php
                                            $counter = 0;
                                            foreach($records as $data){
                                            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                            $counter++;
                                        ?>
                                        <tr>
                                            <?php if($can_delete){ ?>
                                            <td class=" td-checkbox">
                                                <label class="custom-control custom-checkbox custom-control-inline">
                                                <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                                <span class="custom-control-label"></span>
                                                </label>
                                            </td>
                                            <?php } ?>
                                            <th class="td-sno"><?php echo $counter; ?></th>
                                            <td class="td-btn">
                                                <div class="dropdown" >
                                                    <button data-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                                    <i class="material-icons">menu</i> 
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <?php if($can_view){ ?>
                                                        <a class="dropdown-item "   href="<?php print_link("pitch_xscouts/view/$rec_id"); ?>">
                                                        <i class="material-icons">visibility</i> View
                                                    </a>
                                                    <?php } ?>
                                                    <?php if($can_edit){ ?>
                                                    <a class="dropdown-item "   href="<?php print_link("pitch_xscouts/edit/$rec_id"); ?>">
                                                    <i class="material-icons">edit</i> Edit
                                                </a>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                    <!--PageComponentStart-->
                                    <td class="td-name">
                                        <?php echo  $data['name'] ; ?>
                                    </td>
                                    <td class="td-company">
                                        <?php echo  $data['company'] ; ?>
                                    </td>
                                    <td class="td-phone">
                                        <a href="<?php print_link("tel:$data[phone]") ?>"><?php echo $data['phone']; ?></a>
                                    </td>
                                    <td class="td-email">
                                        <a href="<?php print_link("mailto:$data[email]") ?>"><?php echo $data['email']; ?></a>
                                    </td>
                                    <td class="td-focus_field">
                                        <?php echo  $data['focus_field'] ; ?>
                                    </td>
                                    <td class="td-spec_subject">
                                        <?php echo  $data['spec_subject'] ; ?>
                                    </td>
                                    <td class="td-prog">
                                        <?php echo  $data['prog'] ; ?>
                                    </td>
                                    <td class="td-proposal"><?php Html :: page_link_file($data['proposal']); ?></td>
                                    <td class="td-created_date">
                                        <span title="<?php echo human_datetime($data['created_date']); ?>" class="has-tooltip">
                                        <?php echo relative_date($data['created_date']); ?>
                                        </span>
                                    </td>
                                    <td class="td-review_status">
                                        <?php echo  $data['review_status'] ; ?>
                                    </td>
                                    <td class="td-review_date">
                                        <span title="<?php echo human_datetime($data['review_date']); ?>" class="has-tooltip">
                                        <?php echo relative_date($data['review_date']); ?>
                                        </span>
                                    </td>
                                    <!--PageComponentEnd-->
                                </tr>
                                <?php 
                                    }
                                ?>
                                <!--endrecord-->
                            </tbody>
                            <tbody class="search-data"></tbody>
                            <?php
                                }
                                else{
                            ?>
                            <tbody class="page-data">
                                <tr>
                                    <td class="bg-light text-center text-muted animated bounce p-3" colspan="1000">
                                        <i class="material-icons">block</i> No record found
                                    </td>
                                </tr>
                            </tbody>
                            <?php
                                }
                            ?>
                        </table>
                    </div>
                    <?php
                        if($show_footer){
                    ?>
                    <div class="">
                        <div class="row justify-content-center">    
                            <div class="col-md-auto justify-content-center">    
                                <div class="p-3 d-flex justify-content-between">    
                                    <?php if($can_delete){ ?>
                                    <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("pitch_xscouts/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                    <i class="material-icons">clear</i> Delete Selected
                                    </button>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col">   
                                <?php
                                    if($show_pagination == true){
                                    $pager = new Pagination($total_records, $record_count);
                                    $pager->show_page_count = false;
                                    $pager->show_record_count = true;
                                    $pager->show_page_limit =false;
                                    $pager->limit = $limit;
                                    $pager->show_page_number_list = true;
                                    $pager->pager_link_range=5;
                                    $pager->ajax_page = true;
                                    $pager->render();
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
@endsection
@section('pagecss')
<style>
	body{
			
	}
</style>
@endsection
@section('pagejs')
<script>
	$(document).ready(function(){
			
	});
</script>

@endsection
