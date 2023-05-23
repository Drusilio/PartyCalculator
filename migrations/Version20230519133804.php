<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519133804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA74BD2A4C0');
        $this->addSql('DROP INDEX UNIQ_3BAE0AA74BD2A4C0 ON event');
        $this->addSql('ALTER TABLE event DROP report_id');
        $this->addSql('ALTER TABLE expenditure DROP FOREIGN KEY FK_8D4A5FEBCA7598AF');
        $this->addSql('DROP INDEX IDX_8D4A5FEBCA7598AF ON expenditure');
        $this->addSql('ALTER TABLE expenditure DROP expense_user_id');
        $this->addSql('ALTER TABLE report ADD event_id INT NOT NULL');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F778471F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F778471F7E88B ON report (event_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD report_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA74BD2A4C0 FOREIGN KEY (report_id) REFERENCES report (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA74BD2A4C0 ON event (report_id)');
        $this->addSql('ALTER TABLE expenditure ADD expense_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE expenditure ADD CONSTRAINT FK_8D4A5FEBCA7598AF FOREIGN KEY (expense_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D4A5FEBCA7598AF ON expenditure (expense_user_id)');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F778471F7E88B');
        $this->addSql('DROP INDEX UNIQ_C42F778471F7E88B ON report');
        $this->addSql('ALTER TABLE report DROP event_id');
    }
}
