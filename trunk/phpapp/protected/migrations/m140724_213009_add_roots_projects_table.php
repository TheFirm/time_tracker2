<?php

class m140724_213009_add_roots_projects_table extends CDbMigration
{
	public function up()
	{
        $this->addColumn('projects', 'root', 'INT(10) UNSIGNED DEFAULT NULL');
        $this->createIndex('i_root', 'projects', 'root');
	}

	public function down()
	{
		echo "m140724_213009_add_roots_projects_table does not support migration down.\n";
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