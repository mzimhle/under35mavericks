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
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/awards/" title="Awards">Awards</a></li>
			<li><a href="/awards/section/" title="Sections">Sections</a></li>
			<li><a href="/awards/section/details.php?code={$awardsectionData.awardsection_code}" title="">{$awardsectionData.awardsection_name}</a></li>
			<li>Sub Sections</li>
        </ul>
	</div><!--breadcrumb--> 	
	<div class="inner">
      <h2>{$awardsectionData.awardsection_name}'s sub sections</h2>
    <div class="clearer"><!-- --></div>	
    <div id="sidetabs">
        <ul >             
            <li><a href="/awards/section/details.php?code={$awardsectionData.awardsection_code}" title="Details">Details</a></li>
			<li class="active"><a href="#" title="Sub Section">Sub Section</a></li>
			<li><a href="#" title="Questions">Questions</a></li>	
        </ul> 
    </div><!--tabs-->	
	<div class="detail_box">
	<form id="addForm" name="addForm" action="/awards/section/subsection.php?code={$awardsectionData.awardsection_code}" method="post" enctype="multipart/form-data">
	<table width="100%" class="innertable" border="0" cellspacing="0" cellpadding="0">
		<thead>
		  <tr>			
			<th width="80%">Name</th>				
			<th width="10%">Order</th>		
			<th width="*" class="rgt"></th>
			<th width="20%" class="rgt"></th>			
			<th width="*" class="rgt"></th>
		   </tr>
	   </thead>
	   <tbody>
	  {foreach from=$awardsubsectionData item=item}
	  <tr> 
		<td>
			<input type="text" size="80" value="{$item.awardsubsection_name}" name="name_{$item.awardsubsection_code}" id="name_{$item.awardsubsection_code}" 
		</td>
		<td>
			<input type="text" size="5" value="{$item.awardsubsection_index}" name="index_{$item.awardsubsection_code}" id="index_{$item.awardsubsection_code}" />
		</td>
		<td><button onclick="javascript:updateForm('{$item.awardsubsection_code}'); return false;" >Update</button></td>				
		<td><a href="/awards/section/question.php?code={$awardsectionData.awardsection_code}&section={$item.awardsubsection_code}">Add questions</a></td>	
		<td><button onclick="javascript:deleteForm('{$item.awardsubsection_code}'); return false;" >Delete</button></td>		
	  </tr>
	  {foreachelse}
		<tr>
			<td colspan="5" class="error">There are no current items in the system.</td>
		</tr>
	  {/foreach}  
		  <tr>
			<th colspan="5">Add Sub Section Name</th>
		   </tr>
		<tr>
			<td colspan="4">
				<input type="text" id="awardsubsection_name" name="awardsubsection_name"  size="80"/>
				{if isset($errorArray.awardsubsection_name)}<br /><span class="error">{$errorArray.awardsubsection_name}</span>{/if}
			</td>
			<td><button onclick="addForm(); return false;">Add Item</button></td>
		</tr>								
		</tbody>						
	</table>
	</form>
	</div>
	<div class="clearer"><!-- --></div>	

    </div><!--inner-->
<!-- End Content recruiter -->
 </div><!-- End Content recruiter -->
 {include_php file='includes/footer.php'}
</div>
{literal}
<script type="text/javascript">
function addForm() {
	document.forms.addForm.submit();				 
}			
	
function updateForm(code) {
	if(confirm('Are you sure you want to update this item?')) {
		
		$.ajax({ 
				type: "GET",
				url: "subsection.php",
				data: "code={/literal}{$awardsectionData.awardsection_code}{literal}&awardsubsection_code_update="+code+"&name="+$('#name_'+code).val()+"&index="+$('#index_'+code).val(),
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
	
function deleteForm(code) {	
	if(confirm('Are you sure you want to delete this file?')) {
			$.ajax({ 
					type: "GET",
					url: "subsection.php",
					data: "code={/literal}{$awardsectionData.awardsection_code}{literal}&awardsubsection_code_delete="+code,
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
