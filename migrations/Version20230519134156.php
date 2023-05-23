<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519134156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE expenditure_user (expenditure_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_EFFCA17868DC13E9 (expenditure_id), INDEX IDX_EFFCA178A76ED395 (user_id), PRIMARY KEY(expenditure_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE expenditure_user ADD CONSTRAINT FK_EFFCA17868DC13E9 FOREIGN KEY (expenditure_id) REFERENCES expenditure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE expenditure_user ADD CONSTRAINT FK_EFFCA178A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expenditure_user DROP FOREIGN KEY FK_EFFCA17868DC13E9');
        $this->addSql('ALTER TABLE expenditure_user DROP FOREIGN KEY FK_EFFCA178A76ED395');
        $this->addSql('DROP TABLE expenditure_user');
    }
}
