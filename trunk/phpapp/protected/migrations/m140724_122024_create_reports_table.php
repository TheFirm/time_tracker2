<?php

class m140724_122024_create_reports_table extends CDbMigration
{
	public function up()
	{
        $this->execute(<<<SQL
CREATE TABLE `reports` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` INT(10) UNSIGNED NULL DEFAULT NULL,
	`project_id` INT(10) UNSIGNED NULL DEFAULT NULL,
	`created_at` DATETIME NULL DEFAULT NULL,
	`updated_at` DATETIME NULL DEFAULT NULL,
	`updated_by_id` INT(10) UNSIGNED NULL DEFAULT NULL,
	`reported_at` DATE NULL DEFAULT NULL,
	`time_started_at` TIME NULL DEFAULT NULL,
	`time_ended_at` TIME NULL DEFAULT NULL,
	`comment` TEXT NULL,
	PRIMARY KEY (`id`),
	INDEX `FK_reports_users` (`user_id`),
	INDEX `FK_reports_projects` (`project_id`),
	CONSTRAINT `FK_reports_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
	CONSTRAINT `FK_reports_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;
SQL
        );
	}

	public function down()
	{
		echo "m140724_122024_create_reports_table does not support migration down.\n";
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