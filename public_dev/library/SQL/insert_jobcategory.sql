INSERT INTO jobcategory 
(
	fk_recruiter_id, 
	jobCategory_name, 
	jobCategory_urlName, 
	jobCategory_added, 
	jobCategory_updated, 
	jobCategory_active, 
	jobCategory_deleted
)
select 
	:pRecruiterId,
	ccc.client_create_name,
	ccc.client_create_link, 
	now(),
	null,
	1,
	0
from 
	client_create_category ccc;