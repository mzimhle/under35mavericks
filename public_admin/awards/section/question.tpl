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
			<li><a href="/awards/section/details.php?code={$awardsubsectionData.awardsection_code}" title="">{$awardsubsectionData.awardsection_name}</a></li>
			<li>{$awardsubsectionData.awardsubsection_name} questions</li>
        </ul>
	</div><!--breadcrumb--> 	
	<div class="inner">
      <h2>{$awardsubsectionData.awardsubsection_name} questions</h2>
    <div class="clearer"><!-- --></div>	
    <div id="sidetabs">
        <ul >             
            <li><a href="/awards/section/details.php?code={$awardsubsectionData.awardsection_code}" title="Details">Details</a></li>
			<li><a href="/awards/section/subsection.php?code={$awardsubsectionData.awardsection_code}" title="Sub Section">Sub Section</a></li>
			<li class="active"><a href="#" title="Questions">Questions</a></li>	
        </ul> 
    </div><!--tabs-->	
	<div class="detail_box">
	<form id="addForm" name="addForm" action="/awards/section/question.php?code={$awardsubsectionData.awardsection_code}&section={$awardsubsectionData.awardsubsection_code}" method="post" enctype="multipart/form-data">
	<table width="100%" class="innertable" border="0" cellspacing="0" cellpadding="0">
		<thead>
		  <tr>
			<th width="80%">Question</th>				
			<th width="10%">Order</th>		
			<th width="*" class="rgt"></th>
			<th width="*" class="rgt"></th>
		   </tr>
	   </thead>
	   <tbody>
	  {foreach from=$questionData item=item}
	  <tr>
		<td>
			<textarea cols="90" rows="2" id="name_{$item.awardquestion_code}" name="name_{$item.awardquestion_code}">{$item.awardquestion_name}</textarea>
		</td>
		<td>
			<input type="text" size="5" value="{$item.awardquestion_index}" name="index_{$item.awardquestion_code}" id="index_{$item.awardquestion_code}" />
		</td>	
		<td><button onclick="javascript:updateForm('{$item.awardquestion_code}'); return false;" >Update</button></td>						
		<td><button onclick="javascript:deleteForm('{$item.awardquestion_code}'); return false;" >Delete</button></td>		
	  </tr>
	  {foreachelse}
		<tr>
			<td colspan="4" class="error">There are no current items in the system.</td>
		</tr>
	  {/foreach}  
		  <tr>
			<th colspan="4">Add a Question</th>
		   </tr>
		<tr>
			<td colspan="3">
				<input type="text" id="awardquestion_name" name="awardquestion_name"  size="80"/>
				{if isset($errorArray.awardquestion_name)}<br /><span class="error">{$errorArray.awardquestion_name}</span>{/if}
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
				url: "question.php",
				data: "{/literal}code={$awardsubsectionData.awardsection_code}&section={$awardsubsectionData.awardsubsection_code}{literal}&awardquestion_code_update="+code+"&name="+$('#name_'+code).val()+"&index="+$('#index_'+code).val(),
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
					url: "question.php",
					data:"{/literal}code={$awardsubsectionData.awardsection_code}&section={$awardsubsectionData.awardsubsection_code}{literal}&awardquestion_code_delete="+id,
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
