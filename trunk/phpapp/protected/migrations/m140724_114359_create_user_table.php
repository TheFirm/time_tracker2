<?php

class m140724_114359_create_user_table extends CDbMigration
{
	public function up()
	{
        $this->execute(<<<SQL
CREATE TABLE `users` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`first_name` VARCHAR(50) NOT NULL,
	`last_name` VARCHAR(50) NOT NULL,
	`mail` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`type` TINYINT(3) NOT NULL DEFAULT '0',
	`auth_key` VARCHAR(255) NULL DEFAULT NULL,
	`registered_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`last_visited_at` TIMESTAMP,
	`isReportTimeLimited` INT(1) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;
SQL
);
	}

	public function down()
	{
		echo "m140724_114359_create_user_table does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}