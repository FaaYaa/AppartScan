<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241031093135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chauffage (id INT AUTO_INCREMENT NOT NULL, type_chauffage VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location_chauffage (location_id INT NOT NULL, chauffage_id INT NOT NULL, INDEX IDX_EE5CFC0664D218E (location_id), INDEX IDX_EE5CFC06C9BF5A6C (chauffage_id), PRIMARY KEY(location_id, chauffage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location_chauffage ADD CONSTRAINT FK_EE5CFC0664D218E FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE location_chauffage ADD CONSTRAINT FK_EE5CFC06C9BF5A6C FOREIGN KEY (chauffage_id) REFERENCES chauffage (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location_chauffage DROP FOREIGN KEY FK_EE5CFC0664D218E');
        $this->addSql('ALTER TABLE location_chauffage DROP FOREIGN KEY FK_EE5CFC06C9BF5A6C');
        $this->addSql('DROP TABLE chauffage');
        $this->addSql('DROP TABLE location_chauffage');
    }
}
