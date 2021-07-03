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
	
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/awards/" title="Awards">Awards</a></li>
			<li><a href="/awards/galleries/" title="Jobs">Gallery</a></li>
			<li>{if isset($galleryData)}Edit Gallery{else}Add a Gallery{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
<div class="inner"> 
      <h2>{if isset($galleryData)}Edit Gallery{else}Add a Gallery{/if}</h2>
    <div id="sidetabs">
        <ul> 
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="{if isset($galleryData)}/awards/galleries/image.php?code={$galleryData.gallery_code}{else}#{/if}" title="Images">Images</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/awards/galleries/details.php{if isset($galleryData)}?code={$galleryData.gallery_code}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <tr>
			<td><h4 class="error">Name:</h4>
				<br /><input type="text" name="gallery_name" id="gallery_name" value="{$galleryData.gallery_name}" size="60" />
				{if isset($errorArray.gallery_name)}<br /><em class="error">{$errorArray.gallery_name}<em>{else}<br /><em>Gallery name</em>{/if}
			</td>	
		</tr>
		<tr>
			<td>
				<h4 class="error">Year:</h4><br />
				<select name="year_code" id="year_code">
					<option value=""> ---------------------- </option>
					{html_options options=$yearData selected=$galleryData.year_code}
				</select>
				{if isset($errorArray.year_code)}<br /><span class="error">{$errorArray.year_code}</span>{/if}
			</td>			
		</tr>
		<tr>
			<td><h4 class="error">Description:</h4><br />
				<textarea id="gallery_description" name="gallery_description" cols="100" rows="2">{$galleryData.gallery_description}</textarea>
				{if isset($errorArray.gallery_description)}<br /><em id="charcount" class="error">{$errorArray.gallery_description}<em>{else}<br /><em id="charcount" class="error">0 characters entered.</em>{/if}
			</td>		
		</tr>
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
	<div class="mrg_top_10">
	  <a href="/awards/galleries/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
	  <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
	</div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
<!-- End Content recruiter -->
 </div><!-- End Content recruiter -->
 {include_php file='includes/footer.php'}
</div>
{literal}
<script type="text/javascript" language="javascript">

function submitForm() {
	document.forms.detailsForm.submit();					 
}

$(document).ready(function() {	
	$("#gallery_description").keyup(function () {
		var i = $("#gallery_description").val().length;
		$("#charcount").html(i+' characters entered.');
		if (i > 255) {
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
});

</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
