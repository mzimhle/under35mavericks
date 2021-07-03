<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Maverick</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlSIShjTgWG1oLSbRv3XIN-E5Zlkr1iQo"></script>
{literal}
<script type="text/javascript">
var map;
var marker;

function mapa()
{
	var opts = {'center': new google.maps.LatLng({/literal}{$companyData.company_latitude|default:"-33.9285481685662"}, {$companyData.company_longitude|default:"18.42681884765625"}{literal}), 'zoom':14, 'mapTypeId': google.maps.MapTypeId.SATELLITE }
	map = new google.maps.Map(document.getElementById('mapdiv'),opts);
	
	{/literal}{if $companyData.company_latitude neq '' and $companyData.company_longitude neq ''}{literal}
	marker = new google.maps.Marker({
		position: new google.maps.LatLng({/literal}{$companyData.company_latitude}, {$companyData.company_longitude}{literal}),
		map: map
	});
	{/literal}{/if}{literal}
	google.maps.event.addListener(map,'click',function(event) {
		
		//call function to create marker
		if (marker) {
			marker.setMap(null);
			marker = null;
		}
		
		document.getElementById('company_latitude').value = event.latLng.lat();
		document.getElementById('company_longitude').value = event.latLng.lng();
		marker = new google.maps.Marker({
			position: event.latLng,
			map: map
		});
	})
}
</script>
{/literal}
</head>
<body onload="mapa()">
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content recruiter -->
  <div id="content">
    {include_php file='includes/header.php'}
  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/company/" title="Company">Company</a></li>
			<li><a href="/company/view/" title="View">View</a></li>
			<li>{if isset($companyData)}Edit Company{else}Add a Company{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>Details</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="{if isset($companyData)}/company/view/category.php?code={$companyData.company_code}{else}#{/if}" title="Category">Category</a></li>
			<li><a href="{if isset($companyData)}/company/view/service.php?code={$companyData.company_code}{else}#{/if}" title="Services">Services</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/company/view/details.php{if isset($companyData)}?code={$companyData.company_code}{/if}" method="post"   enctype="multipart/form-data">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">		
			<tr>
			<td colspan="3">
				<h4 class="error">Name:</h4>
				<br /><input type="text" name="company_name" id="company_name" value="{$companyData.company_name}" size="80" />
				{if isset($errorArray.company_name)}<br /><em class="error">{$errorArray.company_name}<em>{else}<br /><em>Registered company name</em>{/if}
			</td>			
			</tr>
           <tr>
			<td>
				<h4 class="error">Participant:</h4><br />
				<input type="text" name="participant_name" id="participant_name" value="" size="35" />
				<input type="hidden" name="participant_code" id="participant_code" value="{$companyData.participant_code}" /><br />
				<em class="success" id="selectedparticipant">{$companyData.participant_name} {$companyData.participant_surname}</em>
				{if isset($errorArray.participant_code)}<br /><em class="error">{$errorArray.participant_code}<em>{else}<br /><em>Who this company belongs to</em>{/if}
			</td>
			<td colspan="2">
				<h4 class="error">Area:</h4><br />
				<input type="text" name="areapost_name" id="areapost_name" value="" size="35" />
				<input type="hidden" name="areapost_code" id="areapost_code" value="{$companyData.areapost_code}" /><br />
				<em class="success" id="selectedarea">{$companyData.areapost_name}</em>
				{if isset($errorArray.areapost_code)}<br /><em class="error">{$errorArray.areapost_code}<em>{else}<br /><em>Where is the business located</em>{/if}
			</td>			
          </tr>	
          <tr>
			<td>
				<h4 class="error">Email:</h4><br />
				<input type="text" name="company_email" id="company_email" value="{$companyData.company_email}" size="35" />
				{if isset($errorArray.company_email)}<br /><em class="error">{$errorArray.company_email}<em>{else}<br /><em>e.g. name.surname@domain.com</em>{/if}
			</td>		  
			<td>
				<h4>Telephone:</h4><br />
				<input type="text" name="company_telephone" id="company_telephone" value="{$companyData.company_telephone}" size="35" />
				{if isset($errorArray.company_telephone)}<br /><em class="error">{$errorArray.company_telephone}<em>{else}<br /><em>e.g. 0215874569</em>{/if}
			</td>	
			<td>
				<h4>Cellphone:</h4><br />
				<input type="text" name="company_cellphone" id="company_cellphone" value="{$companyData.company_cellphone}" size="35" />
				{if isset($errorArray.company_cellphone)}<br /><em class="error">{$errorArray.company_cellphone}<em>{else}<br /><em>e.g. 0735698741</em>{/if}
			</td>				
          </tr>	
          <tr>
			<td>
				<h4>Fax:</h4><br />
				<input type="text" name="company_fax" id="company_fax" value="{$companyData.company_fax}" size="35" />
				{if isset($errorArray.company_fax)}<br /><em class="error">{$errorArray.company_fax}<em>{else}<br /><em>e.g. 0215698745</em>{/if}
			</td>		  
			<td>
				<h4>Registration Number:</h4><br />
				<input type="text" name="company_registration" id="company_registration" value="{$companyData.company_registration}" size="35" />
				{if isset($errorArray.company_registration)}<br /><em class="error">{$errorArray.company_registration}<em>{else}<br /><em>e.g. 07 / 256589 / 20</em>{/if}
			</td>	
			<td>
				<h4>Tax Number:</h4><br />
				<input type="text" name="company_tax" id="company_tax" value="{$companyData.company_tax}" size="35" />
				{if isset($errorArray.company_tax)}<br /><em class="error">{$errorArray.company_tax}<em>{else}<br /><em>e.g. 56987412231</em>{/if}
			</td>				
          </tr>			  
          <tr>            
			<td>
				<h4 {if isset($errorArray.imagelogo)}class="error"{/if}>Upload Logo:</h4><br />
				<input type="file" id="imagelogo" name="imagelogo" /><br />
				{if isset($companyData.company_logo_name) && trim($companyData.company_logo_name) neq ''}
					<br /><img src="{$companyData.company_logo_path}tny_{$companyData.company_logo_name}{$companyData.company_logo_ext}" />
				{else}
					<img src="/images/no-logo.jpg" />
				{/if}				
				<br /><br />{if isset($errorArray.imagelogo)}<em class="error">{$errorArray.imagelogo}<em>{else}<br /><em>jpg, jpeg, png images only</em>{/if}		
			</td>
			<td valign="top" colspan="2">
				<h4 class="error">Description (200 charachters):</h4><br />
				<textarea name="company_description" id="company_description" rows="6" cols="90" maxlength="500">{$companyData.company_description}</textarea>
				{if isset($errorArray.company_description)}<br /><em id="charcount" class="error">{$errorArray.company_description}<em>{else}<br /><em id="charcount" class="error">0 characters entered.</em>{/if}
			</td>			
          </tr>
          <tr>
			<td colspan="3">
				<h4 class="error">Physical Address:</h4><br />
				<input type="text" name="company_address" id="company_address" value="{$companyData.company_address}" size="120" />
				{if isset($errorArray.company_address)}<br /><em class="error">{$errorArray.company_address}<em>{else}<br /><em>Physical address of company</em>{/if}
			</td>		
          </tr>
          <tr>
			<td colspan="3">
				<h4>Postal Address:</h4><br />
				<input type="text" name="company_postal" id="company_postal" value="{$companyData.company_postal}" size="120" />
				{if isset($errorArray.company_postal)}<br /><em class="error">{$errorArray.company_postal}<em>{else}<br /><em>Postal address of company</em>{/if}
			</td>		
          </tr>	  
			<tr>
			<td valign="top">
				<h4>Website:</h4><br />
				<input type="text" name="company_website" id="company_website" value="{$companyData.company_website}" size="35" />
				{if isset($errorArray.company_website)}<br /><em class="error">{$errorArray.company_website}<em>{else}<br /><em>e.g. www.mywebsite.co.za</em>{/if}<br /><br /><br />
				<h4 class="error">Longitude:</h4><br />
				<input type="text" name="company_longitude" id="company_longitude" value="{$companyData.company_longitude}" size="30" readonly /><br />
				{if isset($errorArray.company_longitude)}<em class="error">{$errorArray.company_longitude}<em><br />{else}<em>Select company location from map</em><br />{/if}<br />
				<h4 class="error">Latitude:</h4><br />
				<input type="text" name="company_latitude" id="company_latitude" value="{$companyData.company_latitude}" size="30" readonly />
				{if isset($errorArray.company_latitude)}<br /><em class="error">{$errorArray.company_latitude}<em>{else}<br /><em>Select company location from map</em>{/if}				
			</td>
            <td valign="top" colspan="2">
				<div id="mapdiv" style="width: 546px; height:350px;"></div>					
			</td>			
          </tr>		  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/company/view/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
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

	$("#company_description").keyup(function () {
		var i = $("#company_description").val().length;
		$("#charcount").html(i+' characters entered.');
		if (i > 200) {
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
	
	$( "#participant_name" ).autocomplete({
		source: "/feeds/participant.php",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == '') {
				$('#participant_name').html('');
				$('#participant_code').val('');	
				$('#company_telephone').val('');	
				$('#company_contact_surname').val('');	
				$('#company_email').val('');					
			} else {
				$('#participant_name').html('<b>' + ui.item.value + '</b>');
				$('#participant_code').val(ui.item.id);		
				$('#company_cellphone').val(ui.item.cellphone);	
				$('#company_email').val(ui.item.email);							
			}
			
			$('#participant_name').val('');										
		}
	});
	
	$( "#areapost_name" ).autocomplete({
		source: "/feeds/area.php",
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
