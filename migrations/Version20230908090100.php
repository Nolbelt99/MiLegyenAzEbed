<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230908090100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE unit (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit_conversion (id INT AUTO_INCREMENT NOT NULL, from_unit_id INT DEFAULT NULL, to_unit_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', conversion_factor DOUBLE PRECISION NOT NULL, INDEX IDX_BE39B1847EE393A2 (from_unit_id), INDEX IDX_BE39B18476254DF8 (to_unit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE unit_conversion ADD CONSTRAINT FK_BE39B1847EE393A2 FOREIGN KEY (from_unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE unit_conversion ADD CONSTRAINT FK_BE39B18476254DF8 FOREIGN KEY (to_unit_id) REFERENCES unit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE unit_conversion DROP FOREIGN KEY FK_BE39B1847EE393A2');
        $this->addSql('ALTER TABLE unit_conversion DROP FOREIGN KEY FK_BE39B18476254DF8');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE unit_conversion');
    }
}
