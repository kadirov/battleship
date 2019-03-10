<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190310155036 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ship ADD desk_id INT NOT NULL, ADD status SMALLINT NOT NULL, ADD type SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE ship ADD CONSTRAINT FK_FA30EB2471F9DF5E FOREIGN KEY (desk_id) REFERENCES desk (id)');
        $this->addSql('CREATE INDEX IDX_FA30EB2471F9DF5E ON ship (desk_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ship DROP FOREIGN KEY FK_FA30EB2471F9DF5E');
        $this->addSql('DROP INDEX IDX_FA30EB2471F9DF5E ON ship');
        $this->addSql('ALTER TABLE ship DROP desk_id, DROP status, DROP type');
    }
}
