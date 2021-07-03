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
			<li><a href="/awards/" title="Awards">Awards</a></li>
			<li><a href="/awards/nominationapplication/" title="Entry Application">Entry Application</a></li>
			<li>{if isset($applicationData)}Edit Entry Application{else}Add a Entry Application{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($applicationData)}Edit Entry Application{else}Add a Entry Application{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="{if isset($applicationData)}/awards/nominationapplication/people.php?code={$applicationData.application_code}{else}#{/if}" title="People">People</a></li>	
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/awards/nominationapplication/details.php{if isset($applicationData)}?code={$applicationData.application_code}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <tr><td colspan="3"><h4 class="heading">Application year</h4></td></tr>	
		  <tr> 
				<td valign="top" colspan="3">
					<h4 class="error">Application year:</h4><br />
					<select name="year_code" id="year_code">
						<option value=""> ---------------------------- </option>
						{html_options options=$yearData selected=$applicationData.year_code}
					</select>
					{if isset($errorArray.year_code)}<br /><span class="error">{$errorArray.year_code}</span>{/if}
				</td>
				</tr>
		  <tr><td colspan="3"><h4 class="heading">Nominator's Details</h4></td></tr>			
          <tr>
			<td valign="top">
				<h4 class="error">Nominator full name:</h4><br />
				<input type="text" name="application_nominator_name" id="application_nominator_name" value="{$applicationData.application_nominator_name}" size="30" />
				{if isset($errorArray.application_nominator_name)}<br /><span class="error">{$errorArray.application_nominator_name}</span>{/if}
			</td>	
			<td valign="top">
				<h4 class="error">Nominator email:</h4><br />
				<input type="text" name="application_nominator_email" id="application_nominator_email" value="{$applicationData.application_nominator_email}" size="30" />
				{if isset($errorArray.application_nominator_email)}<br /><span class="error">{$errorArray.application_nominator_email}</span>{/if}
			</td>	
			<td valign="top">
				<h4>Nominator cellphone:</h4><br />
				<input type="text" name="application_nominator_cellphone" id="application_nominator_cellphone" value="{$applicationData.application_nominator_cellphone}" size="30" />
				{if isset($errorArray.application_nominator_cellphone)}<br /><span class="error">{$errorArray.application_nominator_cellphone}</span>{/if}
			</td>					
          </tr>
          <tr>	
			<td valign="top">
				<h4>Nominator telephone:</h4><br />
				<input type="text" name="application_nominator_telephone" id="application_nominator_telephone" value="{$applicationData.application_nominator_telephone}" size="30" />
				{if isset($errorArray.application_nominator_telephone)}<br /><span class="error">{$errorArray.application_nominator_telephone}</span>{/if}
			</td>
			<td valign="top">
				<h4 class="error">Nominator / nominee relationship:</h4><br />
				<input type="text" name="application_nominator_relationship" id="application_nominator_relationship" value="{$applicationData.application_nominator_relationship}" size="30" />
				{if isset($errorArray.application_nominator_relationship)}<br /><span class="error">{$errorArray.application_nominator_relationship}</span>{/if}
			</td>			
			<td valign="top">
				<h4 class="error">Nominator area:</h4><br />
				<input type="text" name="application_nominator_area" id="application_nominator_area" value="{$applicationData.application_nominator_area}" size="30" />
				{if isset($errorArray.application_nominator_area)}<br /><span class="error">{$errorArray.application_nominator_area}</span>{/if}
			</td>		
          </tr>			  
		  <tr><td colspan="3"><h4 class="heading">Nominee's Details</h4></td></tr>			
          <tr>
			<td valign="top">
				<h4 class="error">Nominee Name:</h4><br />
				<input type="text" name="application_name" id="application_name" value="{$applicationData.application_name}" size="30" />
				{if isset($errorArray.application_name)}<br /><span class="error">{$errorArray.application_name}</span>{/if}
			</td>	
			<td valign="top">
				<h4 class="error">Nominee Surname:</h4><br />
				<input type="text" name="application_surname" id="application_surname" value="{$applicationData.application_surname}" size="30" />
				{if isset($errorArray.application_surname)}<br /><span class="error">{$errorArray.application_surname}</span>{/if}
			</td>	
			<td valign="top">
				<h4 class="error">Nominee Designation / Business Title:</h4><br />
				<input type="text" name="application_title" id="application_title" value="{$applicationData.application_title}" size="30" />
				{if isset($errorArray.application_title)}<br /><span class="error">{$errorArray.application_title}</span>{/if}
			</td>					
          </tr>
          <tr>
			<td valign="top">
				<h4 class="error">Nominee Email:</h4><br />
				<input type="text" name="application_email" id="application_email" value="{$applicationData.application_email}" size="30"  />
				{if isset($errorArray.application_email)}<br /><span class="error">{$errorArray.application_email}</span>{/if}
			</td>
			<td valign="top">
				<h4>Nominee Cellphone:</h4><br /><input type="text" name="application_cellphone" id="application_cellphone" value="{$applicationData.application_cellphone}" size="30" />
				{if isset($errorArray.application_cellphone)}<br /><span class="error">{$errorArray.application_cellphone}</span>{/if}
			</td>		
			<td valign="top">
				<h4>Nominee Telephone:</h4><br />
				<input type="text" name="application_telephone" id="application_telephone" value="{$applicationData.application_telephone}" size="30" />
				{if isset($errorArray.application_telephone)}<br /><span class="error">{$errorArray.application_telephone}</span>{/if}
			</td>			
			</tr>			
			<tr><td colspan="3"><h4 class="heading">Nominee Enterprise Details</h4></td></tr>	
			<tr>
				<td valign="top" colspan="3">
					<h4 class="error">Registered and trading name(s) of business entity:</h4><br />
					<input type="text" name="application_entity_name" id="application_entity_name" value="{$applicationData.application_entity_name}" size="80" />
					{if isset($errorArray.application_entity_name)}<br /><span class="error">{$errorArray.application_entity_name}</span>{/if}
				</td>	
			</tr>
			<tr>
				<td valign="top">
					<h4 class="error">Industry:</h4><br />
					<select name="category_code" id="category_code">
						<option value=""> ---------------------------- </option>
						{html_options options=$categoryData selected=$applicationData.category_code}
					</select>
					{if isset($errorArray.category_code)}<br /><span class="error">{$errorArray.category_code}</span>{/if}
				</td>		
				<td colspan="2">
					<h4 class="error">Area by postal code:</h4><br />
					<input type="text" name="areapost_name" id="areapost_name" value="{$applicationData.areapost_name}" size="80" />
					<input type="hidden" name="areapost_code" id="areapost_code" value="{$applicationData.areapost_code}" />
					{if isset($errorArray.areapost_code)}<br /><span class="error">{$errorArray.areapost_code}</span>{/if}
				</td>	
			</tr>
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/awards/nominationapplication/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
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
	
	$( "#application_birthdate" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true});
	
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
