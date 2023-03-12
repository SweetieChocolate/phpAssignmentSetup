TRUNCATE `PayrollSetting`;
INSERT INTO `PayrollSetting` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`) VALUES
(0x26e85efdc08c11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 11:12:49.907450', '2023-03-12 11:43:02.458043', b'0');

TRUNCATE `TaxContribution`;
INSERT INTO `TaxContribution` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `PayrollSettingID`, `FromAmount`, `ToAmount`, `TaxRate`, `CumulativeDeduction`) VALUES
(0x3e378d2dc08d11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 11:20:38.510393', '2023-03-12 11:22:35.183986', b'0', 0x26e85efdc08c11ed8f3450ebf62b0b36, 0, 1500000, 0, 0),
(0x52593d5ac08d11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 11:21:12.285590', '2023-03-12 11:43:02.465460', b'0', 0x26e85efdc08c11ed8f3450ebf62b0b36, 1500001, 2000000, 5, 75000),
(0x615fcd84c08d11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 11:21:37.494424', '2023-03-12 11:43:02.463650', b'0', 0x26e85efdc08c11ed8f3450ebf62b0b36, 2000001, 8500000, 10, 175000),
(0x6f7a1adcc08d11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 11:22:01.154900', '2023-03-12 11:43:02.461645', b'0', 0x26e85efdc08c11ed8f3450ebf62b0b36, 8500001, 12500000, 15, 600000),
(0x820df2b4c08d11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 11:22:32.322796', '2023-03-12 11:43:02.459861', b'0', 0x26e85efdc08c11ed8f3450ebf62b0b36, 12500001, 1000000000, 20, 1225000);