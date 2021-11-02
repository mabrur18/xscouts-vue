@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Pitch Xscouts";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="card-4 bg-light mb-3">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md-auto ">
                    <div class="row  q-col-gutter-sm q-px-sm">
                        <div class="col">
                            <div class="h5 font-weight-bold text-primary">Add New Pitch Xscouts</div>
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
                <div class="col-md-9 comp-grid">
                    <?php Html::display_page_errors($errors); ?>
                    <div  class="card-4 page-content">
                        <!--[form-start]-->
                        <form id="pitch_xscouts-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('pitch_xscouts.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="name">Name </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-name-holder" class=" ">
                                                <input id="ctrl-name"  value="<?php echo get_value('name') ?>" type="text" placeholder="Enter Name" list="name_list"  name="name"  class="form-control " />
                                                <datalist id="name_list">
                                                <?php
                                                    $options = Menu::id();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_field_selected('name', $value);
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                <?php echo $label ?>
                                                </option>
                                                <?php
                                                    }
                                                    }
                                                ?>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="company">Company </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-company-holder" class=" ">
                                                <input id="ctrl-company"  value="<?php echo get_value('company') ?>" type="text" placeholder="Enter Company" list="company_list"  name="company"  class="form-control " />
                                                <datalist id="company_list">
                                                <?php
                                                    $options = Menu::id();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_field_selected('company', $value);
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                <?php echo $label ?>
                                                </option>
                                                <?php
                                                    }
                                                    }
                                                ?>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="phone">Phone </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-phone-holder" class=" ">
                                                <input id="ctrl-phone"  value="<?php echo get_value('phone') ?>" type="text" placeholder="Enter Phone" list="phone_list"  name="phone"  class="form-control " />
                                                <datalist id="phone_list">
                                                <?php
                                                    $options = Menu::id();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_field_selected('phone', $value);
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                <?php echo $label ?>
                                                </option>
                                                <?php
                                                    }
                                                    }
                                                ?>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="email">Email </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-email-holder" class=" ">
                                                <input id="ctrl-email"  value="<?php echo get_value('email') ?>" type="email" placeholder="Enter Email" list="email_list"  name="email"  class="form-control " />
                                                <datalist id="email_list">
                                                <?php
                                                    $options = Menu::id();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_field_selected('email', $value);
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                <?php echo $label ?>
                                                </option>
                                                <?php
                                                    }
                                                    }
                                                ?>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="focus_field">Focus Field </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-focus_field-holder" class=" ">
                                                <input id="ctrl-focus_field"  value="<?php echo get_value('focus_field') ?>" type="text" placeholder="Enter Focus Field" list="focus_field_list"  name="focus_field"  class="form-control " />
                                                <datalist id="focus_field_list">
                                                <?php
                                                    $options = Menu::id();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_field_selected('focus_field', $value);
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                <?php echo $label ?>
                                                </option>
                                                <?php
                                                    }
                                                    }
                                                ?>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="spec_subject">Spec Subject </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-spec_subject-holder" class=" ">
                                                <input id="ctrl-spec_subject"  value="<?php echo get_value('spec_subject') ?>" type="text" placeholder="Enter Spec Subject" list="spec_subject_list"  name="spec_subject"  class="form-control " />
                                                <datalist id="spec_subject_list">
                                                <?php
                                                    $options = Menu::id();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_field_selected('spec_subject', $value);
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                <?php echo $label ?>
                                                </option>
                                                <?php
                                                    }
                                                    }
                                                ?>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="prog">Prog </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-prog-holder" class=" ">
                                                <input id="ctrl-prog"  value="<?php echo get_value('prog') ?>" type="text" placeholder="Enter Prog" list="prog_list"  name="prog"  class="form-control " />
                                                <datalist id="prog_list">
                                                <?php
                                                    $options = Menu::id();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_field_selected('prog', $value);
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                <?php echo $label ?>
                                                </option>
                                                <?php
                                                    }
                                                    }
                                                ?>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="message">Message </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-message-holder" class=" ">
                                                <textarea placeholder="Enter Message" id="ctrl-message"  rows="5" name="message" class=" form-control"><?php echo get_value('message') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="proposal">Proposal </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-proposal-holder" class=" ">
                                                <div class="dropzone " input="#ctrl-proposal" fieldname="proposal" uploadurl="{{ url('fileuploader/upload/proposal') }}"    data-multiple="false" dropmsg="Choose files or drop files here"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                                    <input name="proposal" id="ctrl-proposal" class="dropzone-input form-control" value="<?php echo get_value('proposal') ?>" type="text"  />
                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="review_status">Review Status </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-review_status-holder" class=" ">
                                                <input id="ctrl-review_status"  value="<?php echo get_value('review_status') ?>" type="text" placeholder="Enter Review Status" list="review_status_list"  name="review_status"  class="form-control " />
                                                <datalist id="review_status_list">
                                                <?php
                                                    $options = Menu::id();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_field_selected('review_status', $value);
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                <?php echo $label ?>
                                                </option>
                                                <?php
                                                    }
                                                    }
                                                ?>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="approval_status">Approval Status </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-approval_status-holder" class=" ">
                                                <input id="ctrl-approval_status"  value="<?php echo get_value('approval_status') ?>" type="text" placeholder="Enter Approval Status" list="approval_status_list"  name="approval_status"  class="form-control " />
                                                <datalist id="approval_status_list">
                                                <?php
                                                    $options = Menu::id();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_field_selected('approval_status', $value);
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                <?php echo $label ?>
                                                </option>
                                                <?php
                                                    }
                                                    }
                                                ?>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="meeting_status">Meeting Status </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-meeting_status-holder" class=" ">
                                                <input id="ctrl-meeting_status"  value="<?php echo get_value('meeting_status') ?>" type="text" placeholder="Enter Meeting Status" list="meeting_status_list"  name="meeting_status"  class="form-control " />
                                                <datalist id="meeting_status_list">
                                                <?php
                                                    $options = Menu::id();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_field_selected('meeting_status', $value);
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                <?php echo $label ?>
                                                </option>
                                                <?php
                                                    }
                                                    }
                                                ?>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="review_date">Review Date </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-review_date-holder" class="input-group ">
                                                <input id="ctrl-review_date" class="form-control datepicker  datepicker" value="<?php echo get_value('review_date', "NULL") ?>" type="datetime"  name="review_date" placeholder="Enter Review Date" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="F j, Y - H:i" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="approval_date">Approval Date </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-approval_date-holder" class="input-group ">
                                                <input id="ctrl-approval_date" class="form-control datepicker  datepicker" value="<?php echo get_value('approval_date', "NULL") ?>" type="datetime"  name="approval_date" placeholder="Enter Approval Date" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="F j, Y - H:i" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="meeting_date">Meeting Date </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-meeting_date-holder" class="input-group ">
                                                <input id="ctrl-meeting_date" class="form-control datepicker  datepicker" value="<?php echo get_value('meeting_date', "NULL") ?>" type="datetime"  name="meeting_date" placeholder="Enter Meeting Date" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="F j, Y - H:i" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-ajax-status"></div>
                            <!--[form-button-start]-->
                            <div class="form-group form-submit-btn-holder text-center mt-3">
                                <button class="btn btn-primary" type="submit">
                                Submit
                                <i class="material-icons">send</i>
                                </button>
                            </div>
                            <!--[form-button-end]-->
                        </form>
                        <!--[form-end]-->
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
