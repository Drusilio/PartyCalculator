<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230518131050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, users_debts VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD report_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA74BD2A4C0 FOREIGN KEY (report_id) REFERENCES report (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA74BD2A4C0 ON event (report_id)');
        $this->addSql('ALTER TABLE expenditure ADD expense_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE expenditure ADD CONSTRAINT FK_8D4A5FEBCA7598AF FOREIGN KEY (expense_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D4A5FEBCA7598AF ON expenditure (expense_user_id)');
        $this->addSql('ALTER TABLE transaction DROP debtor_name, DROP recipient_name');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expenditure DROP FOREIGN KEY FK_8D4A5FEBCA7598AF');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA74BD2A4C0');
        $this->addSql('DROP INDEX UNIQ_3BAE0AA74BD2A4C0 ON event');
        $this->addSql('ALTER TABLE event DROP report_id');
        $this->addSql('DROP INDEX IDX_8D4A5FEBCA7598AF ON expenditure');
        $this->addSql('ALTER TABLE expenditure DROP expense_user_id');
        $this->addSql('ALTER TABLE transaction ADD debtor_name VARCHAR(255) NOT NULL, ADD recipient_name VARCHAR(255) NOT NULL');
    }
}
