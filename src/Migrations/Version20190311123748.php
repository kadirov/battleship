<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190311123748 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE shoot');
        $this->addSql('ALTER TABLE area ADD desk_id INT NOT NULL, ADD coordinate_x SMALLINT NOT NULL, ADD coordinate_y SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE area ADD CONSTRAINT FK_D7943D6871F9DF5E FOREIGN KEY (desk_id) REFERENCES desk (id)');
        $this->addSql('CREATE INDEX IDX_D7943D6871F9DF5E ON area (desk_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE shoot (id INT AUTO_INCREMENT NOT NULL, desk_id INT NOT NULL, coordinate_x SMALLINT NOT NULL, coordinate_y SMALLINT NOT NULL, INDEX IDX_7044FCBE71F9DF5E (desk_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE shoot ADD CONSTRAINT FK_7044FCBE71F9DF5E FOREIGN KEY (desk_id) REFERENCES desk (id)');
        $this->addSql('ALTER TABLE area DROP FOREIGN KEY FK_D7943D6871F9DF5E');
        $this->addSql('DROP INDEX IDX_D7943D6871F9DF5E ON area');
        $this->addSql('ALTER TABLE area DROP desk_id, DROP coordinate_x, DROP coordinate_y');
    }
}
