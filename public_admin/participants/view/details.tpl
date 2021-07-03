<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Maverick</title>
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
			<li><a href="/participants/" title="Members">Members</a></li>
			<li><a href="/participants/view/" title="Registered Members">Registered Members</a></li>
			<li>{if isset($participantData)}Edit Registered Member{else}Add a Registered Member{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($participantData)}Edit Registered Member{else}Add a Registered Member{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="{if isset($participantData)}/participants/view/login.php?code={$participantData.participant_code}{else}#{/if}" title="Login">Login</a></li>	
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/participants/view/details.php{if isset($participantData)}?code={$participantData.participant_code}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <tr>
			<td>
				<h4 class="error">Name:</h4><br /><input type="text" name="participant_name" id="participant_name" value="{$participantData.participant_name}" size="30" />
				{if isset($errorArray.participant_name)}<br /><span class="error">{$errorArray.participant_name}</span>{/if}
			</td>	
			<td><h4 class="error">Surname:</h4><br />
				<input type="text" name="participant_surname" id="participant_surname" value="{$participantData.participant_surname}" size="30" />
				{if isset($errorArray.participant_surname)}<br /><span class="error">{$errorArray.participant_surname}</span>{/if}
			</td>
			<td colspan="2">
				<h4 class="error">Birth Date:</h4><br /><input type="text" name="participant_birthdate" id="participant_birthdate" value="{$participantData.participant_birthdate}" size="10" />
				{if isset($errorArray.participant_birthdate)}<br /><span class="error">{$errorArray.participant_birthdate}</span>{/if}
			</td>								
          </tr>
          <tr>
			<td>
				<h4 class="error">Email:</h4><br />
				<input type="text" name="participant_email" id="participant_email" value="{$participantData.participant_email}" size="30" {if isset($participantData.participant_email)}readonly{/if} />
				{if isset($errorArray.participant_email)}<br /><span class="error">{$errorArray.participant_email}</span>{/if}
			</td>
			<td>
				<h4 class="error">Cellphone:</h4><br /><input type="text" name="participant_cellphone" id="participant_cellphone" value="{$participantData.participant_cellphone}" size="30" />
				{if isset($errorArray.participant_cellphone)}<br /><span class="error">{$errorArray.participant_cellphone}</span>{/if}
			</td>		
			<td>
				<h4>ID Number:</h4><br /><input type="text" name="participant_idnumber" id="participant_idnumber" value="{$participantData.participant_idnumber}" size="30" />
				{if isset($errorArray.participant_idnumber)}<br /><span class="error">{$errorArray.participant_idnumber}</span>{/if}
			</td>			
			</tr>		  
          <tr>
			<td colspan="3">
				<h4 class="error">Area:</h4>
				<input type="text" name="areapost_name" id="areapost_name" value="{$participantData.areapost_name}" size="70" />
				<input type="hidden" name="areapost_code" id="areapost_code" value="{$participantData.areapost_code}" />
				{if isset($errorArray.areapost_code)}<br /><span class="error">{$errorArray.areapost_code}</span>{/if}
			</td>
			</tr>			
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/participants/view/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
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
	document.forms.detailsForm.submit();					 
}

$( document ).ready(function() {
	
	$( "#participant_birthdate" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true});
	
	$( "#areapost_name" ).autocomplete({
		source: "/feeds/areapost.php",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == '') {
				$('#areapost_name').html('');
				$('#areapost_code').val('');					
			} else {
				$('#areapost_name').html('<b>' + ui.item.value + '</b>');
				$('#areapost_code').val(ui.item.id);	
			}
			$('#areapost_name').val('');										
		}
	});
	
});

</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
