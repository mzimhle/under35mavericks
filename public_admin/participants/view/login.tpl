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
			<li><a href="/participants/view/details.php?code={$participantData.participant_code}" title="Jobs">{$participantData.participant_name} {$participantData.participant_surname}</a></li>
			<li>Logins</li>
        </ul>
	</div><!--breadcrumb-->
	<div class="inner">
		  <div class="clearer"><!-- --></div>
		  <br /><h2>Manage Logins</h2><br />
    <div id="sidetabs">
        <ul > 
            <li><a href="/participants/view/details.php?code={$participantData.participant_code}" title="Details">Details</a></li>
			<li class="active"><a href="#" title="Login">Login</a></li>			
        </ul>
    </div><!--tabs-->		  
		  <div class="detail_box">  
		  <form name="loginForm" id="loginForm" action="/participants/view/login.php?code={$participantData.participant_code}" method="post">
			  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="innertable"> 				  
			  <thead>
			  <tr>				
				<th valign="top">Type</th>
				<th valign="top">ID</th>
				<th valign="top">Username</th>
				<th valign="top">Password</th>
				<th valign="top">Fullname</th>				
				<th valign="top">Image</th>				
				<th valign="top">View</th>				
				<th valign="top"></th>	
			  </tr>
			  </thead>
			  {foreach from=$participantloginData item=item}
			  <tr>
				<td valign="top">{$item.participantlogin_type}</td>		
				<td valign="top">{$item.participantlogin_id}</td>	
				<td valign="top">{$item.participantlogin_username}</td>	
				<td valign="top">{$item.participantlogin_password}</td>				
				<td valign="top">{$item.participantlogin_name} {$item.participantlogin_surname}</td>		
				<td valign="top">{if $item.participantlogin_image neq ''}<img src="{$item.participantlogin_image}" />{else}N/A{/if}</td>			
				<td valign="top">{if $item.participantlogin_url neq ''}<a href="{$item.participantlogin_url}" target="_blank">View</a>{else}N/A{/if}</td>			
				<td valign="top">{if $item.participantlogin_active eq '1'}<button type="button" onclick="actionitem('{$item.participantlogin_code}', '0'); return false;">Deactivate</button>{else}<button type="button" onclick="actionitem('{$item.participantlogin_code}', '1'); return false;">Activate</button>{/if}</td>	
			  </tr>
			  {/foreach}			
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
function actionitem(code, status) {
	if(confirm('Are you sure you want to change status of this item?')) {
		$.ajax({
				type: "GET",
				url: "login.php?code={/literal}{$participantData.participant_code}{literal}",
				data: "actioncode="+code+"&status="+status,
				dataType: "json",
				success: function(data){
						if(data.result == 1) {
							alert('Status Changed');
							window.location.href = '/participants/view/login.php?code={/literal}{$participantData.participant_code}{literal}';
						} else {
							alert(data.message);
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
