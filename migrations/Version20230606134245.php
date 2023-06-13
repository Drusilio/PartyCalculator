<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230606134245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expenditure ADD expensist_id INT NOT NULL');
        $this->addSql('ALTER TABLE expenditure ADD CONSTRAINT FK_8D4A5FEB9B4DB8E9 FOREIGN KEY (expensist_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D4A5FEB9B4DB8E9 ON expenditure (expensist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expenditure DROP FOREIGN KEY FK_8D4A5FEB9B4DB8E9');
        $this->addSql('DROP INDEX IDX_8D4A5FEB9B4DB8E9 ON expenditure');
        $this->addSql('ALTER TABLE expenditure DROP expensist_id');
    }
}
