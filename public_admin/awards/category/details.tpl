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
			<li><a href="/awards/category/" title="Awards Categories">Awards Categories</a></li>
			<li>{if isset($awardcategoryData)}Edit Awards Category{else}Add a Awards Category{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>{if isset($awardcategoryData)}Edit Awards Category{else}Add a Awards Category{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/awards/category/details.php{if isset($awardcategoryData)}?code={$awardcategoryData.awardcategory_code}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <tr>
			<td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="awardcategory_name" id="awardcategory_name" value="{$awardcategoryData.awardcategory_name}" size="80" />
				{if isset($errorArray.awardcategory_name)}<br /><span class="error">{$errorArray.awardcategory_name}</span>{/if}
			</td>				
          </tr>
          <tr>
			<td>
				<h4 class="error">Year of awards:</h4><br />
				<select name="year_code" id="year_code">
					<option value=""> ----- </option>
					{html_options options=$yearpairs selected=$awardcategoryData.year_code}
				</select>
				{if isset($errorArray.year_code)}<br /><span class="error">{$errorArray.year_code}</span>{/if}
			</td>		
			</tr>		  			
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/awards/category/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
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
