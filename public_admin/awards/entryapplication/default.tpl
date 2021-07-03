<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mavericks</title>
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
			<li><a href="/awards/" title="Awards">Awards</a></li>
			<li><a href="/awards/entryapplication/" title="Award Applications">Award Applications</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Award Applications</h2>
	<a href="/awards/entryapplication/details.php" title="Click to Add a new Application" class="blue_button fr mrg_bot_10"><span style="float:right;">Add a new Application</span></a>  <br /> 
    <div class="clearer"><!-- --></div>
    <div id="tableContent" align="center">
		<!-- Start Content Table -->
		<div class="content_table">
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
				<thead>
				<tr>
				<th>Added</th>
				<th>Year</th>
				<th>Fullname</th>
				<th>Email</th>
				<th>Cellphone / Telephone</th>
				<th>Area</th>
				<th></th>
				</tr>
			   </thead>
			   <tbody> 
			  {foreach from=$applicationData item=item}
			  <tr>
				<td>{$item.application_added|date_format}</td>
				<td>{$item.year_name}</td>
				<td align="left"><a href="/awards/entryapplication/details.php?code={$item.application_code}">{$item.application_name} {$item.application_surname}</a></td>
				<td align="left">{$item.application_email}</a></td>	
				<td align="left">{$item.application_cellphone} / {$item.application_telephone}</td>
				<td align="left">{$item.areapost_name}</td>
				<td align="left"><button onclick="deleteitem('{$item.application_code}')">Delete</button></td>
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
{literal}
<script type="text/javascript" language="javascript">
function deleteitem(id) {
	if(confirm('Are you sure you want to delete this item?')) {
		$.ajax({ 
				type: "GET",
				url: "default.php",
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
