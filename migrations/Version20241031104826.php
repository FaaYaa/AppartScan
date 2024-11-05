<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241031104826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE electricite (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, num_compteur INT NOT NULL, releve_hp INT NOT NULL, releve_hc INT NOT NULL, UNIQUE INDEX UNIQ_1BBEC07264D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gaz (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, num_compteur INT NOT NULL, releve INT NOT NULL, UNIQUE INDEX UNIQ_7EEFC67364D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE electricite ADD CONSTRAINT FK_1BBEC07264D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE gaz ADD CONSTRAINT FK_7EEFC67364D218E FOREIGN KEY (location_id) REFERENCES location (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE electricite DROP FOREIGN KEY FK_1BBEC07264D218E');
        $this->addSql('ALTER TABLE gaz DROP FOREIGN KEY FK_7EEFC67364D218E');
        $this->addSql('DROP TABLE electricite');
        $this->addSql('DROP TABLE gaz');
    }
}
