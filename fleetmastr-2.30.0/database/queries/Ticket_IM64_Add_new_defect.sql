INSERT INTO `defect_master` (`order`, `page_title`, `app_question`, `app_question_with_defect`, `defect`, `has_image`, `has_text`, `is_prohibitional`, `safety_notes`, `for_hgv`, `for_non-hgv`) VALUES ('1', 'Dash Status and Warnings', 'Is the dashboard free from advisory or warning symbols?', 'Is the dashboard free from additional advisory or warning symbols?', 'AdBlue warning light on dash', '1', '0', '1', 'Re-fill Adblue asap', '1', '1');
INSERT INTO `defect_master` (`order`, `page_title`, `app_question`, `app_question_with_defect`, `defect`, `has_image`, `has_text`, `is_prohibitional`, `safety_notes`, `for_hgv`, `for_non-hgv`) VALUES ('1', 'Dash Status and Warnings', 'Is the dashboard free from advisory or warning symbols?', 'Is the dashboard free from additional advisory or warning symbols?', 'Oil change on message list', '1', '0', '0', 'Contact Fleet and advise that a workshop booking is required', '1', '1');
INSERT INTO `defect_master` (`order`, `page_title`, `app_question`, `app_question_with_defect`, `defect`, `has_image`, `has_text`, `is_prohibitional`, `safety_notes`, `for_hgv`, `for_non-hgv`) VALUES ('1', 'Dash Status and Warnings', 'Is the dashboard free from advisory or warning symbols?', 'Is the dashboard free from additional advisory or warning symbols?', 'Service light on dash', '1', '0', '0', 'Contact Fleet and advise that a workshop booking is required', '1', '1');
INSERT INTO `defect_master` (`order`, `page_title`, `app_question`, `app_question_with_defect`, `defect`, `has_image`, `has_text`, `is_prohibitional`, `safety_notes`, `for_hgv`, `for_non-hgv`) VALUES ('31', 'Tyre Safety Check', 'Tyre Safety Check', 'Tyre Safety Check', 'Tyre safety check', '0', '0', '0', 'Contact Fleet and advise that a workshop booking is required', '1', '1');
INSERT INTO `defect_master` (`order`, `page_title`, `app_question`, `app_question_with_defect`, `defect`, `has_image`, `has_text`, `is_prohibitional`, `safety_notes`, `for_hgv`, `for_non-hgv`) VALUES ('32', 'Vehicle for MOT', 'Vehicle for MOT', 'Vehicle for MOT', 'Vehicle for MOT', '0', '0', '0', 'Advisory defect', '1', '1');
INSERT INTO `defect_master` (`order`, `page_title`, `app_question`, `app_question_with_defect`, `defect`, `has_image`, `has_text`, `is_prohibitional`, `safety_notes`, `for_hgv`, `for_non-hgv`) VALUES ('33', 'Vehicle for Service', 'Vehicle for Service', 'Vehicle for Service', 'Vehicle for service', '0', '0', '0', 'Advisory defect', '1', '1');
INSERT INTO `defect_master` (`order`, `page_title`, `app_question`, `app_question_with_defect`, `defect`, `has_image`, `has_text`, `is_prohibitional`, `safety_notes`, `for_hgv`, `for_non-hgv`) VALUES ('34', 'Wheel Re-torque Required', 'Wheel Re-torque Required', 'Wheel Re-torque Required', 'Wheel re-torque required', '0', '0', '0', 'Wheels must be re-torqued to correct Nm, stand for 30 mins and be re-torqued again', '1', '1');
INSERT INTO `defect_master` (`order`, `page_title`, `app_question`, `app_question_with_defect`, `defect`, `has_image`, `has_text`, `is_prohibitional`, `safety_notes`, `for_hgv`, `for_non-hgv`) VALUES ('35', 'Wheel Alignment and Tracking', 'Wheel Alignment and Tracking', 'Wheel Alignment and Tracking', 'Wheel alignment and tracking', '0', '0', '0', 'Contact Fleet and advise that a workshop booking is required', '1', '1');

UPDATE `defect_master_vehicle_types` SET `defect_list` = CONCAT(`defect_list`, ",31,32,33,34,35") WHERE `defect_list` NOT LIKE "%,31,32,33,34,35";
