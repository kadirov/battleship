<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190310152959 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE desk (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, type SMALLINT NOT NULL, INDEX IDX_56E2466E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shoot (id INT AUTO_INCREMENT NOT NULL, desk_id INT NOT NULL, coordinate_x SMALLINT NOT NULL, coordinate_y SMALLINT NOT NULL, INDEX IDX_7044FCBE71F9DF5E (desk_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ship (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ship_area (ship_id INT NOT NULL, area_id INT NOT NULL, INDEX IDX_75B6EE29C256317D (ship_id), INDEX IDX_75B6EE29BD0F409C (area_id), PRIMARY KEY(ship_id, area_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, token VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE area (id INT AUTO_INCREMENT NOT NULL, type SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE desk ADD CONSTRAINT FK_56E2466E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE shoot ADD CONSTRAINT FK_7044FCBE71F9DF5E FOREIGN KEY (desk_id) REFERENCES desk (id)');
        $this->addSql('ALTER TABLE ship_area ADD CONSTRAINT FK_75B6EE29C256317D FOREIGN KEY (ship_id) REFERENCES ship (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ship_area ADD CONSTRAINT FK_75B6EE29BD0F409C FOREIGN KEY (area_id) REFERENCES area (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shoot DROP FOREIGN KEY FK_7044FCBE71F9DF5E');
        $this->addSql('ALTER TABLE ship_area DROP FOREIGN KEY FK_75B6EE29C256317D');
        $this->addSql('ALTER TABLE desk DROP FOREIGN KEY FK_56E2466E48FD905');
        $this->addSql('ALTER TABLE ship_area DROP FOREIGN KEY FK_75B6EE29BD0F409C');
        $this->addSql('DROP TABLE desk');
        $this->addSql('DROP TABLE shoot');
        $this->addSql('DROP TABLE ship');
        $this->addSql('DROP TABLE ship_area');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE area');
    }
}
