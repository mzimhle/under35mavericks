<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Under 35 Maverick Awards</title>
<meta name="description" content="The Maverick Awards for South African Youth Entrepreneurship Excellence represented South Africa’s first award ceremony held to honour the excellence of young entrepreneurs across the country">
<link rel="stylesheet" href="/library/javascript/jquery-ui.css" />
{include_php file='awards/includes/css.php'}
<link rel="stylesheet" href="/css/howl.css" />
</head>
<body>
<div class="mp-pusher" id="mp-pusher">
{include_php file='awards/includes/menu.php'}
    <section class="main-head-form bg-white">
    </section> 
    <section class="bg-grey back-box">
        <div class="container">
            <div class="row">
                <div class="form-box">
                    <h1 class="txt-black">Entry Form</h1>
                    <form id="entry-form" action="#">
                        <div id="slider" class="form">
                            <ul>
                                <li data-id="slider_start">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100s" style="width: 8%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <h2 class="sub-prof-head txt-black text-left">Section A: General Information</h2>
                                        <h3 class="sub-intro-head txt-gold text-left">Your Details</h3>
                                        <p class="text-left">All fields marked with and axtrix (*) is compulsory.</p>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Name <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="application_name" id="application_name" required data-msg="Please enter your name" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Surname <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="application_surname" id="application_surname" required data-msg="Please enter your surname" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Date of Birth <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="application_birthdate" id="application_birthdate" readonly required data-msg="Please enter your date of birth" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Designation / Business Title<i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="application_title" id="application_title" required data-msg="Please enter your designation" />
                                        </div>
                                    </div> 
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Telephone</label>
                                            <input class="form-control" type="text" name="application_telephone" id="application_telephone" data-msg="Please enter your business telephone" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Mobile Number <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" number required data-maxlength="10" data-minlength="10" name="application_cellphone" id="application_cellphone" data-msg="Please enter your mobile number" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group"> 
                                            <label>Email <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="application_email" id="application_email" email required data-msg="Please enter your email address" />
                                        </div> 
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Personal Twitter Handle (without the '@')</label>
                                            <input class="form-control" type="text" name="application_social_twitter" id="application_social_twitter" data-msg="Please enter your cell Twitter handle" />
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="16" aria-valuemin="0" aria-valuemax="100" style="width: 16%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12  col-md-12">
                                        <h2 class="sub-prof-head txt-black text-left">Section B: Business Information</h2>
                                        <h3 class="sub-intro-head txt-gold text-left">Business Details</h3>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Name of the business <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" required name="application_entity_name" id="application_entity_name" data-msg="Please enter the name of the business" />											
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Business Registration Number <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="application_entity_number" id="application_entity_number" required data-msg="Please enter your registration number" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Tax registration Number <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="application_entity_tax" id="application_entity_tax" number required data-lmsg="Must be digits only" data-msg="Please enter your tax registration number" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>BBEE Level <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="application_entity_beelevel" id="application_entity_beelevel" number required data-lmsg="Must be digits only" data-msg="Please enter your BBEE level" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Services / products you offer <i class="txt-red">*</i> - comma separated list</label>
                                            <input class="form-control" type="text" name="application_entity_type" id="application_entity_type" required data-msg="Please enter services and products" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Number of Years in Operation <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="application_entity_years" id="application_entity_years" number required data-lmsg="Must be digits only" data-msg="Please enter your number of years in operation" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Town where business is located <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="areapost_name" id="areapost_name" required data-msg="Select town business is located from drop down" />
                                            <input type="hidden" name="areapost_code" id="areapost_code" />											
                                        </div>
                                    </div>									
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Business Telephone <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="application_entity_telephone" id="application_entity_telephone" number required data-maxlength="10" data-minlength="10" data-lmsg="Must be ten digits" data-msg="Please enter your business telephone" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Business Twitter Handle (without the '@')</label>
                                             <input class="form-control" type="text" name="application_entity_twitter" id="application_entity_twitter"  />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Industry <i class="txt-red">*</i></label>
											<select id="category_code" name="category_code" class="form-control" required data-msg="Please enter your industry">
												{html_options options=$categoryData}
											</select>
                                        </div>
                                    </div>	
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Business Physical Address <i class="txt-red">*</i></label>
                                             <input class="form-control" type="text" name="application_address_physical" id="application_address_physical" required data-msg="Please select physical address of the business" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Business Postal Address</label>
                                             <input class="form-control" type="text" name="application_address_postal" id="application_address_postal"  />
                                        </div>
                                    </div>									
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Website Address</label>
                                             <input class="form-control" type="text" name="application_entity_website" id="application_entity_website"  />
                                        </div>
                                    </div>
                                </li>
                                <li id="addpeople">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100" style="width: 24%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12  col-md-12">
                                        <h2 class="sub-prof-head txt-black text-left">Section B: Business Information</h2>
                                        <h3 class="sub-intro-head txt-gold text-left">Directors and/or Shareholders</h3>
                                    </div>
									<span id="people">		
										<span class="person person_1">									
											<div class="col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Name <i class="txt-red">*</i></label>
													<input class="form-control people_name" id="people_name[]" name="people_name[]" type="text" required data-msg="Please add name of the person" />
												</div>
											</div>
											<div class="col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Surname <i class="txt-red">*</i></label>
													<input class="form-control people_surname" id="people_surname[]" name="people_surname[]" type="text" required data-msg="Please add surname of the person"  />
												</div>
											</div>
											<div class="col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Birth Date <i class="txt-red">*</i></label>
													<input class="form-control people_birthdate" type="text" id="people_birthdate[]" name="people_birthdate[]" required data-msg="Please select birthdate of the person" />
												</div>
											</div>
											<div class="col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Designation <i class="txt-red">*</i></label>
													<input class="form-control people_designation" type="text" id="people_designation[]" name="people_designation[]" required data-msg="Please add designation of the person"  />
												</div>
											</div>
											<div class="col-sm-12  col-md-12">
												<h3 class="sub-intro-head txt-gold text-left"><hr /></h3>
											</div>										
										</span>
									</span>
									<div class="col-sm-12  col-md-12">
										<a style="float:left" class="btn btn-default rgt-spc pull-right fader" onclick="addPerson();">Add another person</a>
									</div>
									<div class="col-sm-12 col-md-12"><h3 class="sub-intro-head txt-gold text-left"><hr /></h3></div>									
                                </li>								
                                <li>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100" style="width: 24%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12  col-md-12">
                                        <h2 class="sub-prof-head txt-black text-left">Section B: Business Information</h2>
                                        <h3 class="sub-intro-head txt-gold text-left">Financial History</h3>
                                    </div>
									<div class="col-sm-12 col-md-12"><h3 class="sub-intro-head txt-gold text-left">2011 / 2012</h3></div>									
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Gross Revenue <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="gross_revenue_11" id="gross_revenue_11" number required data-lmsg="Please enter your gross revenue for 2011 / 2012" data-msg="Please enter your gross revenue for 2011 / 2012" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Gross Profit <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="gross_profit_11" id="gross_profit_11" number required data-lmsg="Please enter your gross profit for 2011 / 2012" data-msg="Please enter your gross profit for 2011 / 2012" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Briefly Explain The Drivers of Y/Y Gross Profit Growth or Reduction in each year <i class="txt-red">*</i></label>
                                            <textarea class="form-control" id="drivers_11" name="drivers_11" required data-msg="Please add your drivers for 2011 / 2012" rows="5" ></textarea>
                                        </div>
                                    </div>
									<div class="col-sm-12 col-md-12"><h3 class="sub-intro-head txt-gold text-left"><hr /></h3></div>											
									<div class="col-sm-12 col-md-12"><h3 class="sub-intro-head txt-gold text-left">2012 / 2013</h3></div>									
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Gross Revenue <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="gross_revenue_12" id="gross_revenue_12" number required data-lmsg="Please enter your gross revenue for 2012 / 2013" data-msg="Please enter your gross revenue for 2012 / 2013" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Gross Profit <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="gross_profit_12" id="gross_profit_12" number required data-lmsg="Please enter your gross profit for 2012 / 2013" data-msg="Please enter your gross profit for 2012 / 2013" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Briefly Explain The Drivers of Y/Y Gross Profit Growth or Reduction in each year <i class="txt-red">*</i></label>
                                            <textarea class="form-control" id="drivers_12" name="drivers_12" required data-msg="Please add your drivers for 2012 / 2013" rows="5" ></textarea>
                                        </div>
                                    </div>
									<div class="col-sm-12 col-md-12"><h3 class="sub-intro-head txt-gold text-left"><hr /></h3></div>											
									<div class="col-sm-12 col-md-12"><h3 class="sub-intro-head txt-gold text-left">2013 / 2014</h3></div>									
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Gross Revenue <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="gross_revenue_13" id="gross_revenue_13" number required data-lmsg="Please enter your gross revenue for 2013 / 2014" data-msg="Please enter your gross revenue for 2013 / 2014" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Gross Profit <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="gross_profit_13" id="gross_profit_13" number required data-lmsg="Please enter your gross profit for 2013 / 2014" data-msg="Please enter your gross profit for 2013 / 2014" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Briefly Explain The Drivers of Y/Y Gross Profit Growth or Reduction in each year <i class="txt-red">*</i></label>
                                            <textarea class="form-control" id="drivers_13" name="drivers_13" required data-msg="Please add your drivers for 2013 / 2014" rows="5" ></textarea>
                                        </div>
                                    </div>
									<div class="col-sm-12 col-md-12"><h3 class="sub-intro-head txt-gold text-left"><hr /></h3></div>										
                                </li>
                                <li>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: 32%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12  col-md-12">
                                        <h2 class="sub-prof-head txt-black text-left">Section B: Business Information</h2>
                                        <h3 class="sub-intro-head txt-gold text-left">Full Time Employee Details</h3>
                                    </div>
									<div class="col-sm-12 col-md-12"><h3 class="sub-intro-head txt-gold text-left">2011 / 2012</h3></div>									
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Total Number of Employees <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="employee_number_11" id="employee_number_11" number required data-lmsg="Please enter the total number of employees for 2011 / 2012" data-msg="Please enter the total number of employees for 2011 / 2012" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Average Employee Remuneration <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="employee_remuneration_11" id="employee_remuneration_11" number required data-lmsg="Please enter the total remuneration of employees for 2011 / 2012" data-msg="Please enter the total remuneration of employees for 2011 / 2012" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Briefly Explain The Drivers of Y/Y Gross Profit Growth or Reduction in each year <i class="txt-red">*</i></label>
                                            <textarea class="form-control" id="employee_drivers_11" name="employee_drivers_11" required data-msg="Please the drivers for employee growth or reduction for 2011 / 2012" rows="5" ></textarea>
                                        </div>
                                    </div>
									<div class="col-sm-12 col-md-12"><h3 class="sub-intro-head txt-gold text-left">2012 / 2013</h3></div>									
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Total Number of Employees <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="employee_number_12" id="employee_number_12" number required data-lmsg="Please enter the total number of employees for 2012 / 2013" data-msg="Please enter the total number of employees for 2012 / 2013" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Average Employee Remuneration <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="employee_remuneration_12" id="employee_remuneration_12" number required data-lmsg="Please enter the total remuneration of employees for 2012 / 2013" data-msg="Please enter the total remuneration of employees for 2012 / 2013" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Briefly Explain The Drivers of Y/Y Gross Profit Growth or Reduction in each year <i class="txt-red">*</i></label>
                                            <textarea class="form-control" id="employee_drivers_12" name="employee_drivers_12" required data-msg="Please the drivers for employee growth or reduction for 2012 / 2013" rows="5" ></textarea>
                                        </div>
                                    </div>
									<div class="col-sm-12 col-md-12"><h3 class="sub-intro-head txt-gold text-left"><hr /></h3></div>
									<div class="col-sm-12 col-md-12"><h3 class="sub-intro-head txt-gold text-left">2013 / 2014</h3></div>									
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Total Number of Employees <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="employee_number_13" id="employee_number_13" number required data-lmsg="Please enter the total number of employees for 2013 / 2014" data-msg="Please enter the total number of employees for 2013 / 2014" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Average Employee Remuneration <i class="txt-red">*</i></label>
                                            <input class="form-control" type="text" name="employee_remuneration_13" id="employee_remuneration_13" number required data-lmsg="Please enter the total remuneration of employees for 2013 / 2014" data-msg="Please enter the total remuneration of employees for 2013 / 2014" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Briefly Explain The Drivers of Y/Y Gross Profit Growth or Reduction in each year <i class="txt-red">*</i></label>
                                            <textarea class="form-control" id="employee_drivers_13" name="employee_drivers_13" required data-msg="Please the drivers for employee growth or reduction for 2013 / 2014" rows="5" ></textarea>
                                        </div>
                                    </div>
									<div class="col-sm-12 col-md-12"><h3 class="sub-intro-head txt-gold text-left"><hr /></h3></div>										
                                </li>
								{foreach from=$questions item=section}
                                <li>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                                            </div>
                                        </div>
                                    </div>									
                                    <div class="col-sm-12  col-md-12">
                                        <h2 class="sub-prof-head txt-black text-left">Section C: {$section.awardsection_name}</h2>
                                    </div>
									{foreach from=$section.subsections item=subsection}
										<div class="col-sm-12  col-md-12">
											<h3 class="sub-intro-head txt-gold text-left">{$subsection.awardsubsection_name}</h3>
										</div>
										{foreach from=$subsection.question item=question}
										<div class="col-sm-12 col-lg-12">
											<div class="form-group">
												<label>{$question.awardquestion_name} <i class="txt-red">*</i></label>
												<textarea class="form-control" required data-msg="This field is required, please populate" rows="6" id="question_{$question.awardquestion_code}" name="question_{$question.awardquestion_code}"></textarea>
											</div>
										</div>
										{/foreach}
									{/foreach}
                                </li>
								{/foreach}
                                <li>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <h2 class="sub-prof-head txt-black text-left">Section C: The Maverick Awards Categories</h2>
                                        <p class="text-left">Please Ensure That You Have Read the Rules/Criteria For Each Category and Only Select a Maximum of 3 Categories That You Wish To Enter<p>
                                    </div>
									{foreach from=$awardcategoryData item=item}
                                    <div class="col-sm-12 col-md-6">
                                        <div class="col-sm-1 col-md-2 col-lg-1">
                                            <div class="form-group text-left">
                                                <input type="checkbox" class="form-control categorybox" id="awardcategorycode[]" value="{$item.awardcategory_code}" onclick="categoryselect();" />
                                            </div>
                                        </div>
                                        <div class="col-sm-11 col-md-10 col-lg-11">
                                            <div class="form-group">
                                                <label for="" class="lowtxt" id="catname_{$item.awardcategory_code}">{$item.awardcategory_name}</label>
                                            </div>
                                        </div>
                                    </div>
									{/foreach}
                                    <div class="col-sm-12 col-md-6">&nbsp;</div>
                                    <div class="col-sm-12 col-md-12">&nbsp;</div>
                                </li>
                                <li>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <h2 class="sub-prof-head txt-black text-left">Section C: Motivation</h2>
                                        <p class="text-left">Motivate how through your visionary entrepreneurial skills, expertise and leadership you have built a business that deserves to be considered for the THREE categories you entered and possibly for the prestigious and coveted Maverick of The Year Award 2015.  Write a motivation for each one of your selected categories in no more than 250 words per award category.</p>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label id="categoryname_1">Award Category 1 <i class="txt-red">*</i></label>
                                            <textarea class="form-control" required data-msg="Please enter your motivation" rows="8" id="categorydescription_1" name="categorydescription_1"></textarea>
											<input type="hidden" id="categoryhidden_1" name="categoryhidden_1" value="" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label id="categoryname_2">Award Category 2 <i class="txt-red">*</i></label>
                                            <textarea class="form-control" required data-msg="Please enter your motivation" rows="8" id="categorydescription_2"  name="categorydescription_2"></textarea>
											<input type="hidden" id="categoryhidden_2" name="categoryhidden_2" value="" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label id="categoryname_3">Award Category 3 <i class="txt-red">*</i></label>
                                            <textarea class="form-control" required data-msg="Please enter your motivation" rows="8" id="categorydescription_3"  name="categorydescription_3"></textarea>
											<input type="hidden" id="categoryhidden_3" name="categoryhidden_3" value="" />
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
{include_php file='awards/includes/footer.php'}
</div>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>-->
<script src="/library/javascript/jquery-2.1.0.min.js"></script>
 <script src="/library/javascript/jquery-ui.js"></script>
<script src="/library/javascript/bootstrap.min.3.3.4.js"></script>
<script src="/library/javascript/velocity.min.js"></script>
<script src="/library/javascript/classie.min.js"></script>
<script src="/library/javascript/mlpushmenu.min.js"></script>
<script src="/library/javascript/jFormslider.js"></script>
<script src="/library/javascript/forms.js"></script>
<script src="/library/javascript/howl.js"></script>
<script src="/awards/entry_form/default.js"></script>
<!-- Modal -->
<div class="modal fade" id="formsuccessModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-controls-modal="formsuccessModal" 
   data-backdrop="static" 
   data-keyboard="false" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				<h4 class="modal-title txt-black text-left" id="formsuccesstitle"></h4>
			</div>
			<div class="modal-body" id="formsuccessbody"></div>
			<div class="modal-footer">
				<button class="btn btn-default" type="button" onclick="javascript:closeModal();">Okey</button>
			</div>
		</div>
	</div>
</div>
<!-- modal -->
</body>
</html>