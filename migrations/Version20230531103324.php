<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230531103324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7A5740AB6');
        $this->addSql('DROP INDEX IDX_3BAE0AA7A5740AB6 ON event');
        $this->addSql('ALTER TABLE event ADD uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', DROP expenditure_list_id');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA7D17F50A6 ON event (uuid)');
        $this->addSql('ALTER TABLE expenditure ADD event_id INT NOT NULL, ADD uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE expenditure ADD CONSTRAINT FK_8D4A5FEB71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D4A5FEBD17F50A6 ON expenditure (uuid)');
        $this->addSql('CREATE INDEX IDX_8D4A5FEB71F7E88B ON expenditure (event_id)');
        $this->addSql('ALTER TABLE report ADD uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F7784D17F50A6 ON report (uuid)');
        $this->addSql('ALTER TABLE transaction ADD uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_723705D1D17F50A6 ON transaction (uuid)');
        $this->addSql('ALTER TABLE user CHANGE uuid uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D17F50A6 ON user (uuid)');
        $this->addSql('ALTER TABLE user_event CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_event ADD CONSTRAINT FK_D96CF1FFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_event ADD CONSTRAINT FK_D96CF1FF71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_C42F7784D17F50A6 ON report');
        $this->addSql('ALTER TABLE report DROP uuid');
        $this->addSql('ALTER TABLE user_event DROP FOREIGN KEY FK_D96CF1FFA76ED395');
        $this->addSql('ALTER TABLE user_event DROP FOREIGN KEY FK_D96CF1FF71F7E88B');
        $this->addSql('ALTER TABLE user_event CHANGE user_id user_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('DROP INDEX UNIQ_8D93D649D17F50A6 ON user');
        $this->addSql('ALTER TABLE user CHANGE uuid uuid VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_723705D1D17F50A6 ON transaction');
        $this->addSql('ALTER TABLE transaction DROP uuid');
        $this->addSql('ALTER TABLE expenditure DROP FOREIGN KEY FK_8D4A5FEB71F7E88B');
        $this->addSql('DROP INDEX UNIQ_8D4A5FEBD17F50A6 ON expenditure');
        $this->addSql('DROP INDEX IDX_8D4A5FEB71F7E88B ON expenditure');
        $this->addSql('ALTER TABLE expenditure DROP event_id, DROP uuid');
        $this->addSql('DROP INDEX UNIQ_3BAE0AA7D17F50A6 ON event');
        $this->addSql('ALTER TABLE event ADD expenditure_list_id INT DEFAULT NULL, DROP uuid');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7A5740AB6 FOREIGN KEY (expenditure_list_id) REFERENCES expenditure (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7A5740AB6 ON event (expenditure_list_id)');
    }
}
