<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240717201201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session ADD user_agent TEXT NOT NULL');
        $this->addSql('ALTER TABLE session ADD is_active BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE session ADD is_blocked BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE session ADD ip TEXT NOT NULL');
        $this->addSql('ALTER TABLE session DROP refresh_token');
        $this->addSql('ALTER TABLE session DROP username');
        $this->addSql('ALTER TABLE session DROP valid');
        $this->addSql('ALTER TABLE session ALTER fingerprint TYPE TEXT');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON "user" (login)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_8D93D649AA08CB10');
        $this->addSql('ALTER TABLE "session" ADD refresh_token VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "session" ADD username VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "session" ADD valid TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE "session" DROP user_agent');
        $this->addSql('ALTER TABLE "session" DROP is_active');
        $this->addSql('ALTER TABLE "session" DROP is_blocked');
        $this->addSql('ALTER TABLE "session" DROP ip');
        $this->addSql('ALTER TABLE "session" ALTER fingerprint TYPE VARCHAR(255)');
    }
}
