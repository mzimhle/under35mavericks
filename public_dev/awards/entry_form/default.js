var person = 1;

$(document).ready(function(){
		
	new mlPushMenu( document.getElementById('mp-menu'), document.getElementById('trigger'), {
		type: 'cover'
	});
	
	$( "#application_birthdate" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true});
	
	$( '.people_birthdate').datepicker({ dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true});

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

function addPerson() {
	
	var message = '';
	var html = '';
	
	/* Validate the last person added. */
	var name 		= $('.people_name').last().val();
	var surname 	= $('.people_surname').last().val();
	var birthdate 	= $('.people_birthdate').last().val();
	var designation	= $('.people_designation').last().val();

	if(name == '') {
		message += 'Please add the name.<br />';
	}
	
	if(surname == '') {
		message += 'Please add the surname.<br />';
	}
	
	if(birthdate == '') {
		message += 'Please add the birthday.<br />';
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
		html = '<span class="person person_'+person+'" ><div class="col-sm-12 col-lg-6"><div class="form-group"><label>Name <i class="txt-red">*</i></label><input class="form-control people_name" type="text" id="people_name[]" name="people_name[]" /></div></div><div class="col-sm-12 col-lg-6"><div class="form-group"><label>Surname <i class="txt-red">*</i></label><input class="form-control people_surname" id="people_surname[]"  name="people_surname[]" type="text" /></div></div><div class="col-sm-12 col-lg-6"><div class="form-group"><label>Birth Date <i class="txt-red">*</i></label><input class="form-control people_birthdate" id="people_birthdate[]" name="people_birthdate[]" type="text" /></div></div><div class="col-sm-12 col-lg-6"><div class="form-group"><label>Designation <i class="txt-red">*</i></label><input class="form-control people_designation" id="people_designation[]" name="people_designation[]" type="text" /></div></div><div class="col-sm-12  col-md-12"><a style="float:left" class="btn btn-default rgt-spc pull-right fader" onclick="removePerson('+person+');">Remove</a></div><div class="col-sm-12  col-md-12"><h3 class="sub-intro-head txt-gold text-left"><hr /></h3></div></span>';
		
		$('.people_name').last().prop('readonly', true);
		$('.people_surname').last().prop('readonly', true);
		$('.people_birthdate').last().prop('readonly', true);
		$('.people_designation').last().prop('readonly', true);
		
		$('#people').append(html);
		
		$( '.people_birthdate').last().datepicker({ dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true});
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

function formsuccesModal() {
	$('#formsuccesstitle').html('Entry Form');
	$('#formsuccessbody').html('The nomination has been successfully saved and submitted.');
	$('#formsuccessModal').modal('show');
	return false;
}

function closeModal() {		
	$('#formsuccessModal').modal('hide');
	window.location.href = window.location.href;
}
