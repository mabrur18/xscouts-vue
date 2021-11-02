@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = "Home";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<div>
    <div  class="card-4 bg-light mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class="row  q-col-gutter-sm q-px-sm">
                        <div class="col">
                            <div class="h5 font-weight-bold">Home</div>
                        </div>
                    </div>
                    <q-separator class="q-my-sm"></q-separator>
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3">
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-md-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_newxscouts();  ?>
                    <a class="animated zoomIn record-count alert alert-primary"  href="<?php print_link("pitch_xscouts") ?>">
                    <div class="row gutter-sm">
                        <div class="col">
                            <div class="flex-column justify-content align-center">
                                <div class="title">NEW XSCOUTS</div>
                                <small class="">NEW APLLY LIST</small>
                            </div>
                            <h4 class="value"><?php echo $rec_count; ?></h4>
                        </div>
                        <div class="col-auto" style="opacity: 1;">
                            <i class="material-icons ">explore</i>
                        </div>
                    </div>
                </a>
                <?php $rec_count = $comp_model->getcount_reviewedxscouts();  ?>
                <a class="animated zoomIn record-count alert alert-primary"  href="<?php print_link("pitch_xscouts/list_review") ?>">
                <div class="row gutter-sm">
                    <div class="col">
                        <div class="flex-column justify-content align-center">
                            <div class="title">REVIEWED XSCOUTS</div>
                            <small class="">REVIEWED LIST</small>
                        </div>
                        <h4 class="value"><?php echo $rec_count; ?></h4>
                    </div>
                    <div class="col-auto" style="opacity: 1;">
                        <i class="material-icons ">explore</i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 comp-grid">
        </div>
    </div>
</div>
</div>
</div>
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
