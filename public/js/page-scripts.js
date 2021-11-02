String.prototype.trimLeft = function(charlist) {
  if (charlist === undefined)
	charlist = "\s";
  return this.replace(new RegExp("^[" + charlist + "]+"), "");
};
String.prototype.trimRight = function(charlist) {
  if (charlist === undefined)
	charlist = "\s";
  return this.replace(new RegExp("[" + charlist + "]+$"), "");
};
/**
 * return a form data as javascript object
 */
function getFormData(form){
    var out = {};
    var s_data = $(form).serializeArray();
    //transform into simple data/value object
    for(var i = 0; i<s_data.length; i++){
        var record = s_data[i];
        out[record.name] = record.value;
    }
    return out;
}
/**
 * convert simple string separated by comma into array
 */
function valToArray(val) {
	if(val){
		if(Array.isArray(val)){
			return val;
		}
		else{
			return val.split(",");
		}
	}
	else{
		return [];
	}
};
/**
 * simple debounce function for ajax loading on user typing
 */
function debounce(fn, delay) {
  var timer = null;
  return function () {
	var context = this, args = arguments;
	clearTimeout(timer);
	timer = setTimeout(function () {
	  fn.apply(context, args);
	}, delay);
  };
}
/**
 * merge two object
 */
function extend(obj, src) {
	for (var key in src) {
		if (src.hasOwnProperty(key)) obj[key] = src[key];
	}
	return obj;
}
/**
 * check if a string is a valid url
 */
function isURL(str) {
	return /^(?:\w+:)?\/\/([^\s\.]+\.\S{2}|localhost[\:?\d]*)\S*$/.test(str); 
}
//return the absolute url of a path with query string 
function setPathLink(path , queryObj){
	var queryStr = "";
	if(queryObj){
		var str = [];
		for(var k in queryObj){
			var v = queryObj[k]
			if (queryObj.hasOwnProperty(k) && v !== '') {
				str.push(encodeURIComponent(k) + "=" + encodeURIComponent(v));
			} 
		}
		var qs = str.join("&");
		if(path.indexOf('?') > 0){
			queryStr = '&' + qs;  
		}
		else{
			queryStr = '?' + qs;  
		}
	}
	if(!isURL(path)){
		return url = siteAddr + path + queryStr;
	}
	else{
		return url =  path + queryStr;
	}
}
function showToastSuccess(msg){
	var toast = $('#app-toast-success');
	toast.find('.msg').text(msg)
	toast.show();
	window.setTimeout(function(){
		toast.slideUp('fast');
	},3000);
}
function showToastDanger(msg){
	var toast = $('#app-toast-danger');
	toast.find('.msg').text(msg)
	toast.show();
	window.setTimeout(function(){
		toast.slideUp('fast');
	},3000);
}
/**
 * generate random hexadecimal color
 */
function randomColor() {
	var letters = '0123456789ABCDEF';
	var color = '#';
	for (var i = 0; i < 6; i++) {
		color += letters[Math.floor(Math.random() * 16)];
	}
	return color;
}
var loadingIndicator = $('#loading-indicator').html(); //loding indicator used for ajax load content
var savingIndicator = $('#saving-indicator').html(); //saving indicator used for ajax submit form
$(document).ready(function() {
	//hides page flash msg after page navigate.
	var elem=$('#flashmsgholder');
	if(elem.length>0){
		var duration=elem.attr("data-show-duration");
		if(duration>0){
			window.setTimeout(function(){
				elem.fadeOut();
			},duration)
		}
	}
});
/**
 * Table toggle select all records
 */
$(document).on('click', '.toggle-check-all', function(){
	var p = $(this).closest('table').find('.optioncheck');
	p.prop("checked", $(this).prop("checked"));
});
/**
 * Table select a record 
 */
$(document).on('click', '.optioncheck, .toggle-check-all', function(){
	var sel_ids =$(this).closest('.page').find("input.optioncheck:checkbox:checked").map(function(){
	  return $(this).val();
	}).get();
	if(sel_ids.length>0){
		 $(this).closest('.page-content').find('.btn-delete-selected').removeClass('d-none');
	}
	else{
		$(this).closest('.page-content').find('.btn-delete-selected').addClass('d-none');
	}
});
/**
 * Table delete selected record
 */
$(document).on('click', '.btn-delete-selected', function(e){
	var recordDeleteMsg = $(this).data("prompt-msg");
	var displayStyle = $(this).data("display-style");
	if(!recordDeleteMsg){
		recordDeleteMsg = "Are you sure you want to delete selected records?";
	}
	var sel_ids =$(this).closest('.page-content').find("input.optioncheck:checkbox:checked").map(function(){
	  return $(this).val();
	}).get();
	if(sel_ids.length>0){
		var url = $(this).data('url');
		url = url.replace("{sel_ids}",sel_ids);
		if(displayStyle == 'confirm'){
			if(confirm(recordDeleteMsg)){
				window.location = url;
			}
			else{
				e.preventDefault();
			}
		}
		else if(displayStyle == 'modal'){
			$('#delete-record-modal-msg').html(recordDeleteMsg);
			$('#delete-record-modal-confirm').modal('show');
			$('#delete-record-modal-btn').attr('href', url);
			var ajaxpage = $(this).closest(".ajax-page");
			$('#delete-record-modal-btn').data("ajax-page", ajaxpage);
			e.preventDefault();
		}
		else{
			window.location = url;
		}
	}
	else{
		alert('No Record Selected');
	}
});
/**
 * page delete record action button
 */
$(document).on('click', '.record-delete-btn', function(e){
	var recordDeleteMsg = $(this).data("prompt-msg");
	var displayStyle = $(this).data("display-style");
	if(!recordDeleteMsg){
		recordDeleteMsg = "Are you sure you want to delete this record?";
	}
	if(displayStyle == 'confirm'){
		if(!confirm(recordDeleteMsg)){
			e.preventDefault();
		}
	}
	else if(displayStyle == 'modal'){
		$('#delete-record-modal-msg').html(recordDeleteMsg);
		$('#delete-record-modal-confirm').modal('show');
		$('#delete-record-modal-btn').attr('href', $(this).attr('href'));
		var ajaxpage = $(this).closest(".ajax-page");
		$('#delete-record-modal-btn').data("ajax-page", ajaxpage);
		e.preventDefault();
	}
});
/**
 * modal confirm delete action
 */
$(document).on( "click", "#delete-record-modal-btn", function(e) {
	var ajaxpage = $(this).data('ajax-page');
	//if ajaxpage is present then delete using ajax else continue with delete navigation
	if(ajaxpage.length){
		e.preventDefault();
		var deleteUrl = $(this).attr('href');
		$('#delete-record-modal-msg').html(loadingIndicator);
		$.ajax({
			url: deleteUrl,
			type: "get",
			success: function(msg) {
				showToastSuccess(msg);
				var pageUrl = ajaxpage.data("page-url");
				loadPageData(ajaxpage, pageUrl); //reload page data
				$('#delete-record-modal-confirm').modal('hide'); //close modal
			},
			error: function( xhr, err ) {
				showToastDanger(xhr.statusText);
			}
		});
	}
});
/**
 * remove uploaded file action on edit page
 */
$(document).on('click', '.removeEditUploadFile', function(e){
	 // hidden input that contains all the file
	var holder = $(this).closest(".uploaded-file-holder");
	var inputid = $(this).attr("data-input");
	var inputControl = $(inputid);
	var filepath = $(this).attr('data-file');
	var filenum = $(this).attr('data-file-num');
	var srcTxt = inputControl.val();
	if(srcTxt){
		var arrSrc = srcTxt.split(",");
		arrSrc.forEach(function(src,index){
			if(src == filepath){
				arrSrc.splice(index,1);
			}
		});
		holder.find("#file-holder-"+filenum).remove();
		var ty = arrSrc.join(",");
		inputControl.val(ty);
	}
});
/**
 * custom btn to close a popover view
 */
$(document).on("click", ".popover .close-btn, .popover .close" , function(){
	$(this).parents(".popover").popover('hide');
});
/**
 * Display a page in popover component
*/
$(document).on('click', '.open-page-popover', function(e){
	$('.open-page-popover').not(this).popover('hide'); // hide other popover
	e.preventDefault();
});
/**
 * toggle a new table row and open a page link in the view
 */
$(document).on('click', '.open-page-inline', function(e){
	e.preventDefault();
	var dataURL = $(this).attr('href');
	if($(this).closest('tr').length != 0){
		var tbRow = $(this).closest('tr');
		var loaded = tbRow.attr('loaded');
		var colspan = tbRow.children('td,th').length;
		if(!loaded){
			tbRow.attr('loaded', true);
			var newRow = $('<tr class="child-row"><td colspan="' + colspan + '"><div class="row justify-content-center"><div class="col-md-6"><div class="content reset-grids inline-page">' + loadingIndicator + '</div></div></div></td></tr>');
			tbRow.after(newRow); 
			newRow.find('.content').load(dataURL, function(responseText, status, req){
				if(status == 'error'){
					tbRow.removeAttr('loaded');
				}
				initPlugins();
			});
		}
		else{
			tbRow.next().toggle();	
		}
	}
	else{
		var container = $(this).closest('.inline-page');
		var loaded = container.attr('loaded');
		var page = container.find('.page-content');
		if(!loaded){
			container.attr('loaded', true);
			page.html(loadingIndicator).load(dataURL, function(responseText, status, req){
				if(status == 'error'){
					container.removeAttr('loaded');
				}
				initPlugins();
			});
		}
		page.toggleClass('d-none');
	}
});
$(document).on('change', '.custom-file-input', function(){
	var fileName = $(this).val().split('\\').pop();
	$(this).siblings('.custom-file-label').addClass('selected').html(fileName);
});
/**
 * Refresh captcha image
*/
$(document).on('click', '[data-captcha]', function(e){
	var img = $(this).find("img");
	var url = new Url($(this).data("captcha"));
	url.query.cache = new Date().getTime(); //force reload of image
	img.attr("src", url);
});
/**
 * remove table row in a multi-table form
 */
$(document).on('click', '.btn-remove-table-row', function(e){
	var tableBody = $(this).closest('table').find("tbody");
	var rowCount = tableBody.find('tr.input-row:last').index() + 1
	var minRow = $(this).closest('table').data("minrow");
	if(rowCount > minRow){
		$(this).closest("tr.input-row").remove();
	}
});
/**
 * add new table row in a multi-table form
 */
$(document).on('click', '.btn-add-table-row', function(e){
	var tableBody = $(this).closest('table').find("tbody");
	var rowCount = tableBody.find('tr.input-row:last').index() + 1
	var maxRow = $(this).closest('table').data("maxrow");
	if(rowCount < maxRow){
		var templateId = $(this).data("template");
		var trTemplate = $(templateId).html();
		var nextRow = parseInt(rowCount) + 1;
		trTemplate = trTemplate.replace(/CURRENTROW/ig,  nextRow);
		var trNew = $(trTemplate);
		tableBody.append(trNew);
	}
	initPlugins(); //rebind form plugin to the new controls
});
/**
 * check if a form is valid and set set form controls validity status 
 */
$(document).on('submit', 'form.needs-validation, form.multi-form', function(event){
	if(!validateForm($(this))){
		event.preventDefault();
		event.stopPropagation();
	}
});
/**
 * validate password confirmation
 */
$(document).on('input', '.password-confirm', function(event){
	var inputElem =  $(this)
	var value = inputElem.val();
	var match = $(inputElem.data("match")).val();
	if(value !== match){
		inputElem.removeClass('is-valid').addClass('is-invalid');
		inputElem[0].setCustomValidity("Password do not match");
	}
	else{
		inputElem.removeClass('is-invalid').addClass('is-valid');
		inputElem[0].setCustomValidity("");
	}
});
/**
 * validate password confirmation
 */
$(document).on('input', 'input.password', function(event){
	var inputElem =  $(this)
	var value = inputElem.val();
	var confirmPassword = inputElem.closest("form").find(".password-confirm");
	if(confirmPassword.length){
		var match = confirmPassword.val();
		if(value !== match){
			confirmPassword.removeClass('is-valid').addClass('is-invalid');
			confirmPassword[0].setCustomValidity("Password do not match");
		}
		else{
			confirmPassword.removeClass('is-invalid').addClass('is-valid');
			confirmPassword[0].setCustomValidity("");
		}
	}
});
/**
 * validate form fields and display validation feedback 
 */
function validateForm(formElem){
	formElem.addClass('was-validated');
	formElem.find("input:required:invalid").parents('.dropzone').css("borderColor", "red");
	formElem.find("input:required:invalid").parents('.custom-file').find('.custom-file-label').css("borderColor", "red");
	formElem.find("textarea:required:invalid").parents('.form-group,.input-row').find('.note-editor').css("borderColor", "red");
	var confirmPasswordElem = formElem.find("input.password-confirm");
	if(confirmPasswordElem.length){
		var value = confirmPasswordElem.val();
		var match = $(confirmPasswordElem.data("match")).val();
		if(value !== match){
			confirmPasswordElem.removeClass('is-valid').addClass('is-invalid');
			confirmPasswordElem[0].setCustomValidity("Password do not match");
		}
		else{
			confirmPasswordElem.removeClass('is-invalid').addClass('is-valid');
			confirmPasswordElem[0].setCustomValidity("");
		}
	}
	var checboxes = $(formElem).find('.checkbox-group-required input');
	var fields = checboxes.serializeArray();
    if (fields.length === 0) {
		checboxes.prop("required", true);
    } 
    else {
		checboxes.prop("required", false);
	}
	var form = formElem[0];
	if(!form.checkValidity()){
		return false
	}
	return true;
}
/**
 * export button link click
 */
$(document).on('click', '.ajax-page a.export-link-btn', function(e){
	var page = $(this).closest('.ajax-page');
	var format = $(this).data("format");
	var pageUrl = page.data('page-url');
	var url = new Url(pageUrl);
	url.query.export = format;
	var link = url.toString();
	$(this).attr("href", link);
});
/**
 * submit a form using ajax
 */
$(document).on('submit', '.ajax-page form.page-form', function(e){
	var formElem = $(this);
	if(validateForm(formElem)){
		var loader  = formElem.find('.form-ajax-status');
		loader.html(savingIndicator);
		loader.show();
		$.ajax({
			url: formElem.attr('action'),
			type: formElem.attr('method'),
			data: formElem.serialize(),
			success: function(msg) {
				loader.hide();
				showToastSuccess(msg);
				var ajaxpage = formElem.closest('.ajax-page');
				var pageUrl = ajaxpage.data("page-url");
				loadPageData(ajaxpage, pageUrl);
				formElem.closest('.modal').modal('toggle'); //close the modal
				formElem[0].reset();
				formElem.removeClass('was-validated');
			},
			error: function( xhr, err ) {
				loader.hide();
				showToastDanger( xhr.statusText );
			}
		});
	}
	e.preventDefault();
	e.stopPropagation();
});
/**
 * submit a form using ajax and refresh the ajax-page
 */
$(document).on('submit', '#main-page-modal form.page-form', function(e){
	var formElem = $(this);
	if(validateForm(formElem)){
		var loader  = formElem.find('.form-ajax-status');
		loader.html(savingIndicator);
		loader.show();
		$.ajax({
			url: formElem.attr('action'),
			type: formElem.attr('method'),
			data: formElem.serialize(),
			success: function(msg) {
				loader.hide();
				var ajaxpage = formElem.closest('.modal').data('ajax-page');
				if(ajaxpage){
					var pageUrl = ajaxpage.data("page-url");
					loadPageData(ajaxpage, pageUrl);
				}
				$('#main-page-modal').modal('hide');
				showToastSuccess(msg);
			},
			error: function( xhr, err ) {
				loader.hide();
				showToastDanger(xhr.statusText);
			}
		}); 
	}
	e.preventDefault();
	e.stopPropagation();
});
/**
 * open content in a modal view
 */
$(document).on('click', '.open-page-modal', function(e){
	e.preventDefault();
	var dataURL = $(this).attr('href');
	var modal = $(this).next('.modal');
	modal.modal({show:true});
	modal.find('.modal-body').html(loadingIndicator).load(dataURL, function(responseText, status, req){
		if(status == 'error'){
			$(this).html(responseText);
		}
		initPlugins();
	});
});
/**
 * open page in modal view
 */
$(document).on('click', 'a.page-modal, a.page-drawer', function(e){
	e.preventDefault();
	var dataURL = $(this).attr('href');
	var ajaxpage = $(this).closest('.ajax-page');
	var modal = $('#main-page-modal');
	modal.data('ajax-page', ajaxpage);
	modal.modal({show:true});
	modal.find('.modal-body').html(loadingIndicator).load(dataURL, function(responseText, status, req){
		if(status == 'error'){
			$(this).html(responseText);
		}
		initPlugins();
	});
});
/**
 * check if value already exit in a database table for validation
 */
$(document).on('blur', '.ctrl-check-duplicate', function(){
	var inputElem = $(this)
	var val = inputElem.val();
	var apiUrl = inputElem.data("url");
	var elemCheckStatus = inputElem.closest('.form-group').find('.check-status');
	var loadingMsg = inputElem.data('loading-msg');
	var availableMsg = inputElem.data('available-msg');
	var notAvailableMsg = inputElem.data('unavailable-msg');
	elemCheckStatus.html('<small class="text-muted">' + loadingMsg + '</small>');
	if(val){
		$.ajax({
			url : setPathLink(apiUrl, {value:val}),
			success : function(result) {
				if(result == true) {
					inputElem.addClass('is-invalid');
					inputElem[0].setCustomValidity(notAvailableMsg);
					elemCheckStatus.html('<small class="text-danger">' + notAvailableMsg + '</small>');
				}
				else{ 
					inputElem.removeClass('is-invalid').addClass('is-valid');
					inputElem[0].setCustomValidity('');
					elemCheckStatus.html('<small class="text-success">' + availableMsg + '</small>');
				}
			},
			error : function(err) {
				elemCheckStatus.html('');
			}
		});
	}
	else{
		elemCheckStatus.html('');
		inputElem.removeClass('is-valid').removeClass('is-valid');
	}
});
/**
 * populate another select control when an input value changes
 */
$(document).on('change', '[data-load-select-options]', function(e){
	var elem = $(this);
	var elementType =  elem.prop('tagName').toLowerCase();
	var selectedVal = "";
	if(elementType == 'input'){
		var arrSelectedVals = [];
		elem.closest('.form-group, .input-row').find("input:checked").each(function(){
			arrSelectedVals.push(elem.val());
		});
		selectedVal = arrSelectedVals.toString();
	}
	else{
		selectedVal = elem.val().toString();
	}
	var targetFields =  elem.data('load-select-options');
	var arrFields = targetFields.split(",");
	arrFields.forEach(function(field){
		//if placed in a multiple table row, populate only the field in the same row
		var targetElem;
		var tableRow = elem.closest(".input-row");
		if(tableRow.length){
			targetElem = tableRow.find("select[id*=ctrl-" + field + "], input[id*=ctrl-" + field + "]");
		}
		else{
			targetElem = $("#ctrl-" + field);
		}
		var path = targetElem.data('load-path') + '?lookup=' + encodeURIComponent(selectedVal);
		targetElem.html('<option value="">Loading...</option>');
		var placeholder = targetElem.attr('placeholder') || 'Select a value...';
		$.ajax({
			type: 'GET',
			url: path,
			dataType: 'json',
			success: function(data){
				if(targetElem.hasClass('selectize')){
					targetElem.each(function() {
						if (this.selectize) {
							this.selectize.clear();
							this.selectize.clearOptions();
							for (var i = 0; i < data.length; i++) {
								this.selectize.addOption({value:data[i].value, text: data[i].label });
							}
						}
					}); 
				}
				else{
					var options = '<option value="">' + placeholder +  '</option>';
					for (var i = 0; i < data.length; i++) {
						options += '<option value="' + data[i].value + '">' + data[i].label + '</option>';
					}
					targetElem.html(options);
				}
			},
			error: function(data) {
				var options = '<option value="">' + placeholder +  '</option>';
				targetElem.html(options);
			},
		});
	})
});
/**
 * populate another input check/radio control when a control value changes
 */
$(document).on('change', '[data-load-check-options]', function(e){
	var elem = $(this);
	var elementType = elem.prop('tagName').toLowerCase();
	var selectedVal = "";
	if(elementType == 'input'){
		var arrSelectedVals = [];
		elem.closest('.form-group').find("input:checked").each(function(){
			arrSelectedVals.push(elem.val());
		});
		selectedVal = arrSelectedVals.toString();
	}
	else{
		selectedVal = elem.val().toString();
	}
	var targetFields =  elem.data('load-check-options');
	var arrFields = targetFields.split(",");
	arrFields.forEach(function(field){
		var targetOptionsHolder;
		var templateHtml = $("#" + field + "-option-template").html();
		//if placed in a multiple table row, populate only the field in the same row
		var tableRow = elem.closest(".input-row");
		if(tableRow.length){
			targetOptionsHolder = tableRow.find("#" + field + "-options-holder");
			var rowIndex = tableRow.index() + 1;
			//update input name to the current table row
			templateHtml = templateHtml.replace(/row1/ig, "row" + rowIndex);
		}
		else{
			targetOptionsHolder = $("#" + field + "-options-holder");
		}
		var path = targetOptionsHolder.data('load-path') + '/' + encodeURIComponent(selectedVal);
		targetOptionsHolder.html(loadingIndicator);
		$.ajax({
			type: 'GET',
			url: path,
			dataType: 'json',
			success: function (data){
				targetOptionsHolder.html("");
				for (var i = 0; i < data.length; i++) {
					var option = $(templateHtml);
					option.find('input').val(data[i].value);
					option.find('.input-label-text').html(data[i].label);
					targetOptionsHolder.append(option);
				}
			},
			error: function (data) {
				targetOptionsHolder.html('...');
			},
		});
	})
});
/**
 * for multi checkbox, validate if a value is checked
 */
$('.form-group').on("click",'input:checkbox',function(){          
	var name = $(this).attr('name');
	var checkElem = $('input[name="'+name+'"]:checked');
    var min = 1 //minumum number of boxes to be checked for this form-group
    if(checkElem.length < min){
        $('input[name="'+name+'"]').prop('required',true);
    }
    else{
        $('input[name="'+name+'"]').prop('required',false);
    }
});
/**
 * set custom value for checkfor when checked state changed
 */
$(document).on('change', 'input.single-switch', function(){
	var checkbox = $(this);
	if(this.checked){
		checkbox.siblings('[type="hidden"]').val(checkbox.data("on"));
	}
	else{
		checkbox.siblings('[type="hidden"]').val(checkbox.data("off"));
	}
});
/**
 * close ajax drop down search
 */
$(document).on('click', '.close-search', function(e){
	var parent = $(this).closest('.search-input');
	parent.find('.holder').hide();
});
$(document).on('keyup', 'input.ajax-dropdown-search', debounce(function(){
	var searchText = $(this).val();
	searchText = searchText.trim();
	var parent = $(this).closest('.search-input');
	if(searchText){
		var pageUrl = $(this).data('page');
		var url = new Url(pageUrl);
		url.query.search = searchText;
		parent.find('.holder').show();
		var searchResult = parent.find('.search-result')
		searchResult.html(loadingIndicator).load(url.toString(), function (responseText, textStatus, req) {
			if (textStatus == "error") {
				searchResult.html(requestErrorMessage);
			}
		});
	}
	else{
		parent.find('.holder').hide();
	}
},500));
$(document).on('keyup', '.ajax-page input.page-search', debounce(function(){
	var searchText = $(this).val();
	searchText = searchText.trim();
	var ajaxpage = $(this).closest('.ajax-page');
	var pageUrl = ajaxpage.data('page-url');
	var url = new Url(pageUrl);
	url.query.search = searchText;
	loadPageData(ajaxpage, url.toString());
},500));
/**
 * toggle password visibility
 */
$(document).on('click', '.btn-toggle-password', function(){
	var input = $(this).closest(".form-group").find("input");
	var inputType = input.attr("type");
	if(inputType == "password"){
		input.attr("type", "text");
	}
	else{
		input.attr("type", "password");
	}
});
/**
 * ajax page navigation
 */
 $(document).on('submit', 'form.ajax-pagination-form', function(event){
	var formdata = getFormData($(this));
	var pager = $(this).find(".ajax-pagination");
	var currentPage =  (formdata.page ? formdata.page: 1);
	var limitCount = (formdata.limit ? formdata.limit: pager.data("limit-count"));
	currentPage =  parseInt(currentPage);
	limitCount = parseInt(limitCount);
	if(currentPage && limitCount){
		var totalRecords = parseInt(pager.data("total-records"));
		var recordPosition = Math.min((currentPage * limitCount), totalRecords);
		var newTotalPage = Math.ceil(totalRecords / limitCount);
		var page = $(this).closest(".ajax-page");
		var pageUrl = page.data("page-url");
		var url = new Url(pageUrl);
		url.query.page = currentPage;
		url.query.limit = limitCount;
		var path = url.toString();
		page.data("page-url", path); //update page link
		pager.twbsPagination("changeTotalPages", newTotalPage, currentPage); //load page
		$(this).find(".record-position").html(recordPosition);
		$(this).find(".total-page").html(newTotalPage);
		var pageOptions = "";
		for(var i = 1; i <= newTotalPage; i++){
			pageOptions = pageOptions + '<option value="'+ i +'">' + i + '</option>';
		}
		$(this).find(".page-num").html(pageOptions);
		$(this).find(".page-num").val(currentPage);
	}
	event.preventDefault();
});
/**
 * ajax sort table header
 */
$(document).on('click', '.ajax-page .th-sort-link', function(event){
	var ajaxPage = $(this).closest(".ajax-page");
	var pageUrl = ajaxPage.data("page-url");
	var url = new Url(pageUrl);
	var orderby = $(this).data("orderby");
	var ordertype = (ajaxPage.data("ordertype") || "").toLowerCase();
	ordertype = (ordertype == "asc" ? "desc" : "asc");
	url.query.orderby = orderby;
	url.query.ordertype = ordertype;
	url.query.page = 1;
	ajaxPage.data("ordertype", ordertype);
	ajaxPage.find("a.th-sort-link").closest("th").removeClass("sortedby");
	$(this).closest("th").addClass("sortedby");
	if(ordertype === "desc"){
		$(this).parent().find(".sort-icon").addClass("inverse")
	}
	else{
		$(this).parent().find(".sort-icon").removeClass("inverse")
	}
	var newUrl = url.toString();
	ajaxPage.data("page-url", newUrl); //update page link
	var pager = ajaxPage.find(".ajax-pagination");
	if(pager.length){
		//if using pagination control
		//reset page to page 1 and trigger loadPageData
		pager.twbsPagination("show", 1); 
	}
	else{
		//if pagination control is infinite scroll or load more button
		//reset infinite scroll control to default
		var pagerControl = ajaxPage.find('.load-more-holder');
		if(pagerControl.length){
			var loadMoreBtn = pagerControl.find('.btn-pager-load-more');
			loadMoreBtn.data('current-page', 1);
			loadMoreBtn.show();
			pagerControl.find(".no-more-content").hide();
		}
		loadPageData(ajaxPage, newUrl);
	}
	event.preventDefault();
});
$(document).on('click', '.btn-pager-load-more', function(){
	var btn =  $(this);
	var parent = btn.closest('.load-more-holder')
	var loadIndicator = parent.find(".load-indicator");
	var mainPage = btn.closest(".page");
	var pageUrl = mainPage.data("page-url");
	var nextPage = parseInt(btn.data("current-page")) + 1;
	var url = new Url(pageUrl);
	url.query.page = nextPage;
	var pageContentHolder = mainPage.find("table,.page-content");
	loadIndicator.show();
	btn.hide();
	$.ajax({
		url: url.toString(),
		type: "get",
		success: function(html) {
			var pageRows = $(html).find(".page-data");
			if (pageRows.children().length > 0 ) {
				pageContentHolder.find(".page-data").append(pageRows.html());
				var tdRowSerial = pageContentHolder.find(".page-data .td-sno");
				if(tdRowSerial.length){
					tdRowSerial.each(function(index) {
						$(this).html(index+1);
					});
				}
				btn.data("current-page", nextPage);
				loadIndicator.hide();
				btn.show();
				initPlugins();
		   	}
			else{
				parent.find(".no-more-content").show();
				loadIndicator.hide();
				btn.hide();
			}
		},
		error: function( xhr, err ) {
			console.error(xhr.responseText);
			errorMsg = '<div class="card m-3 h4 text-danger p-3 text-center">' + xhr.statusText + '</div>'
			pageContentHolder.append(errorMsg);
			loadIndicator.hide();
			btn.show();
		}
	});
});
function loadPageData(ajaxPage, url){
	var pageType = ajaxPage.data('page-type');
	var loadIndicator = ajaxPage.find(".ajax-page-load-indicator");
	var pageContentHolder = ajaxPage.find("table,.page-content");
	pageContentHolder.addClass("loading");
	loadIndicator.show();
	$.ajax({
		url: url,
		type: "get",
		success: function(html) {
			if(pageType == "list"){
				var pageRows = $(html).find(".page-data").html();
				pageContentHolder.find(".page-data").html(pageRows);
				pageContentHolder.removeClass("loading");
				loadIndicator.hide();
			}
			else{
				ajaxPage.html(html)
			}
			initPlugins();
		},
		error: function( xhr, err ) {
			console.error(xhr.responseText);
			errorMsg = '<div class="card m-3 h4 text-danger p-3 text-center">' + xhr.statusText + '</div>'
			ajaxPage.html(errorMsg);
		}
	});
}
Dropzone.autoDiscover = false;
function initPlugins(){
	$('.datepicker').flatpickr({
		altInput: true, 
		allowInput:true,
		onReady: function(dateObj, dateStr, instance) {
			var $cal = $(instance.calendarContainer);
			if ($cal.find('.flatpickr-clear').length < 1) {
				$cal.append('<button class="btn btn-light my-2 flatpickr-clear">Clear</button>');
				$cal.find('.flatpickr-clear').on('click', function() {
					instance.clear();
					instance.close();
				});
			}
		},
		locale: {
			rangeSeparator: '-to-'
		}
	});
	Dropzone.autoDiscover = false;
	$('.dropzone').each(function(){
		let dropzoneControl = $(this)[0].dropzone;
		if (dropzoneControl) {
			dropzoneControl.destroy();
		}
		var uploadUrl = $(this).attr('uploadurl');
		var multiple = $(this).data('multiple') || false;
		var limit =$(this).attr('maximum') || 1;
		var size = $(this).attr('filesize') || 10;
		var extensions = $(this).attr('extensions') || "";
		var resizewidth = $(this).attr('resizewidth') || null;
		var resizeheight = $(this).attr('resizeheight') || null;
		var resizequality = $(this).attr('resizequality') || null;
		var resizemethod = $(this).attr('resizemethod') || null;
		var resizemimetype = $(this).attr('resizemimetype') || null;
		var dropmsg = $(this).attr('dropmsg') || 'Choose files or drag and drop files to upload';
		var input = $(this).attr('input');
		$(this).dropzone({
			url: uploadUrl ,
			maxFilesize:size,
			uploadMultiple: false,
			parallelUploads:limit,
			paramName:'file',
			maxFiles:limit,
			resizeWidth: resizewidth,
			resizeHeight: resizeheight,
			resizeQuality: resizequality,
			resizeMethod: resizemethod,
			resizeMimeType: resizemimetype,
			acceptedFiles: extensions,
			addRemoveLinks:true,
			init: function() {
				this.on('addedfile', function(file) {
					//if allow multiple file upload is allowed, then validate maximum number of files
					var uploadedFiles = $(input).val();
					var uploadedFilesLength = uploadedFiles.split(',').filter(r => r != '').length;
					if (uploadedFilesLength >= limit) {
						showToastDanger("Maximum upload limit reached");
						this.removeFile(file);
					}
				});
				this.on("success", function(file, uploadedFilesList) {
					if(limit == 1){
						$(input).val(uploadedFilesList.toString());
					}
					else{
						var inputFiles = $(input).val().split(",");
						uploadedFilesList.forEach(function(filepath){
							if(inputFiles.indexOf(filepath) === -1){
								inputFiles.push(filepath);
							}
						});
						var filtered = inputFiles.filter(function (el) {
							return el != "";
						});
						$(input).val(filtered.toString());
					}
				});
				this.on("removedfile", function(file) {
					if(file.xhr){
						var filename = JSON.parse(file.xhr.responseText).toString();
						var files = $(input).val();
						var arrFiles = files.split(',');
						while (arrFiles.indexOf(filename) !== -1) {
							arrFiles.splice(arrFiles.indexOf(filename), 1);
						}
						$(input).val(arrFiles.toString());
						var formData = {
							temp_file: filename
						}
						$.ajax({
							url: "../fileuploader/remove_temp_file",
							type: "POST",
							data: formData,
							success: function(msg) {
								console.log(msg);
							},
							error: function( xhr, err ) {
								console.error(err);
							}
						});
					}
				});
			},
			dictDefaultMessage: dropmsg,
			headers: { 'x-csrf-token': csrfToken},
			/* dictRemoveFile:'' */
		});
	});
	$('.ajax-pagination').each(function(){
		var pager = $(this);
		var totalPage = parseInt(pager.data("total-page")) || 1;
		var range = parseInt(pager.data("range")) || 5;
		var ajaxPage = pager.closest(".ajax-page");
		pager.twbsPagination({
			paginationClass: 'pagination pagination-sm',
			totalPages: totalPage,
			visiblePages: range,
			initiateStartPageClick: false,
			first: '<i class="material-icons">first_page</i>',
			prev: '<i class="material-icons">arrow_back</i>',
			next: '<i class="material-icons">arrow_forward</i>',
			last: '<i class="material-icons">last_page</i>',
			onPageClick: function (event, pageNum) {
				var pageUrl = ajaxPage.data("page-url");
				var url = new Url(pageUrl);
				url.query.page = pageNum; // adds or replaces the param
				var path = url.toString();
				loadPageData(ajaxPage, path);
				ajaxPage.data("page-url", path); //update page link
				pager.closest("form").find(".page-num").val(pageNum);
				var totalRecords = parseInt(pager.data("total-records"));
				var limitCount = parseInt(pager.data("limit-count"));
				var recordPosition = Math.min((pageNum * limitCount), totalRecords);
				pager.closest("form").find(".record-position").html(recordPosition);
			}
		}).on('page', function (event, pageNum) {
		});;
	});
	$('.has-tooltip').tooltip();
	$('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
	$(".switch-checkbox").bootstrapSwitch();
	$('input.password-strength').passwordStrength();
	$('.open-page-popover').popover({
		title : '<div class="clearfix"><a class="close" data-dismiss="alert">&times;</a></div>',
		template: '<div class="popover inline-page" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
		html: true,
		container: 'body',
		content: function(){
			var divID =  "tmp-id-" + $.now();
			var link = $(this).attr('href')
			$.ajax({
				url: link,
				success: function(response){
					$('#' + divID).html(response);
				}
			});
			return '<div class="reset-grids" id="'+ divID +'">' + loadingIndicator + '</div>';// + footer;
		}
	});
}
$(function() {
	initPlugins();
	$('.ajax-inline-page').each(function(e){
		var url = $(this).data('url');
		var ajaxPage = $(this);
		loadPageData(ajaxPage, url);
	});
	$("img").on("error", function () {
		$(this).attr("src", "/images/error-image-generic.png");
	});
	$('img.lazy-load').each(function(){
		let src = $(this).data('src');
		if(src){
			$(this).attr('src', src);
		}
		else{
			$(this).attr('src', '/images/no-image-available');
		}
	});
});
function observeInfiniteScroll(pageElement){
	var intersectionObserver = new IntersectionObserver(function(entries) {
		// If intersectionRatio is 0, the target is out of view and we do not need to do anything.
		if (entries[0].intersectionRatio <= 0) return;
		var loadMoreBtn = $(pageElement).find('.btn-pager-load-more');
		if(loadMoreBtn.is(":visible")){
			loadMoreBtn.click();
		}
	});
	// start observing
	intersectionObserver.observe(document.querySelector(pageElement));
}
/*
* Custom Javascript | Jquery codes
*/
$(document).ready(function() {
});
