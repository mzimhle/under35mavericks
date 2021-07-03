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
			<li><a href="/awards/entryapplication/details.php?code={$applicationData.participant_code}" title="{$applicationData.application_name} {$applicationData.application_surname}">{$applicationData.application_name} {$applicationData.application_surname}</a></li>
			<li>Application company people</li>
        </ul>
	</div><!--breadcrumb-->
	<div class="inner">
		  <div class="clearer"><!-- --></div>
		  <br /><h2>Manage application company people</h2><br />
    <div id="sidetabs">
        <ul > 
            <li><a href="/awards/entryapplication/details.php?code={$applicationData.application_code}" title="Details">Details</a></li>
			<li class="active"><a href="#" title="People">People</a></li>
			<li><a href="/awards/entryapplication/financial.php?code={$applicationData.application_code}" title="Financials">Financials</a></li>
			<li><a href="/awards/entryapplication/employee.php?code={$applicationData.application_code}" title="Employees">Employees</a></li>	
			<li><a href="/awards/entryapplication/question.php?code={$applicationData.application_code}" title="Questionair">Questionair</a></li>				
        </ul>		
        </ul>
    </div><!--tabs-->		  
		  <div class="detail_box">  
		  <form name="peopleForm" id="peopleForm" action="/awards/entryapplication/people.php?code={$applicationData.application_code}" method="post">
			  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="innertable"> 				  
			  <thead>
			  <tr>				
				<th valign="top">Added</th>
				<th valign="top">Name</th>
				<th valign="top">Surname</th>
				<th valign="top">Birth Date</th>
				<th valign="top">Designation</th>							
				<th valign="top"></th>	
			  </tr>
			  </thead>
			  {foreach from=$companypeopleData item=item}
			  <tr>
				<td valign="top">{$item.companypeople_added}</td>
				<td valign="top">{$item.companypeople_name}</td>
				<td valign="top">{$item.companypeople_surname}</td>
				<td valign="top">{$item.companypeople_birthdate}</td>
				<td valign="top">{$item.companypeople_designation}</td>
				<td valign="top"><button type="button" onclick="deleteitem('{$item.companypeople_code}'); return false;">Delete</button></td>
			  </tr>
			   {/foreach}	
			  <tr>				
				<th valign="top">Name</th>
				<th valign="top">Surname</th>
				<th valign="top">Birth Date</th>
				<th valign="top">Designation</th>							
				<th valign="top" colspan="2"></th>	
			  </tr>	
			  <tr>
				<td valign="top"><input type="text" id="companypeople_name" name="companypeople_name" size="20" /></td>		
				<td valign="top"><input type="text" id="companypeople_surname" name="companypeople_surname" size="20" /></td>	
				<td valign="top"><input type="text" id="companypeople_birthdate" name="companypeople_birthdate" size="10" /></td>				
				<td valign="top"><input type="text" id="companypeople_designation" name="companypeople_designation" size="20" /></td>	
				<td valign="top" colspan="2"><button type="button" onclick="submit(); return false;">Add</button></td>	
			  </tr>
			</table>
			{if isset($errorArray.error)}<span style="color: red; font-weight: bold;">{$errorArray.error}</span>{/if}
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
<script type="text/javascript">

function submitForm() {

	document.forms.peopleForm.submit();

}

function deleteitem(id) {
	if(confirm('Are you sure you want to delete this item?')) {
		$.ajax({ 
				type: "GET",
				url: "people.php?code={/literal}{$applicationData.application_code}{literal}",
				data: "delete_code="+id,
				dataType: "json",
				success: function(data){
						if(data.result == 1) {
							alert('Item deleted!');
							window.location.href = window.location.href;
						} else {
							alert(data.error);
						}
				}
		});							
	}
	return false;
}

$( document ).ready(function() {

	$( "#companypeople_birthdate" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true});

});

</script>
{/literal}	
<!-- End Main Container -->
</body>
</html>
