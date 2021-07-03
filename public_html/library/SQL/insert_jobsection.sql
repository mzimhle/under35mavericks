INSERT INTO jobsection
(
	fk_recruiter_id, 
	fk_jobCategory_id,
	jobSection_name, 
	jobSection_urlName, 
	jobSection_added, 
	jobSection_updated, 
	jobSection_active, 
	jobSection_deleted
)
select 
	:pRecruiterId,
	jc.pk_jobCategory_id,
	ccs.client_create_section_name,
	ccs.client_create_section_link, 
	now(),
	null,
	jc.jobCategory_active,
	jc.jobCategory_deleted
from 
	client_create_category ccc,
	client_create_section ccs,
	jobcategory jc
where 
	jc.fk_recruiter_id = :pRecruiterId
	and ccc.client_create_link = jc.jobCategory_urlName
	and ccs.client_create_category_link = jc.jobCategory_urlName