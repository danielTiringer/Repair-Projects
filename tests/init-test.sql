INSERT INTO `user`
(`id`, `username`, `email`, `password`, `auth_key`, `access_token`)
VALUES
('100', 'admin', 'admin@example.com', '$2y$13$UiTaTFH5YxpGpuwqGbcZneWcbZeL/M53Mw4StOGBv62NGez9xYTIa', 'test100key', '100-token');

INSERT INTO `user`
(`id`, `username`, `email`, `password`, `auth_key`, `access_token`)
VALUES
('1', 'demo', 'demo@test.com', '$2y$13$/r5q0zm4v3Iu2qvRRUJG2eVeo8TKSSxHiDdskswm4OxGHgqL6CXJe', '', '');

INSERT INTO `project`
(`id`, `make`, `model`, `year`, `code`, `description`, `price`, `source`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`)
VALUES
('1', 'Test_Make', 'Test_Model', '2020', 'Test_Code', 'Test_Description', '100', '1', '1', '1', NULL, '1', NULL);
