<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230518133511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction ADD debtor_id INT NOT NULL, ADD recipient_id INT NOT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1B043EC6B FOREIGN KEY (debtor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1E92F8F78 FOREIGN KEY (recipient_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_723705D1B043EC6B ON transaction (debtor_id)');
        $this->addSql('CREATE INDEX IDX_723705D1E92F8F78 ON transaction (recipient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1B043EC6B');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1E92F8F78');
        $this->addSql('DROP INDEX IDX_723705D1B043EC6B ON transaction');
        $this->addSql('DROP INDEX IDX_723705D1E92F8F78 ON transaction');
        $this->addSql('ALTER TABLE transaction DROP debtor_id, DROP recipient_id');
    }
}
