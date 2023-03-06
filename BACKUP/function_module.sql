INSERT INTO FunctionModule(ObjectID, ObjectNumber, ObjectName, CreatedBy, LastModifiedBy, CreatedDateTime, LastModifiedDateTime, IsDeleted, Category, SubCategory, FunctionName, DisplayOrder, URL, SubURL, IsEnable)
VALUES
(UUID_TO_BIN(UUID()), '', '', 'System Administrator', 'System Administrator', NOW(), NOW(), 0, 'IT ADMINISTRATION', '', 'Function', 901, '~/modules/01-it-admin/function-module.php', '', 1),
(UUID_TO_BIN(UUID()), '', '', 'System Administrator', 'System Administrator', NOW(), NOW(), 0, 'IT ADMINISTRATION', '', 'Role', 902, '~/modules/01-it-admin/role-module.php', '', 1),
(UUID_TO_BIN(UUID()), '', '', 'System Administrator', 'System Administrator', NOW(), NOW(), 0, 'IT ADMINISTRATION', '', 'Auto Number', 903, '~/modules/01-it-admin/auto-number.php', '', 1),
(UUID_TO_BIN(UUID()), '', '', 'System Administrator', 'System Administrator', NOW(), NOW(), 0, 'SYSTEM SETTING', '', 'User Management', 801, '~/modules/02-system-admin/user-management.php', '', 1),
(UUID_TO_BIN(UUID()), '', '', 'System Administrator', 'System Administrator', NOW(), NOW(), 0, 'WORKFORCE MANAGEMENT', '', 'Employment', 101, '~/modules/03-workforce-management/employment.php', '', 1)