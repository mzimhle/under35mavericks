<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Maverick</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
<script type="text/javascript" language="javascript" src="default.js"></script>
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
  <div id="content">
    {include_php file='includes/header.php'}
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/company/" title="Jobs">Company</a></li>
			<li><a href="/company/view/" title="Jobs">View Company</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage company</h2>
	<a href="/company/view/details.php" title="Click to Add a new Company" class="blue_button fr mrg_bot_10"><span style="float:right;">Add a new Company</span></a> <br /> 
    <div class="clearer"><!-- --></div>
    <div id="tableContent" align="center">
		<!-- Start Content Table -->
		<div class="content_table">			
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th>Added</th>
						<th>Logo</th>						
						<th>Member</th>
						<th>Name</th>
						<th>Area</th>
						<th>Website</th>
					</tr>
			   </thead>
			   <tbody> 
			  {foreach from=$companyData item=item}
				  <tr>
					<td>{$item.company_added|date_format}</td>
					<td>{if $item.company_logo_name neq ''}<img src="{$item.company_logo_path}tny_{$item.company_logo_name}{$item.company_logo_ext}" width="50" height="50" />{else}<img src="/images/no-logo.jpg" width="50px"/>{/if}</td>					
					<td align="left">{$item.participant_name} {$item.participant_surname}</td>
					<td align="left"><a href="/company/view/details.php?code={$item.company_code}">{$item.company_name}</a></td>					
					<td align="left">{$item.areapost_name}</td>
					<td align="left">{$item.company_website}</td>
				  </tr>
			  {/foreach}     
			  </tbody>
			</table>
		 </div>
		 <!-- End Content Table -->	
	</div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
 {include_php file='includes/footer.php'}
</div>
<!-- End Main Container -->
</body>
</html>
