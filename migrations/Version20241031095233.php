<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241031095233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE eau_chaude_sanitaire (id INT AUTO_INCREMENT NOT NULL, type_eau_chaude VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eau_chaude_sanitaire_location (eau_chaude_sanitaire_id INT NOT NULL, location_id INT NOT NULL, INDEX IDX_61B1C5C7F146B543 (eau_chaude_sanitaire_id), INDEX IDX_61B1C5C764D218E (location_id), PRIMARY KEY(eau_chaude_sanitaire_id, location_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eau_chaude_sanitaire_location ADD CONSTRAINT FK_61B1C5C7F146B543 FOREIGN KEY (eau_chaude_sanitaire_id) REFERENCES eau_chaude_sanitaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eau_chaude_sanitaire_location ADD CONSTRAINT FK_61B1C5C764D218E FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eau_chaude_sanitaire_location DROP FOREIGN KEY FK_61B1C5C7F146B543');
        $this->addSql('ALTER TABLE eau_chaude_sanitaire_location DROP FOREIGN KEY FK_61B1C5C764D218E');
        $this->addSql('DROP TABLE eau_chaude_sanitaire');
        $this->addSql('DROP TABLE eau_chaude_sanitaire_location');
    }
}
