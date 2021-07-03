<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Maverick</title>
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
			<li><a href="/event/" title="Events">Events</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Events</h2>
	<a href="/event/details.php" title="Click to Add a new Event" class="blue_button fr mrg_bot_10"><span style="float:right;">Add a new Event</span></a> <br /> 
    <div class="clearer"><!-- --></div>
    <div id="tableContent" align="center">
		<!-- Start Content Table -->
		<div class="content_table">			
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
				<thead>
				<tr>
					<th>Added</th>
					<th>Name</th>
					<th>Address</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Status</th>
					<th></th>
					<th></th>						
				</tr>
			   </thead>
			   <tbody> 
			  {foreach from=$eventData item=item}
			  <tr>
				<td>{$item.event_added|date_format}</td>
				<td align="left"><a href="/event/details.php?code={$item.event_code}">{$item.event_name}</a></td>
				<td align="left">{$item.event_address}</td>
				<td align="left">{$item.event_startdate}</td>
				<td align="left">{$item.event_enddate}</td>
				<td align="left">{if $item.event_active eq '1'}<span style="color: green;">Active</span>{else}<span style="color: red;">Not Active</span>{/if}</td>
				<td align="right">{if $item.event_active eq '1'}<button onclick="activate('{$item.event_code}', '0')">Deactivate</button>{else}<button onclick="activate('{$item.event_code}', '1')">Activate</button>{/if}</td>
				<td align="right"><button onclick="deleteitem('{$item.event_code}')">Delete</button></td>					
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

function activate(id, status) {					
	if(confirm('Are you sure you want to change this item status?')) {
		$.ajax({ 
				type: "GET",
				url: "default.php",
				data: "activate_code="+id+"&status="+status,
				dataType: "json",
				success: function(data){
						if(data.result == 1) {
							alert('Status changed');
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
</body>
</html>
