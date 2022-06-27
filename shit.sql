SELECT  DISTINCT * FROM ((SELECT `from_user_id` as `chat`  FROM `chats` WHERE (`from_user_id` = '3' or `to_user_id`='3'))
UNION ALL  (SELECT `to_user_id` as `chat` FROM `chats` WHERE (`from_user_id` = '3'  or `to_user_id`='3'))) t;


WHERE column_name IN (value1, value2, ...);
START TRANSACTION;
COMMIT;