<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240717182059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session DROP CONSTRAINT session_pkey');
        $this->addSql('ALTER TABLE session ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE session ADD refresh_token VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE session ADD username VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE session ADD valid TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE session DROP expired_at');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D044D5D4C74F2195 ON session (refresh_token)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D044D5D4D17F50A6 ON session (uuid)');
        $this->addSql('ALTER TABLE session ADD PRIMARY KEY (id, uuid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_D044D5D4C74F2195');
        $this->addSql('DROP INDEX UNIQ_D044D5D4D17F50A6');
        $this->addSql('DROP INDEX session_pkey');
        $this->addSql('ALTER TABLE "session" ADD expired_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE "session" DROP id');
        $this->addSql('ALTER TABLE "session" DROP refresh_token');
        $this->addSql('ALTER TABLE "session" DROP username');
        $this->addSql('ALTER TABLE "session" DROP valid');
        $this->addSql('ALTER TABLE "session" ADD PRIMARY KEY (uuid)');
    }
}
