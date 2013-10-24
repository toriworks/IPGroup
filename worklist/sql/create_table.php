<?
/* �׷����� ���̺� */
$sql = 'CREATE TABLE `mp_group_info` ( `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT, `seq` TINYINT UNSIGNED NOT NULL , `group` VARCHAR( 20 ) NOT NULL , PRIMARY KEY ( `id` ) , INDEX ( `seq` ) ) TYPE = MYISAM COMMENT = \'�׷����� ���̺�\'; '; 

/* �۾������� ���̺� */
$sql = 'CREATE TABLE `mp_worker_info` ( `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT, `group` TINYINT UNSIGNED NOT NULL , `seq` TINYINT UNSIGNED NOT NULL , `worker` VARCHAR( 20 ) NOT NULL , PRIMARY KEY ( `id` ) , INDEX ( `group` , `seq` ) ) TYPE = MYISAM COMMENT = \'�۾������� ���̺�\'; '; 

/* �������� ���̺� */
$sql = 'CREATE TABLE `mp_type_info` ( `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT, `group` TINYINT UNSIGNED NOT NULL , `seq` TINYINT UNSIGNED NOT NULL , `type` VARCHAR( 20 ) NOT NULL , PRIMARY KEY ( `id` ) , INDEX ( `group` , `seq` ) ) TYPE = MYISAM COMMENT = \'�������� ���̺�\''; 

/* ������Ʈ���� ���̺� */
$sql = 'CREATE TABLE `mp_project_info` ( `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT, `seq` TINYINT UNSIGNED NOT NULL , `project` VARCHAR( 40 ) NOT NULL , PRIMARY KEY ( `id` ) , INDEX ( `seq` ) ) TYPE = MYISAM COMMENT = \'������Ʈ���� ���̺�\'; '; 

/* �۾����� ���̺� */
$sql = 'CREATE TABLE `mp_work_data` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `date` DATE NOT NULL , `project` TINYINT UNSIGNED NOT NULL , `worker` TINYINT UNSIGNED NOT NULL , `type` TINYINT UNSIGNED NOT NULL , `worktime` FLOAT( 3, 1 ) NOT NULL , `work` VARCHAR( 255 ) NOT NULL , PRIMARY KEY ( `id` ) , INDEX ( `date` , `project` , `worker` , `type` ) ) TYPE = MYISAM COMMENT = \'�۾����� ���̺�\'; '; 
?>
