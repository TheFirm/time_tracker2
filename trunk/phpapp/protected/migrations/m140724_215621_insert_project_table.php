<?php

class m140724_215621_insert_project_table extends CDbMigration
{
	public function up()
	{
        $this->execute(<<<SQL
INSERT INTO `projects` (`id`, `name`, `active`, `lft`, `rgt`, `level`, `root`) VALUES
	(1, 'Aviamaster', 0, 0, 0, 1, 1),
	(2, 'Amand', 1, 0, 0, 1, 2),
	(3, 'Scott Reid', 0, 0, 0, 1, 3),
	(4, 'WorkNet', 1, 0, 0, 1, 4),
	(5, 'Payroll', 1, 0, 0, 1, 5),
	(6, 'ERP System', 1, 0, 0, 1, 6),
	(7, 'MusicBox.kg', 0, 0, 0, 1, 7),
	(8, 'Auction', 0, 0, 0, 1, 8),
	(9, 'M&M', 1, 0, 0, 1, 9),
	(11, 'Cobocards', 1, 0, 0, 1, 11),
	(12, 'Поточка', 1, 0, 0, 1, 12),
	(13, 'Engagement', 1, 0, 0, 1, 13),
	(14, 'Діаніт', 0, 0, 0, 1, 14),
	(15, 'AddGoals', 1, 0, 0, 1, 15),
	(17, 'Endorphin', 1, 0, 0, 1, 17),
	(18, 'Chat Assistant', 1, 0, 0, 1, 18),
	(19, 'D3.js - Investigation', 0, 0, 0, 1, 19),
	(22, 'Nosorog', 1, 0, 0, 1, 22),
	(24, 'zapp.kz', 0, 0, 0, 1, 24),
	(25, 'Anonine', 1, 0, 0, 1, 25),
	(27, 'Boxpn', 1, 0, 0, 1, 27),
	(28, 'VPN Tunnel', 1, 0, 0, 1, 28),
	(29, 'Ira Photography', 1, 0, 0, 1, 29),
	(31, '1k', 1, 0, 0, 1, 31);
SQL
);
	}

	public function down()
	{
		echo "m140724_215621_insert_project_table does not support migration down.\n";
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