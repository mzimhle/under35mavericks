<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Maverick</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content recruiter -->
  <div id="content">
    {include_php file='includes/header.php'}
  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/event/" title="Events">Events</a></li>
			<li>{if isset($eventData)}Edit Event{else}Add a Event{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($eventData)}Edit Event{else}Add a Event{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/event/details.php{if isset($eventData)}?code={$eventData.event_code}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">	
			<tr>
				<td colspan="3">
					<h4 class="error">Name</h4><br />
					<input type="text" name="event_name" id="event_name" value="{$eventData.event_name}" size="80"/>
					{if isset($errorArray.event_name)}<br /><em class="error">{$errorArray.event_name}<em>{else}<br /><em>Event name</em>{/if}
			</td>	
          </tr>
			<tr>
				<td valign="top">
					<h4 class="error">Start Date and Time</h4><br />
					<input type="text" name="event_startdate" id="event_startdate" value="{$eventData.event_startdate}" size="30" readonly />
					{if isset($errorArray.event_startdate)}<br /><em class="error">{$errorArray.event_startdate}<em>{else}<br /><em>Start date and time of event</em>{/if}
				</td>	
				<td valign="top">
					<h4 class="error">End Date and Time</h4><br />
					<input type="text" name="event_enddate" id="event_enddate" value="{$eventData.event_enddate}" size="30" readonly />
					{if isset($errorArray.event_enddate)}<br /><em class="error">{$errorArray.event_enddate}<em>{else}<br /><em>End date and time of event</em>{/if}
				</td>	
				<td valign="top">
					<h4 class="error">Address</h4><br />
					<textarea name="event_address" id="event_address" rows="3" cols="40" >{$eventData.event_address}</textarea>
					{if isset($errorArray.event_address)}<br /><em class="error">{$errorArray.event_address}<em>{else}<br /><em>Physical address of the event</em>{/if}
				</td>				
          </tr>		  
          <tr>            
			<td colspan="3">
				<h4 class="error">Description:</h4><br />
				<textarea name="event_description" id="event_description" rows="3" cols="80" >{$eventData.event_description}</textarea>
				{if isset($errorArray.company_description)}<br /><em id="charcount" class="error">{$errorArray.company_description}<em>{else}<br /><em id="charcount" class="error">0 characters entered.</em>{/if}				
			</td>	
          </tr>
          <tr>            
			<td colspan="3">
				<h4 class="error">Event Page:</h4><br />
				<textarea name="event_page" id="event_page" rows="40" cols="130" >{$eventData.event_page}</textarea>
				{if isset($errorArray.event_page)}<br /><em class="error">{$errorArray.event_page}<em>{else}<br /><em>Page details of the event</em>{/if}
			</td>	
          </tr>			  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/event/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content -->
{include_php file='includes/footer.php'}
 </div><!-- End Content -->
</div>
{literal}
<script type="text/javascript" language="javascript">

function submitForm() {
	nicEditors.findEditor('event_page').saveContent();
	document.forms.detailsForm.submit();					 
}

$( document ).ready(function() {
	
	$("#event_description").keyup(function () {
		var i = $("#event_description").val().length;
		$("#charcount").html(i+' characters entered.');
		if (i > 255) {
			$('#charcount').removeClass('success');
			$('#charcount').addClass('error');
		} else if(i == 0) {
			$('#charcount').removeClass('success');
			$('#charcount').addClass('error');
		} else {
			$('#charcount').removeClass('error');
			$('#charcount').addClass('success');
		} 
	});
	
	$( "#event_startdate" ).datetimepicker({
		changeMonth: true,
		changeYeah: true,
		numberOfMonths: 1,
		dateFormat: 'yy-mm-dd',
		onClose: function( selectedDate ) {
			$( "#event_enddate" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	
	$( "#event_enddate" ).datetimepicker({
		changeMonth: true,
		changeYeah: true,
		numberOfMonths: 1,
		dateFormat: 'yy-mm-dd',
		onClose: function( selectedDate ) {
			$( "#event_startdate" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	
	$(document).ready(function() {			
		new nicEditor({
			iconsPath	: '/library/javascript/nicedit/nicEditorIcons.gif',
			buttonList 	: ['bold','italic','underline','left','center', 'ol', 'ul', 'xhtml', 'fontFormat', 'fontFamily', 'fontSize', 'unlink', 'link', 'strikethrough', 'superscript', 'subscript', 'upload'],
			maxHeight 	: '1000',
			uploadURI : '/library/javascript/nicedit/nicUpload.php',
		}).panelInstance('event_page');				
	});
});

</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
