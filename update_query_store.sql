ALTER TABLE `survey`
	ADD COLUMN `StoreId` INT(11) NULL DEFAULT NULL AFTER `ProjectId`;
update survey 
LEFT JOIN project ON project.ProjectId = survey.ProjectId 
SET 
survey.StoreId =  project.StoreId

-- ## mengaupdate data project
UPDATE project LEFT JOIN customer ON customer.CustomerId = project.CustomerId
SET 
ProjectCustName = if(CustomerCompany = '-' or CustomerCompany = '',Customername,CONCAT(Customername," (",CustomerCompany, ")")),
ProjectCustTelp = if(CustomerTelp2 = '-' or CustomerTelp2 = '',CustomerTelp1, CONCAT(CustomerTelp1,"/",CustomerTelp2)),
ProjectCustAddress = CustomerAddress;
  
  
  
ALTER TABLE `sample`
	ADD COLUMN `StoreId` INT(11) NULL DEFAULT NULL AFTER `CustomerId`;

update sample 
LEFT JOIN project ON project.ProjectId = sample.ProjectId 
SET 
SampleCustName = ProjectCustName,
SampleCustTelp = ProjectCustTelp,
SampleAddress = ProjectCustAddress
WHERE SampleCustName = ""; 

update sample 
LEFT JOIN project ON project.ProjectId = sample.ProjectId 
SET 
sample.CustomerId = project.CustomerId,
sample.StoreId = project.StoreId; 