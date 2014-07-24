<?php

class m140724_121831_create_project_table extends CDbMigration
{
	public function up()
	{
        $this->execute(<<<SQL
CREATE TABLE `projects` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NULL DEFAULT NULL,
	`active` TINYINT(4) NULL DEFAULT NULL,
	`lft` INT(10) UNSIGNED NOT NULL,
	`rgt` INT(10) UNSIGNED NOT NULL,
	`level` SMALLINT(5) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;
SQL
);
	}

	public function down()
	{
		echo "m140724_121831_create_project_table does not support migration down.\n";
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