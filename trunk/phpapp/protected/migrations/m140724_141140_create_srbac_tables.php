<?php

class m140724_141140_create_srbac_tables extends CDbMigration
{
    public function up()
    {
        $this->execute(<<<SQL
# CREATE TABLE `AuthItem`
# (
#  `name` VARCHAR(64) NOT NULL,
#  `type` INTEGER NOT NULL,
#  `description` TEXT,
#  `bizrule` TEXT,
#  `data` TEXT, PRIMARY KEY (`name`)
# );
# CREATE TABLE `AuthItemChild`
# (
#  `parent` VARCHAR(64) NOT NULL,
#  `child` VARCHAR(64) NOT NULL, PRIMARY KEY (`parent`,`child`), FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON
# DELETE CASCADE ON
# UPDATE CASCADE, FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON
# DELETE CASCADE ON
# UPDATE CASCADE
# );
# CREATE TABLE `AuthAssignment`
# (
#  `itemname` VARCHAR(64) NOT NULL,
#  `userid` VARCHAR(64) NOT NULL,
#  `bizrule` TEXT,
#  `data` TEXT, PRIMARY KEY (`itemname`,`userid`), FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON
# DELETE CASCADE ON
# UPDATE CASCADE
# );
SQL
        );
    }

    public function down()
    {
        echo "m140724_141140_create_srbac_tables does not support migration down.\n";
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