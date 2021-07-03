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
			<li>Application company employees</li>
        </ul>
	</div><!--breadcrumb-->
	<div class="inner">
		  <div class="clearer"><!-- --></div>
		  <br /><h2>Manage application company employees</h2><br />
    <div id="sidetabs">
        <ul > 
            <li><a href="/awards/entryapplication/details.php?code={$applicationData.application_code}" title="Details">Details</a></li>
			<li><a href="/awards/entryapplication/people.php?code={$applicationData.application_code}" title="People">People</a></li>		
			<li><a href="/awards/entryapplication/financial.php?code={$applicationData.application_code}" title="Financials">Financials</a></li>				
			<li class="active"><a href="#" title="Employees">Employees</a></li>	
			<li><a href="/awards/entryapplication/question.php?code={$applicationData.application_code}" title="Questionair">Questionair</a></li>				
        </ul>
    </div><!--tabs-->		  
		  <div class="detail_box">  
		  <form name="financialsForm" id="financialsForm" action="/awards/entryapplication/employee.php?code={$applicationData.application_code}" method="post">
			  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="innertable"> 				  
			  <thead>
			  <tr>				
				<th valign="top">Year</th>
				<th valign="top">Total Number of Employees </th>
				<th valign="top">Average Employee Remuneration </th>
				<th valign="top">Briefly Explain The Drivers of Y/Y Total Employee Growth or Reduction in each year</th>						
				<th valign="top"></th>	
			  </tr>
			  </thead>
			  {foreach from=$applicationentityData item=item}
			  <tr>
				<td valign="top">{$item.applicationentity_year}</td>
				<td valign="top">{$item.applicationentity_employee_number}</td>				
				<td valign="top">{$item.applicationentity_employee_amount}</td>
				<td valign="top">{$item.applicationentity_description}</td>
				<td valign="top"><button type="button" onclick="deleteitem('{$item.applicationentity_code}'); return false;">Delete</button></td>
			  </tr>
			   {/foreach}		
			  <tr>
				<td valign="top">
					<select id="applicationentity_year" name="applicationentity_year">
						<option value=""> ---------------- </option>
						<option value="2011 / 2012"> 2011 / 2012 </option>
						<option value="2012 / 2013"> 2012 / 2013 </option>
						<option value="2013 / 2014"> 2013 / 2014 </option>
						<option value="2014 / 2015"> 2014 / 2015 </option>
					</select>
				</td>		
				<td valign="top"><input type="text" id="applicationentity_employee_number" name="applicationentity_employee_number" size="15" /></td>	
				<td valign="top"><input type="text" id="applicationentity_employee_amount" name="applicationentity_employee_amount" size="15" /></td>				
				<td valign="top"><textarea id="applicationentity_description" name="applicationentity_description" cols="70" rows="3"></textarea></td>	
				<td valign="top" colspan="2"><button type="button" onclick="submit(); return false;">Add</button></td>	
			  </tr>
			</table>
			{if isset($errorArray)}<br /><br /><span class="error">{$errorArray}</span>{/if}
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
				url: "employee.php?code={/literal}{$applicationData.application_code}{literal}",
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

</script>
{/literal}	
<!-- End Main Container -->
</body>
</html>
