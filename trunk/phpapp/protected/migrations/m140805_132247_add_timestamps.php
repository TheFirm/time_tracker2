<?php

class m140805_132247_add_timestamps extends CDbMigration
{
	public function up()
	{
        $this->addColumn('projects', 'created_at', 'TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->addColumn('projects', 'updated_at', 'TIMESTAMP');

        $this->addColumn('user_project', 'created_at', 'TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->addColumn('user_project', 'updated_at', 'TIMESTAMP');
	}

	public function down()
	{
		echo "m140805_132247_add_timestamps_project_table does not support migration down.\n";
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