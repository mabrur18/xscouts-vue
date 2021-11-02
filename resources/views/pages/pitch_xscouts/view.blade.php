@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("pitch_xscouts/add");
    $can_edit = $user->can("pitch_xscouts/edit");
    $can_view = $user->can("pitch_xscouts/view");
    $can_delete = $user->can("pitch_xscouts/delete");
    $pageTitle = "Pitch Xscouts Details";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="view" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="card-4 bg-light mb-4">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md-auto ">
                    <div class="row  q-col-gutter-sm q-px-sm">
                        <div class="col">
                            <div class="h5 font-weight-bold text-primary">Pitch Xscouts Details</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php Html::display_page_errors($errors); ?>
                    <div  class="card-4 page-content">
                        <?php
                            $counter = 0;
                            if($data){
                            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                            $counter++;
                        ?>
                        <div id="page-main-content" class="">
                            <!-- Table Body Start -->
                            <div class="page-data">
                                <!--PageComponentStart-->
                                <div class="border-top td-name p-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="text-muted"> Name</div>
                                            <div class="font-weight-bold">
                                                <?php echo  $data['name'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top td-company p-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="text-muted"> Company</div>
                                            <div class="font-weight-bold">
                                                <?php echo  $data['company'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top td-phone p-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="text-muted"> Phone</div>
                                            <div class="font-weight-bold">
                                                <?php echo  $data['phone'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top td-email p-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="text-muted"> Email</div>
                                            <div class="font-weight-bold">
                                                <?php echo  $data['email'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top td-focus_field p-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="text-muted"> Focus Field</div>
                                            <div class="font-weight-bold">
                                                <?php echo  $data['focus_field'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top td-spec_subject p-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="text-muted"> Spec Subject</div>
                                            <div class="font-weight-bold">
                                                <?php echo  $data['spec_subject'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top td-prog p-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="text-muted"> Prog</div>
                                            <div class="font-weight-bold">
                                                <?php echo  $data['prog'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top td-message p-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="text-muted"> Message</div>
                                            <div class="font-weight-bold">
                                                <?php echo  $data['message'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top td-proposal p-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="text-muted"> Proposal</div>
                                            <div class="font-weight-bold"><?php Html :: page_img($data['proposal'],400,400, "",1,"$data[proposal]"); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top td-created_date p-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="text-muted"> Apply Date</div>
                                            <div class="font-weight-bold">
                                                <span title="<?php echo human_datetime($data['created_date']); ?>" class="has-tooltip">
                                                <?php echo relative_date($data['created_date']); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top td-review_status p-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="text-muted"> Review Status</div>
                                            <div class="font-weight-bold">
                                                <?php echo  $data['review_status'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--PageComponentEnd-->
                                <div class="d-flex q-col-gutter-xs justify-end">
                                    <div class="dropdown" >
                                        <button data-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                        <i class="material-icons">menu</i> 
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php if($can_edit){ ?>
                                            <a class="dropdown-item "   href="<?php print_link("pitch_xscouts/edit/$rec_id"); ?>">
                                            <i class="material-icons">edit</i> Edit
                                        </a>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Table Body End -->
                    </div>
                    <?php
                        }
                        else{
                    ?>
                    <!-- Empty Record Message -->
                    <div class="text-muted p-3">
                        <i class="material-icons">block</i> No Record Found
                    </div>
                    <?php
                        }
                    ?>
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
