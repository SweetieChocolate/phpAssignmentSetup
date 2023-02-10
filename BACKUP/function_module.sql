INSERT INTO FunctionModule(ObjectID, ObjectNumber, ObjectName, CreatedBy, LastModifiedBy, CreatedDateTime, LastModifiedDateTime, IsDeleted, Category, SubCategory, FunctionName, DisplayOrder, URL, SubURL, IsEnable)
VALUES
(UUID_TO_BIN(UUID()), '', '', 'System Administrator', 'System Administrator', NOW(), NOW(), 0, 'WORKFORCE MANAGEMENT', '', 'Emloyment', 301, '~/employment.php', '', 1),
(UUID_TO_BIN(UUID()), '', '', 'System Administrator', 'System Administrator', NOW(), NOW(), 0, 'WORKFORCE MANAGEMENT', '', 'Career History', 302, '~/careerhistory.php', '', 1),
(UUID_TO_BIN(UUID()), '', '', 'System Administrator', 'System Administrator', NOW(), NOW(), 0, 'PAYROLL', '', 'Generate Salary', 401, '~/monthlysalary.php', '', 1)