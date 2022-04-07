<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220406155625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Ignore all foreign key constraints, as some data has missing key ids.
        $this->addSql("SET session_replication_role = 'replica';");

        $this->addSql('CREATE TABLE "devices" (id INT NOT NULL, user_id INT NOT NULL, platform VARCHAR(255) DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_11074E9AA76ED395 ON "devices" (user_id)');
        $this->addSql('COMMENT ON COLUMN "devices".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "users" (id INT NOT NULL, email VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, is_premium INT DEFAULT NULL, country_code VARCHAR(2) DEFAULT NULL, last_active_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN "users".last_active_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "users".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE "devices" ADD CONSTRAINT FK_11074E9AA76ED395 FOREIGN KEY (user_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql("INSERT INTO users VALUES (1,'hgreis@go0glelemail.com','active',0,'ES','2022-03-01 12:33:45','2022-03-01 12:33:45'),(2,'matt5000@kaspecism.site','active',0,'ES','2022-03-02 12:33:45','2022-03-01 12:33:45'),(3,'morasergio1@uioct.com','active',0,'GB','2022-03-03 12:33:45','2022-03-01 12:33:45'),(4,'ren1033xxx@cua77-official.gq','active',0,'US','2022-03-03 12:33:45','2022-03-01 12:33:45'),(5,'yogamag@uewodia.com','active',1,'ES','2022-03-03 12:33:45','2022-03-01 12:33:45'),(6,'sttimers69@neeahoniy.com','active',1,'ES','2022-03-03 12:33:45','2022-03-01 12:33:45'),(7,'jannatroshina@nkgursr.com','suspended',1,'LV','2022-03-03 12:33:45','2022-03-01 12:33:45');");
        $this->addSql("INSERT INTO devices VALUES (1,1,'android','test device','2022-03-03 12:33:45'),(2,2,'windows','my first device','2022-03-03 12:33:45'),(3,3,'windows','test app','2022-03-03 12:33:45'),(4,4,'android','moms phone','2022-03-03 12:33:45'),(5,5,'android','italy','2022-03-03 12:33:45'),(6,5,'windows','server','2022-03-03 12:33:45'),(7,6,'ios','new phone','2022-03-03 12:33:45'),(8,6,'android','old phone','2022-03-03 12:33:45'),(9,6,'windows','LAPTOP','2022-03-03 12:33:45'),(10,8,'android',NULL,'2022-03-03 12:33:45'),(11,8,'android',NULL,'2022-03-03 12:33:45'),(12,8,'ios',NULL,'2022-03-03 12:33:45'),(13,8,'ios',NULL,'2022-03-03 12:33:45'),(14,8,'windows',NULL,'2022-03-03 12:33:45');");

        $this->addSql("SET session_replication_role = 'origin';");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "devices" DROP CONSTRAINT FK_11074E9AA76ED395');
        $this->addSql('DROP TABLE "devices"');
        $this->addSql('DROP TABLE "users"');
    }
}
