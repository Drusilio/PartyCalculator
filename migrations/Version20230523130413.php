<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523130413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction ADD default_report_id INT DEFAULT NULL, ADD optimal_report_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1DAB08C67 FOREIGN KEY (default_report_id) REFERENCES report (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D148671ACA FOREIGN KEY (optimal_report_id) REFERENCES report (id)');
        $this->addSql('CREATE INDEX IDX_723705D1DAB08C67 ON transaction (default_report_id)');
        $this->addSql('CREATE INDEX IDX_723705D148671ACA ON transaction (optimal_report_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1DAB08C67');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D148671ACA');
        $this->addSql('DROP INDEX IDX_723705D1DAB08C67 ON transaction');
        $this->addSql('DROP INDEX IDX_723705D148671ACA ON transaction');
        $this->addSql('ALTER TABLE transaction DROP default_report_id, DROP optimal_report_id');
    }
}
