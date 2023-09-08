<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230908124536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instruction (id INT AUTO_INCREMENT NOT NULL, recipe_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', step_number INT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_7BBAE15659D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recepie_ingredient (id INT AUTO_INCREMENT NOT NULL, recipe_id INT DEFAULT NULL, ingredient_id INT DEFAULT NULL, unit_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', quantity INT NOT NULL, INDEX IDX_FD47081659D8A214 (recipe_id), INDEX IDX_FD470816933FE08C (ingredient_id), INDEX IDX_FD470816F8BD700D (unit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_categories (recipe_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_738DC00B59D8A214 (recipe_id), INDEX IDX_738DC00B12469DE2 (category_id), PRIMARY KEY(recipe_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE instruction ADD CONSTRAINT FK_7BBAE15659D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE recepie_ingredient ADD CONSTRAINT FK_FD47081659D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE recepie_ingredient ADD CONSTRAINT FK_FD470816933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE recepie_ingredient ADD CONSTRAINT FK_FD470816F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE recipe_categories ADD CONSTRAINT FK_738DC00B59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_categories ADD CONSTRAINT FK_738DC00B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF787059D8A214');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870F8BD700D');
        $this->addSql('DROP INDEX IDX_6BAF787059D8A214 ON ingredient');
        $this->addSql('DROP INDEX IDX_6BAF7870F8BD700D ON ingredient');
        $this->addSql('ALTER TABLE ingredient DROP unit_id, DROP recipe_id');
        $this->addSql('ALTER TABLE recipe ADD slug VARCHAR(100) NOT NULL, ADD `lead` VARCHAR(255) NOT NULL, ADD prep_time INT DEFAULT NULL, ADD cook_time INT DEFAULT NULL, CHANGE name title VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DA88B137989D9B62 ON recipe (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE instruction DROP FOREIGN KEY FK_7BBAE15659D8A214');
        $this->addSql('ALTER TABLE recepie_ingredient DROP FOREIGN KEY FK_FD47081659D8A214');
        $this->addSql('ALTER TABLE recepie_ingredient DROP FOREIGN KEY FK_FD470816933FE08C');
        $this->addSql('ALTER TABLE recepie_ingredient DROP FOREIGN KEY FK_FD470816F8BD700D');
        $this->addSql('ALTER TABLE recipe_categories DROP FOREIGN KEY FK_738DC00B59D8A214');
        $this->addSql('ALTER TABLE recipe_categories DROP FOREIGN KEY FK_738DC00B12469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE instruction');
        $this->addSql('DROP TABLE recepie_ingredient');
        $this->addSql('DROP TABLE recipe_categories');
        $this->addSql('ALTER TABLE ingredient ADD unit_id INT DEFAULT NULL, ADD recipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF787059D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('CREATE INDEX IDX_6BAF787059D8A214 ON ingredient (recipe_id)');
        $this->addSql('CREATE INDEX IDX_6BAF7870F8BD700D ON ingredient (unit_id)');
        $this->addSql('DROP INDEX UNIQ_DA88B137989D9B62 ON recipe');
        $this->addSql('ALTER TABLE recipe ADD name VARCHAR(255) NOT NULL, DROP title, DROP slug, DROP `lead`, DROP prep_time, DROP cook_time');
    }
}
