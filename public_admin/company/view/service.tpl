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
			<li><a href="/company/" title="company">company</a></li>
			<li><a href="/company/view/" title="View">View</a></li>
			<li><a href="/company/view/details.php?code={$companyData.company_code}/" title="{$companyData.company_name}">{$companyData.company_name}</a></li>
			<li>Services</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>Add/Edit Services</h2>
    <div id="sidetabs">
        <ul > 
            <li><a href="/company/view/details.php?code={$companyData.company_code}" title="Details">Details</a></li>
			<li><a href="/company/view/category.php?code={$companyData.company_code}" title="Category">Category</a></li>
			<li class="active"><a href="" title="Services">Services</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/company/view/service.php?code={$companyData.company_code}" method="post"  enctype="multipart/form-data">
	<table width="100%" class="innertable" border="0" cellspacing="0" cellpadding="0">
		<thead>
		  <tr>
			<th>Name</th>
			<th>Primary</th>
			<th></th>
			<th></th>
		   </tr>
	   </thead>
	   <tbody>
	  {foreach from=$companyserviceData item=item}
	  <tr>
		<td><input type="text" name="companyservice_name_{$item.companyservice_code}" id="companyservice_name_{$item.companyservice_code}" value="{$item.companyservice_name}" size="60" /></td>																		
		<td>
			<input type="radio" name="companyservice_primary" id="companyservice_primary_{$item.companyservice_code}" value="{$item.companyservice_code}" {if $item.companyservice_primary eq 1} checked="checked"{/if} />
		</td>
		<td>	
			<button onclick="javascript:updateForm('{$item.companyservice_code}'); return false;" >Update</button>
		</td>			
		<td>
			{if $item.companyservice_primary eq 1}		
			N/A
			{else}
			<button onclick="javascript:deleteForm('{$item.companyservice_code}'); return false;" >Delete</button>	
			{/if}
		</td>		
	  </tr>
	  {/foreach}
		  <tr>
			<th colspan="3">Service</th>
			<th></th>
		   </tr>
		<tr>
			<td colspan="3">
				<input type="text" name="companyservice_name" id="companyservice_name" value="" size="60" />
				{if isset($errorArray.category_code)}<br /><span class="error">{$errorArray.category_code}</span>{/if}
			</td>
			<td><button onclick="addItemForm(); return false;">Add Item</button></td>
		</tr>			
		</tbody>						
	</table>
      </form>
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
function addItemForm() {
	document.forms.detailsForm.submit();					 
}
	
function updateForm(id) {
	if(confirm('Are you sure you want to update this file ?')) {
		var primary = '';
		if($('#companyservice_primary_'+id).is(':checked')) {
			primary = id;
		} else {
			alert('No service selected');
			return false;
		}	
		
		$.ajax({ 
				type: "GET",
				url: "service.php",
				data: "code={/literal}{$companyData.company_code}{literal}&update_code="+id+"&companyservice_primary="+primary + "&companyservice_name="+$('#companyservice_name_'+id).val(),
				dataType: "json",
				success: function(data){
						if(data.result == 1) {
							alert('Updated');
							window.location.href = window.location.href;
						} else {
							alert(data.error);
						}
				}
		});							
	}
	
	return false;
}	
	
function deleteForm(id) {	
	if(confirm('Are you sure you want to delete this file?')) {
			$.ajax({ 
					type: "GET",
					url: "service.php",
					data: "code={/literal}{$companyData.company_code}{literal}&delete_code="+id,
					dataType: "json",
					success: function(data){
							if(data.result == 1) {
								alert('Deleted');
								window.location.href = window.location.href;
							} else {
								alert(data.error);
							}
					}
			});								
		}
	return false;
}
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
