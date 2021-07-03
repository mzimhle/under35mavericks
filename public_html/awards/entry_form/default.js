var person = 1;

if(typeof String.prototype.trim !== 'function') {
  String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, ''); 
  };
}

$(document).ready(function(){
		
	new mlPushMenu( document.getElementById('mp-menu'), document.getElementById('trigger'), {
		type: 'cover'
	});
	
	$( "#application_birthdate" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true});

	$( "#areapost_name" ).autocomplete({
		source: "/feeds/areapost.php",
		minLength: 2,
		select: function( event, ui ) {		
			if(ui.item.id == '') {
				$('#areapost_name').html('');
				$('#areapost_code').val('');
			} else {
				$('#areapost_name').html(ui.item.value);
				$('#areapost_code').val(ui.item.id);
			}
		}
	});
	
	$(".btn").click(function() {
	  $("html, body").animate({ scrollTop: 0 }, "slow");
	  return false;
	});	
});

function categoryselect() {
	
	var counter 			= 0;
	var countchecked	= 0;
	
	$('.categorybox').each(function () {		
		if($(this).is(':checked')) {
			counter++;
		}
	});
	
	if(counter == 3) {
	
		$('.categorybox').each(function () {		
			if(!$(this).is(':checked')) {				
				$(this).prop('readonly', true);
				$(this).prop('disabled', true);
			} else {
				countchecked++;
				
				var catid = $(this).val();
				var catname = $('#catname_'+catid).html();
				
				$('#categoryname_'+countchecked).html('Category '+countchecked+': '+catname);
				$('#categoryhidden_'+countchecked).val(catid);			
			}
		});
		
	} else if(counter < 3){
		$('.categorybox').each(function () {		
			$(this).prop('readonly', false);
			$(this).prop('disabled', false);
		});	
	}
	
	return false;
}

function validDate(date) {
	var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/ ;

	if(!(date_regex.test(date))) {
		return false;
	} else {
		return true;
	}
}

function addPerson() {
	
	var message = '';
	var html = '';
	
	/* Validate the last person added. */
	var name 		= $('.people_name').last().val().trim();
	var surname 	= $('.people_surname').last().val().trim();
	var birthdate 	= $('.people_birthdate').last().val().trim();
	var designation	= $('.people_designation').last().val().trim();

	if(name == '') {
		message += 'Please add the name.<br />';
	}
	
	if(surname == '') {
		message += 'Please add the surname.<br />';
	}
	
	if(birthdate == '') {
		message += 'Please add the birthday.<br />';
	} else if(!validDate(birthdate)) {
		message += 'Please add a valid date - YYYY-MM-DD.<br />';
	}
	
	if(designation == '') {
		message += 'Please add the designation.<br />';
	}
	
	if(message != '') {
		$.howl ({
		  type: 'danger'
		  , title: 'Error Message(s)'
		  , content: message
		  , sticky: $(this).data ('sticky')
		  , lifetime: 7500
		  , iconCls: $(this).data ('icon')
		});		
	} else {
		
		person++;
		
		/* Add another div for the next person. */
		html = '<span class="person person_'+person+'" ><div class="col-sm-12 col-lg-6"><div class="form-group"><label>Name <i class="txt-red">*</i></label><input class="form-control people_name" type="text" id="people_name[]" name="people_name[]" /></div></div><div class="col-sm-12 col-lg-6"><div class="form-group"><label>Surname <i class="txt-red">*</i></label><input class="form-control people_surname" id="people_surname[]"  name="people_surname[]" type="text" /></div></div><div class="col-sm-12 col-lg-6"><div class="form-group"><label>Birth Date - Format : YYYY-MM-DD <i class="txt-red">*</i></label><input class="form-control people_birthdate" id="people_birthdate[]" name="people_birthdate[]" type="text" /></div></div><div class="col-sm-12 col-lg-6"><div class="form-group"><label>Designation <i class="txt-red">*</i></label><input class="form-control people_designation" id="people_designation[]" name="people_designation[]" type="text" /></div></div><div class="col-sm-12  col-md-12"><a style="float:left" class="btn btn-default rgt-spc pull-right fader" onclick="removePerson('+person+');">Remove</a></div><div class="col-sm-12  col-md-12"><h3 class="sub-intro-head txt-gold text-left"><hr /></h3></div></span>';
		
		$('.people_name').last().prop('readonly', true);
		$('.people_surname').last().prop('readonly', true);
		$('.people_birthdate').last().prop('readonly', true);
		$('.people_designation').last().prop('readonly', true);
		
		$('#people').append(html);
	}
	
	return false;
}

function removePerson(id) {
	
	$('.person_'+id).remove();
	
	if($('.person').length == 1) {
		$('.people_name').prop('readonly', false);
		$('.people_surname').prop('readonly', false);
		$('.people_birthdate').prop('readonly', false);
		$('.people_designation').prop('readonly', false);						
	}
	
	return false;
}

function submitSlideForm() {
	
	formsubmitModal();
	
	$.ajax({
		type: "POST",
		url:  "/awards/entry_form/",
		dataType: "json",
		data: $("#entry-form").serialize(), 
		success: function(data)
		{			
			
			if(data.result == 1) {
				
				formsuccesModal();
			} else {
				
				closeSubmitModal();
				
				$.howl ({
				  type: 'danger'
				  , title: 'Error Message(s)'
				  , content: data.message
				  , sticky: $(this).data ('sticky')
				  , lifetime: 7500
				  , iconCls: $(this).data ('icon')
				});	
			}
		}
	});

	return false;
}

function formsubmitModal() {
	$('#formsuccesstitle').html('Entry Form');
	$('#formsuccessbody').html('<p style="color: red;">Please wait and be patient, we are submitting your entry form..........</p>');
	$('#formsuccessModal').modal('show');
	return false;
}

function closeSubmitModal() {
	$('#formsuccessModal').modal('hide');
	return false;
}

function formsuccesModal() {
	$('#formsuccesstitle').html('Entry Form');
	$('#formsuccessbody').html('<p style="color: green;">The nomination has been successfully saved and submitted.<b>Please note that you will receive an email to activate it as well as confirm your email address. Thank you and all the best.</b></p>');
	//$('#formsuccessModal').modal('show');
	return false;
}

function closeModal() {		
	$('#formsuccessModal').modal('hide');
	window.location.href = window.location.href;
}
