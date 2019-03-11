<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190311065323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ship_area');
    }

    public function down(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ship_area (ship_id INT NOT NULL, area_id INT NOT NULL, INDEX IDX_75B6EE29C256317D (ship_id), INDEX IDX_75B6EE29BD0F409C (area_id), PRIMARY KEY(ship_id, area_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ship_area ADD CONSTRAINT FK_75B6EE29C256317D FOREIGN KEY (ship_id) REFERENCES ship (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ship_area ADD CONSTRAINT FK_75B6EE29BD0F409C FOREIGN KEY (area_id) REFERENCES area (id) ON DELETE CASCADE');
    }
}
