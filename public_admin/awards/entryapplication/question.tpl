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
			<li>Questionair answers</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{$applicationData.application_name} {$applicationData.application_surname}</h2>
    <div id="sidetabs">
        <ul > 
            <li><a href="/awards/entryapplication/question.php?code={$applicationData.application_code}" title="Details">Details</a></li>
			<li><a href="/awards/entryapplication/people.php?code={$applicationData.application_code}" title="People">People</a></li>		
			<li><a href="#" title="Financials">Financials</a></li>				
			<li><a href="/awards/entryapplication/employee.php?code={$applicationData.application_code}" title="Employees">Employees</a></li>	
			<li class="active"><a href="#" title="Questions">Questions</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm"  method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
			<tr><td><h4 class="heading">Selected Category and Notes</h4></td></tr>
			<tr><td>
			{foreach from=$categoryData item=category}
				<h2>{$category.awardcategory_name}</h2>
				<p class="success">{$category.applicationcategory_notes}</p>
				<hr>
			{/foreach}			
			</td></tr>		
			<tr><td><h4 class="heading">Section Questions</h4></td></tr>
			<tr>
				<td>		  
					{foreach from=$answerData item=section}									
						<h2>{$section.awardsection_name}</h2>
						{foreach from=$section.subsections item=subsection}
							<h3>{$subsection.awardsubsection_name}</h3><br />
							{foreach from=$subsection.answer item=answer}
									<p>{$answer.awardquestion_name}</p>
									<p class="success">{$answer.applicationanswer_notes}</p>
									<hr />
							{/foreach}
						{/foreach}
					{/foreach}
				</td>
			</tr>
			</table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>

    </div><!--inner-->
 </div> 	
<!-- End Content -->
{include_php file='includes/footer.php'}
 </div><!-- End Content -->

</div>
<!-- End Main Container -->
</body>
</html>
