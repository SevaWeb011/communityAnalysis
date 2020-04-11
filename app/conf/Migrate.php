<?php
class Migrate
{
    private $db;
    public function __construct()
    {
        $this->db = new Db();
    }

    public function createTables()
    {
        $commands = [
            'CREATE TABLE IF NOT EXISTS users_app (
                id  INTEGER(15) PRIMARY KEY NOT NULL,
                report_id INTEGER(11) NOT NULL
              )',

            'CREATE TABLE IF NOT EXISTS reports (
                id  INTEGER(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                group_id INTEGER(15) NOT NULL,
                date_analysis TIMESTAMP NOT NULL,
                count_wall INTEGER(5) NOT NULL
            )',

            'CREATE TABLE IF NOT EXISTS group_list (
                    id  INTEGER(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                    group_id INTEGER(15) NOT NULL,
                    name TEXT(500) NOT NULL,
                    count_active_user INTEGER(10) NOT NULL,
                    count_subscriber INTEGER(10) NOT NULL,
                    photo TEXT(1000) NOT NULL,
                    report_id INTEGER(11) NOT NULL

                )',

            'CREATE TABLE IF NOT EXISTS best_users (
                id  INTEGER(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                user_id INTEGER(15) NOT NULL,
                name TEXT(500) NOT NULL,
                count_like INTEGER(10) NOT NULL,
                count_comment INTEGER(10) NOT NULL,
                count_repost INTEGER(10) NOT NULL,
                active_score INTEGER(10) NOT NULL,
                report_id INTEGER(11) NOT NULL
            )'
        ];

        $this->db->someQuery($commands);
                 
    }

    public function removeTables()
    {
        $commands = [
            "DROP TABLE users_app",
            "DROP TABLE reports",
            "DROP TABLE group_list",
            "DROP TABLE best_users"
        ];
        $this->db->someQuery($commands);
    }
}
?>