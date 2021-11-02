@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Edit Pitch Xscouts";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="edit" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="card-4 bg-light mb-3">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md-auto ">
                    <div class="row  q-col-gutter-sm q-px-sm">
                        <div class="col">
                            <div class="h5 font-weight-bold text-primary">XSCOUTS Review</div>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("pitch_xscouts/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="name">Name </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-name-holder" class=" ">
                                            <input id="ctrl-name"  value="<?php  echo $data['name']; ?>" type="text" placeholder="Enter Name" list="name_list"  readonly name="name"  class="form-control " />
                                            <datalist id="name_list">
                                            <?php
                                                $options = Menu::id();
                                                $field_value = $data['name'];
                                                if(!empty($options)){
                                                foreach($options as $option){
                                                $value = $option['value'];
                                                $label = $option['label'];
                                                $selected = Html::get_record_selected($field_value, $value);
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
                                            <input id="ctrl-company"  value="<?php  echo $data['company']; ?>" type="text" placeholder="Enter Company" list="company_list"  readonly name="company"  class="form-control " />
                                            <datalist id="company_list">
                                            <?php
                                                $options = Menu::id();
                                                $field_value = $data['company'];
                                                if(!empty($options)){
                                                foreach($options as $option){
                                                $value = $option['value'];
                                                $label = $option['label'];
                                                $selected = Html::get_record_selected($field_value, $value);
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
                                            <input id="ctrl-phone"  value="<?php  echo $data['phone']; ?>" type="text" placeholder="Enter Phone" list="phone_list"  readonly name="phone"  class="form-control " />
                                            <datalist id="phone_list">
                                            <?php
                                                $options = Menu::id();
                                                $field_value = $data['phone'];
                                                if(!empty($options)){
                                                foreach($options as $option){
                                                $value = $option['value'];
                                                $label = $option['label'];
                                                $selected = Html::get_record_selected($field_value, $value);
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
                                            <input id="ctrl-email"  value="<?php  echo $data['email']; ?>" type="email" placeholder="Enter Email" list="email_list"  readonly name="email"  class="form-control " />
                                            <datalist id="email_list">
                                            <?php
                                                $options = Menu::id();
                                                $field_value = $data['email'];
                                                if(!empty($options)){
                                                foreach($options as $option){
                                                $value = $option['value'];
                                                $label = $option['label'];
                                                $selected = Html::get_record_selected($field_value, $value);
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
                                            <input id="ctrl-focus_field"  value="<?php  echo $data['focus_field']; ?>" type="text" placeholder="Enter Focus Field" list="focus_field_list"  readonly name="focus_field"  class="form-control " />
                                            <datalist id="focus_field_list">
                                            <?php
                                                $options = Menu::id();
                                                $field_value = $data['focus_field'];
                                                if(!empty($options)){
                                                foreach($options as $option){
                                                $value = $option['value'];
                                                $label = $option['label'];
                                                $selected = Html::get_record_selected($field_value, $value);
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
                                            <input id="ctrl-spec_subject"  value="<?php  echo $data['spec_subject']; ?>" type="text" placeholder="Enter Spec Subject" list="spec_subject_list"  readonly name="spec_subject"  class="form-control " />
                                            <datalist id="spec_subject_list">
                                            <?php
                                                $options = Menu::id();
                                                $field_value = $data['spec_subject'];
                                                if(!empty($options)){
                                                foreach($options as $option){
                                                $value = $option['value'];
                                                $label = $option['label'];
                                                $selected = Html::get_record_selected($field_value, $value);
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
                                            <input id="ctrl-prog"  value="<?php  echo $data['prog']; ?>" type="text" placeholder="Enter Prog" list="prog_list"  readonly name="prog"  class="form-control " />
                                            <datalist id="prog_list">
                                            <?php
                                                $options = Menu::id();
                                                $field_value = $data['prog'];
                                                if(!empty($options)){
                                                foreach($options as $option){
                                                $value = $option['value'];
                                                $label = $option['label'];
                                                $selected = Html::get_record_selected($field_value, $value);
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
                                            <textarea placeholder="Enter Message" id="ctrl-message"  readonly rows="5" name="message" class=" form-control"><?php  echo $data['message']; ?></textarea>
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
                                                <input name="proposal" id="ctrl-proposal" class="dropzone-input form-control" value="<?php  echo $data['proposal']; ?>" type="text"  />
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                            </div>
                                        </div>
                                        <?php Html :: uploaded_files_list($data['proposal'], '#ctrl-proposal'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="review_status">Review Status <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-review_status-holder" class=" ">
                                            <select required=""  id="ctrl-review_status" name="review_status"  placeholder="Review"    class="custom-select" >
                                            <option value="">Review</option>
                                            <?php
                                                $options = Menu::review_status();
                                                $field_value = $data['review_status'];
                                                if(!empty($options)){
                                                foreach($options as $option){
                                                $value = $option['value'];
                                                $label = $option['label'];
                                                $selected = Html::get_record_selected($field_value, $value);
                                            ?>
                                            <option <?php echo $selected ?> value="<?php echo $value ?>">
                                            <?php echo $label ?>
                                            </option>                                   
                                            <?php
                                                }
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="review_date">Review Date <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-review_date-holder" class="input-group ">
                                            <input id="ctrl-review_date" class="form-control datepicker  datepicker" required="" value="<?php  echo $data['review_date']; ?>" type="datetime"  name="review_date" placeholder="Enter Review Date" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="F j, Y - H:i" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-ajax-status"></div>
                        <!--[form-content-end]-->
                        <!--[form-button-start]-->
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">
                            Update
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
