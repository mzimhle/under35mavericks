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
			<li><a href="/awards/section/" title="Awards Sections">Awards Sections</a></li>
			<li>{if isset($awardsectionData)}Edit Awards Section{else}Add a Awards Section{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>{if isset($awardsectionData)}Edit Awards Section{else}Add a Awards Section{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="{if isset($awardsectionData)}/awards/section/subsection.php?code={$awardsectionData.awardsection_code}{else}#{/if}" title="Sub Section">Sub Section</a></li>
			<li><a href="#" title="Questions">Questions</a></li>			
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/awards/section/details.php{if isset($awardsectionData)}?code={$awardsectionData.awardsection_code}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <tr>
			<td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="awardsection_name" id="awardsection_name" value="{$awardsectionData.awardsection_name}" size="80" />
				{if isset($errorArray.awardsection_name)}<br /><span class="error">{$errorArray.awardsection_name}</span>{/if}
			</td>				
          </tr>
		  {if isset($awardsectionData)}
          <tr>
			<td>
				<h4 class="error">Order:</h4><br />
				<span class="success">Display order is : {$awardsectionData.awardsection_index}</span>
			</td>				
          </tr>		  
		  {/if}
          <tr>
			<td>
				<h4 class="error">Year of awards:</h4><br />
				{if isset($awardsectionData)}
					<span class="success">Year is : {$awardsectionData.year_name}</span>
				{else}				
				<select name="year_code" id="year_code">
					<option value=""> ----- </option>
					{html_options options=$yearpairs selected=$awardsectionData.year_code}
				</select>
				{if isset($errorArray.year_code)}<br /><span class="error">{$errorArray.year_code}</span>{/if}
				{/if}
			</td>		
			</tr>		  			
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/awards/section/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
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
function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>