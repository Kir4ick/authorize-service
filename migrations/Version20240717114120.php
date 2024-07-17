<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240717114120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "session" (uuid UUID NOT NULL, user_uuid UUID DEFAULT NULL, fingerprint VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, expired_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(uuid))');
        $this->addSql('CREATE INDEX IDX_D044D5D4ABFE1C6F ON "session" (user_uuid)');
        $this->addSql('COMMENT ON COLUMN "session".uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "session".user_uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "user" (uuid UUID NOT NULL, deleted_by UUID DEFAULT NULL, updated_by UUID DEFAULT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, deleted_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(uuid))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6491F6FA0AF ON "user" (deleted_by)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64916FE72E1 ON "user" (updated_by)');
        $this->addSql('COMMENT ON COLUMN "user".uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "user".deleted_by IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "user".updated_by IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE "session" ADD CONSTRAINT FK_D044D5D4ABFE1C6F FOREIGN KEY (user_uuid) REFERENCES "user" (uuid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6491F6FA0AF FOREIGN KEY (deleted_by) REFERENCES "user" (uuid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D64916FE72E1 FOREIGN KEY (updated_by) REFERENCES "user" (uuid) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "session" DROP CONSTRAINT FK_D044D5D4ABFE1C6F');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6491F6FA0AF');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D64916FE72E1');
        $this->addSql('DROP TABLE "session"');
        $this->addSql('DROP TABLE "user"');
    }
}
