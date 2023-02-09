INSERT INTO User(ObjectID, ObjectNumber, ObjectName, CreatedBy, LastModifiedBy, CreatedDateTime, LastModifiedDateTime, IsDeleted, UserName, Password, UserEmail, IsBan, IsAdministrator, RequirePasswordChange, LastLoginTime)
VALUES
(UUID_TO_BIN(UUID()),'','System Administrator','System Administrator','System Administrator', NOW(), NOW(), 0, 'sa', '1', 'abc@gmail.com', 0, 1, 0, NOW())