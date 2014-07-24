<?php

class m140724_132708_user_add_updated_at extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('users', 'isReportTimeLimited');
        $this->addColumn('users', 'updated_at', 'TIMESTAMP');
	}

	public function down()
	{
		echo "m140724_132708_user_add_updated_at does not support migration down.\n";
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