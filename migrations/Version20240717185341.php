<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240717185341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_d044d5d4d17f50a6');
        $this->addSql('DROP INDEX uniq_d044d5d4c74f2195');
        $this->addSql('ALTER TABLE session DROP CONSTRAINT session_pkey');
        $this->addSql('ALTER TABLE session DROP id');
        $this->addSql('ALTER TABLE session ALTER refresh_token TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE session ALTER valid TYPE TIMESTAMP(0) WITH TIME ZONE');
        $this->addSql('ALTER TABLE session ADD PRIMARY KEY (uuid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX session_pkey');
        $this->addSql('ALTER TABLE "session" ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE "session" ALTER refresh_token TYPE VARCHAR(128)');
        $this->addSql('ALTER TABLE "session" ALTER valid TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('CREATE UNIQUE INDEX uniq_d044d5d4d17f50a6 ON "session" (uuid)');
        $this->addSql('CREATE UNIQUE INDEX uniq_d044d5d4c74f2195 ON "session" (refresh_token)');
        $this->addSql('ALTER TABLE "session" ADD PRIMARY KEY (id, uuid)');
    }
}
