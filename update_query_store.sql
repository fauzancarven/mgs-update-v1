ALTER TABLE `survey`
	ADD COLUMN `StoreId` INT(11) NULL DEFAULT NULL AFTER `ProjectId`;
update survey 
LEFT JOIN project ON project.ProjectId = survey.ProjectId 
SET 
survey.StoreId =  project.StoreId

## -- ## mengaupdate data project

ALTER TABLE `project`
	ADD COLUMN `ProjectCustName` VARCHAR(100) NULL DEFAULT NULL AFTER `StoreId`,
	ADD COLUMN `ProjectCustTelp` VARCHAR(100) NULL DEFAULT NULL AFTER `ProjectCustName`,
	ADD COLUMN `ProjectCustAddress` VARCHAR(200) NULL DEFAULT NULL AFTER `ProjectCustTelp`;
 
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



ALTER TABLE `penawaran`
	ADD COLUMN `CustomerId` INT(11) NULL DEFAULT NULL AFTER `ProjectId`,  
	ADD COLUMN `StoreId` INT(11) NULL DEFAULT NULL AFTER `ProjectId`;
update penawaran 
LEFT JOIN project ON project.ProjectId = penawaran.ProjectId 
SET 
penawaran.StoreId =  project.StoreId,
penawaran.CustomerId =  project.CustomerId;
 
ALTER TABLE `invoice`
	ADD COLUMN `StoreId` INT(11) NULL DEFAULT NULL AFTER `ProjectId`;
update invoice 
LEFT JOIN project ON project.ProjectId = invoice.ProjectId 
SET 
invoice.StoreId =  project.StoreId,
invoice.CustomerId =  project.CustomerId;

ALTER TABLE `payment`
	ADD COLUMN `PaymentFromBank` VARCHAR(200) NULL DEFAULT NULL AFTER `PaymentNote`,
	ADD COLUMN `PaymentFromRek` VARCHAR(200) NULL DEFAULT NULL AFTER `PaymentFromBank`,
	ADD COLUMN `PaymentFromName` VARCHAR(200) NULL DEFAULT NULL AFTER `PaymentFromRek`,
	ADD COLUMN `PaymentToBank` VARCHAR(200) NULL DEFAULT NULL AFTER `PaymentFromName`,
	ADD COLUMN `PaymentToRek` VARCHAR(200) NULL DEFAULT NULL AFTER `PaymentToBank`,
	ADD COLUMN `PaymentToName` VARCHAR(200) NULL DEFAULT NULL AFTER `PaymentToRek`;
