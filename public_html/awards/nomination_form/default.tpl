<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Nomination form for Under 35 Maverick Awards</title>
<meta name="keywords" content="maverick awards entry form, enter maverick awards, nomination form, maverick awards nomination " />
<meta name="description" content="This is the nomination form form the under 35 maverick awards, please fill in all relevant details" />
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Under 35 Mavericks"> 
<meta property="og:image" content="http://www.under35mavericks.com/awards/images/35_logo.png"> 
<meta property="og:url" content="http://www.under35mavericks.com">
<meta property="og:site_name" content="Under 35 Mavericks">
<meta property="og:type" content="website">
<meta property="og:description" content="This is the nomination form form the under 35 maverick awards, please fill in all relevant details">
<link rel="icon" type="image/x-icon" href="http://www.under35mavericks.com/favicon.ico" />
<link rel="icon" href="http://www.under35mavericks.com/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="/library/javascript/jquery-ui.css" />
{include_php file='awards/includes/css.php'}
<link rel="stylesheet" href="/css/howl.css" />
</head>
<body>
<div class="mp-pusher" id="mp-pusher">
{include_php file='awards/includes/menu.php'}
    <section class="main-head-form bg-white">
    </section>
    <section class="bg-grey back-box">
        <div class="container">
            <div class="row">
                <div class="form-box">
                    <h1 class="txt-black">Nomination Form</h1>
                    <div class="row">
                        <form id="entry-form" action="#">
                            <div id="slider" class="form">
                                <ul>
                                    <li data-id="slider_start">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <h2 class="sub-prof-head txt-black text-left">Your Information</h2>
                                            <p class="text-left">All fields marked with and axtrix (*) is compulsory.</p>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Full Name(s) and surname <i class="txt-red">*</i></label>
                                                <input class="form-control" type="text"  data-msg="Please enter your full name and surname" name="application_nominator_name" id="application_nominator_name" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Email <i class="txt-red">*</i></label>
                                                <input class="form-control" type="text"  data-msg="Please enter your email address" name="application_nominator_email" id="application_nominator_email" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Telephone Number</label>
                                                <input class="form-control" type="text" data-lmsg="Must be ten digits" data-msg="Please enter your telephone number" name="application_nominator_telephone" id="application_nominator_telephone" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Mobile Number <i class="txt-red">*</i></label>
                                                <input class="form-control" type="text"  data-lmsg="Must be ten digits" data-msg="Please enter your mobile number" name="application_nominator_cellphone" id="application_nominator_cellphone" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>City <i class="txt-red">*</i> - Drop down selection</label></label>
                                                <input class="form-control" type="text" data-msg="Please enter your city" id="nominator_area" name="nominator_area" />
												<input type="hidden" value="" id="application_nominator_area" name="application_nominator_area" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Relationship to Nominee <i class="txt-red">*</i></label></label>
                                                <input class="form-control" type="text" data-msg="Please enter your relationship to nominee" name="application_nominator_relationship" id="application_nominator_relationship" />
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <h2 class="sub-prof-head txt-black text-left">Nominee Information</h2>
                                            <p class="text-left">All fields marked with and axtrix (*) is compulsory.</p>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Name <i class="txt-red">*</i></label>
                                                <input class="form-control" type="text"  data-msg="Please enter the nominee's name" name="application_name" id="application_name" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Surname <i class="txt-red">*</i></label>
                                                <input class="form-control" type="text"  data-msg="Please enter the nominee's surname" name="application_surname" id="application_surname" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Nominee Designation / Business Title <i class="txt-red">*</i></label>
                                                <input class="form-control" type="text"  data-msg="Please enter your full name and surname" name="application_title" id="application_title" />
                                            </div>
                                        </div>										
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Company Name <i class="txt-red">*</i></label>
                                                <input class="form-control" type="text"  data-msg="Please enter the company name" name="application_entity_name" id="application_entity_name" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Industry <i class="txt-red">*</i></label>
												<select id="category_code" name="category_code" class="form-control" data-msg="Please enter your industry">
													{html_options options=$categoryData}
												</select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>City <i class="txt-red">*</i> - Select from drop down</label></label>
                                                <input class="form-control" type="text"  data-msg="Please enter the city" name="areapost_name" id="areapost_name" />
												<input type="hidden" value="" id="areapost_code" name="areapost_code" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Telephone Number</label>
                                                <input class="form-control" type="text" data-lmsg="Must be ten digits" data-msg="Please enter the nominee's telephone number" name="application_telephone" id="application_telephone" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Mobile Number <i class="txt-red">*</i></label>
                                                <input class="form-control" type="text" data-lmsg="Must be ten digits" data-msg="Please enter the nominee's mobile number" name="application_cellphone" id="application_cellphone" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Email <i class="txt-red">*</i></label>
                                                <input class="form-control" type="text"  data-msg="Please enter the nominee's email address" name="application_email" id="application_email" />
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
{include_php file='awards/includes/footer.php'}
</div>
{literal}
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>-->
<script src="/library/javascript/jquery-2.1.0.min.js"></script>
 <script src="/library/javascript/jquery-ui.js"></script>
<script src="/library/javascript/bootstrap.min.3.3.4.js"></script>
<script src="/library/javascript/velocity.min.js"></script>
<script src="/library/javascript/classie.min.js"></script>
<script src="/library/javascript/mlpushmenu.min.js"></script>
<script src="/library/javascript/jFormslider.js"></script>
<script src="/library/javascript/forms.js"></script>
<script src="/library/javascript/howl.js"></script>
<script>
    $(document).ready(function(){
            
        new mlPushMenu( document.getElementById('mp-menu'), document.getElementById('trigger'), {
            type: 'cover'
        });
		
		$( "#application_birthdate" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true});
		
		$( "#nominator_area" ).autocomplete({
			source: "/feeds/areapost.php",
			minLength: 2,
			select: function( event, ui ) {		
				if(ui.item.id == '') {
					$('#nominator_area').html('');
					$('#application_nominator_area').val('');
				} else {
					$('#nominator_area').html(ui.item.value);
					$('#application_nominator_area').val(ui.item.id);
				}
			}
		});
	
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
	
	function submitSlideForm() {

		$.ajax({
			type: "POST",
			url:  "/awards/nomination_form/",
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
		$('#formsuccesstitle').html('Nomination Form Entry');
		$('#formsuccessbody').html('The nomination has been successfully saved and submitted. <p><b>Please note that you will receive an email to activate it as well as confirm your email address. Thank you and all the best.</b></p>');
		$('#formsuccessModal').modal('show');
		return false;
	}
	
	function closeModal() {		
		$('#formsuccessModal').modal('hide');
		window.location.href = window.location.href;
	}
	
</script>
{/literal}
<!-- Modal -->
<div class="modal fade" id="formsuccessModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-controls-modal="formsuccessModal" 
   data-backdrop="static" 
   data-keyboard="false" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				<h4 class="modal-title txt-black text-left" id="formsuccesstitle"></h4>
			</div>
			<div class="modal-body" id="formsuccessbody"></div>
			<div class="modal-footer">
				<button class="btn btn-default" type="button" onclick="javascript:closeModal();">Okey</button>
			</div>
		</div>
	</div>
</div>
<!-- modal -->
</body>
</html>