<?php

class m140724_173933_change_user_table extends CDbMigration
{
	public function up()
	{
        $this->execute(<<<SQL
ALTER TABLE `users`
	CHANGE COLUMN `registered_at` `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP AFTER `auth_key`,
	CHANGE COLUMN `last_visited_at` `last_visited_at` TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' AFTER `created_at`,
	CHANGE COLUMN `updated_at` `updated_at` TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' AFTER `last_visited_at`;

	ALTER TABLE `users`
	ALTER `password` DROP DEFAULT;
ALTER TABLE `users`
	CHANGE COLUMN `password` `password` VARCHAR(255) NULL AFTER `mail`;

SQL
);
	}

	public function down()
	{
		echo "m140724_173933_change_user_table does not support migration down.\n";
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