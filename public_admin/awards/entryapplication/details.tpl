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
			<li><a href="/awards/entryapplication/" title="Entry Application">Entry Application</a></li>
			<li>{if isset($applicationData)}Edit Entry Application{else}Add a Entry Application{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($applicationData)}Edit Entry Application{else}Add a Entry Application{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="{if isset($applicationData)}/awards/entryapplication/people.php?code={$applicationData.application_code}{else}#{/if}" title="People">People</a></li>	
			<li><a href="{if isset($applicationData)}/awards/entryapplication/financial.php?code={$applicationData.application_code}{else}#{/if}" title="Financials">Financials</a></li>
			<li><a href="{if isset($applicationData)}/awards/entryapplication/employee.php?code={$applicationData.application_code}{else}#{/if}" title="Employees">Employees</a></li>	
			<li><a href="{if isset($applicationData)}/awards/entryapplication/question.php?code={$applicationData.application_code}{else}#{/if}" title="Questionair">Questionair</a></li>				
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/awards/entryapplication/details.php{if isset($applicationData)}?code={$applicationData.application_code}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <tr><td colspan="3"><h4 class="heading">Entrepreneur’s Details</h4></td></tr>			
          <tr>
			<td valign="top">
				<h4 class="error">Name:</h4><br />
				<input type="text" name="application_name" id="application_name" value="{$applicationData.application_name}" size="30" />
				{if isset($errorArray.application_name)}<br /><span class="error">{$errorArray.application_name}</span>{/if}
			</td>	
			<td valign="top">
				<h4 class="error">Surname:</h4><br />
				<input type="text" name="application_surname" id="application_surname" value="{$applicationData.application_surname}" size="30" />
				{if isset($errorArray.application_surname)}<br /><span class="error">{$errorArray.application_surname}</span>{/if}
			</td>	
			<td valign="top">
				<h4 class="error">Designation / Business Title:</h4><br />
				<input type="text" name="application_title" id="application_title" value="{$applicationData.application_title}" size="30" />
				{if isset($errorArray.application_title)}<br /><span class="error">{$errorArray.application_title}</span>{/if}
			</td>					
          </tr>
          <tr>
			<td valign="top">
				<h4 class="error">Email:</h4><br />
				<input type="text" name="application_email" id="application_email" value="{$applicationData.application_email}" size="30"  />
				{if isset($errorArray.application_email)}<br /><span class="error">{$errorArray.application_email}</span>{/if}
			</td>
			<td valign="top">
				<h4 class="error">Cellphone:</h4><br /><input type="text" name="application_cellphone" id="application_cellphone" value="{$applicationData.application_cellphone}" size="30" />
				{if isset($errorArray.application_cellphone)}<br /><span class="error">{$errorArray.application_cellphone}</span>{/if}
			</td>		
			<td valign="top">
				<h4>Telephone:</h4><br />
				<input type="text" name="application_telephone" id="application_telephone" value="{$applicationData.application_telephone}" size="30" />
				{if isset($errorArray.application_telephone)}<br /><span class="error">{$errorArray.application_telephone}</span>{/if}
			</td>			
			</tr>		  
			<tr>
				<td valign="top">
					<h4 class="error">Birth Date:</h4><br />
					<input type="text" name="application_birthdate" id="application_birthdate" value="{$applicationData.application_birthdate}" size="10" />
					{if isset($errorArray.application_birthdate)}<br /><span class="error">{$errorArray.application_birthdate}</span>{/if}
				</td>		
				<td valign="top" colspan="2">
					<h4 class="error">Application year:</h4><br />
					<select name="year_code" id="year_code">
						<option value=""> ---------------------------- </option>
						{html_options options=$yearData selected=$applicationData.year_code}
					</select>
					{if isset($errorArray.year_code)}<br /><span class="error">{$errorArray.year_code}</span>{/if}
				</td>				
			</tr>
			<tr><td colspan="3"><h4 class="heading">Enterprise Details</h4></td></tr>	
			<tr>
				<td valign="top">
					<h4 class="error">Registered and trading name(s) of business entity:</h4><br />
					<input type="text" name="application_entity_name" id="application_entity_name" value="{$applicationData.application_entity_name}" size="30" />
					{if isset($errorArray.application_entity_name)}<br /><span class="error">{$errorArray.application_entity_name}</span>{/if}
				</td>	
				<td valign="top">
					<h4 class="error">Business registration number:</h4><br />
					<input type="text" name="application_entity_number" id="application_entity_number" value="{$applicationData.application_entity_number}" size="30" />
					{if isset($errorArray.application_entity_number)}<br /><span class="error">{$errorArray.application_entity_number}</span>{/if}
				</td>
				<td valign="top">
					<h4>Tax registration number:</h4><br />
					<input type="text" name="application_entity_tax" id="application_entity_tax" value="{$applicationData.application_entity_tax}" size="30" />
					{if isset($errorArray.application_entity_tax)}<br /><span class="error">{$errorArray.application_entity_tax}</span>{/if}
				</td>		
			</tr>
			<tr>
				<td valign="top">
					<h4 class="error">BBEE level:</h4><br />
					<input type="text" name="application_entity_beelevel" id="application_entity_beelevel" value="{$applicationData.application_entity_beelevel}" size="30" />
					{if isset($errorArray.application_entity_beelevel)}<br /><span class="error">{$errorArray.application_entity_beelevel}</span>{/if}
				</td>	
				<td valign="top">
					<h4 class="error">Type of business entity:</h4><br />
					<input type="text" name="application_entity_type" id="application_entity_type" value="{$applicationData.application_entity_type}" size="30" />
					{if isset($errorArray.application_entity_type)}<br /><span class="error">{$errorArray.application_entity_type}</span>{/if}
				</td>
				<td valign="top">
					<h4 class="error">Industry:</h4><br />
					<select name="category_code" id="category_code">
						<option value=""> ---------------------------- </option>
						{html_options options=$categoryData selected=$applicationData.category_code}
					</select>
					{if isset($errorArray.category_code)}<br /><span class="error">{$errorArray.category_code}</span>{/if}
				</td>		
			</tr>
			<tr>
				<td valign="top">
					<h4 class="error">Number of years in operation:</h4><br />
					<input type="text" name="application_entity_years" id="application_entity_years" value="{$applicationData.application_entity_years}" size="5" />
					{if isset($errorArray.application_entity_years)}<br /><span class="error">{$errorArray.application_entity_years}</span>{/if}
				</td>	
				<td valign="top">
					<h4 class="error">Business physical address:</h4><br />
					<textarea cols="30" rows="2" name="application_entity_physical" id="application_entity_physical">{$applicationData.application_entity_physical}</textarea>
					{if isset($errorArray.application_entity_physical)}<br /><span class="error">{$errorArray.application_entity_physical}</span>{/if}
				</td>
				<td valign="top">
					<h4>Business postal address:</h4><br />
					<textarea cols="30" rows="2" name="application_entity_postal" id="application_entity_postal">{$applicationData.application_entity_postal}</textarea>
					{if isset($errorArray.application_entity_postal)}<br /><span class="error">{$errorArray.application_entity_postal}</span>{/if}
				</td>		
			</tr>
			<tr>
			<td colspan="2">
				<h4 class="error">Area by postal code:</h4><br />
				<input type="text" name="areapost_name" id="areapost_name" value="{$applicationData.areapost_name}" size="80" />
				<input type="hidden" name="areapost_code" id="areapost_code" value="{$applicationData.areapost_code}" />
				{if isset($errorArray.areapost_code)}<br /><span class="error">{$errorArray.areapost_code}</span>{/if}
			</td>				
			<td valign="top">
				<h4 class="error">Province:</h4><br />
				{$applicationData.demarcation_name|default:"No area selected"}
			</td>
			</tr>
			<tr>
				<td valign="top">
					<h4>Business telephone number:</h4><br />
					<input type="text" name="application_entity_telephone" id="application_entity_telephone" value="{$applicationData.application_entity_telephone}" size="30" />
					{if isset($errorArray.application_entity_telephone)}<br /><span class="error">{$errorArray.application_entity_telephone}</span>{/if}
				</td>	
				<td valign="top">
					<h4>Business twitter handler ( without the @ ):</h4><br />
					<input type="text" name="application_entity_twitter" id="application_entity_twitter" value="{$applicationData.application_entity_twitter}" size="30" />
					{if isset($errorArray.application_entity_twitter)}<br /><span class="error">{$errorArray.application_entity_twitter}</span>{/if}
				</td>
				<td valign="top">
					<h4>Business website link ( starting with http:// or https:// ):</h4><br />
					<input type="text" name="application_entity_website" id="application_entity_website" value="{$applicationData.application_entity_website}" size="30" />
					{if isset($errorArray.application_entity_website)}<br /><span class="error">{$errorArray.application_entity_website}</span>{/if}
				</td>		
			</tr>			
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/awards/entryapplication/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
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
