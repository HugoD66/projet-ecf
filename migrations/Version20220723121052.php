<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220723121052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergene (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE allergene_recipe (allergene_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_FD80E2CA4646AB2 (allergene_id), INDEX IDX_FD80E2CA59D8A214 (recipe_id), PRIMARY KEY(allergene_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE allergene_recipe ADD CONSTRAINT FK_FD80E2CA4646AB2 FOREIGN KEY (allergene_id) REFERENCES allergene (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergene_recipe ADD CONSTRAINT FK_FD80E2CA59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe DROP allergene_list');
        $this->addSql('ALTER TABLE user DROP regime');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allergene_recipe DROP FOREIGN KEY FK_FD80E2CA4646AB2');
        $this->addSql('DROP TABLE allergene');
        $this->addSql('DROP TABLE allergene_recipe');
        $this->addSql('ALTER TABLE recipe ADD allergene_list LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\'');
        $this->addSql('ALTER TABLE user ADD regime VARCHAR(255) DEFAULT NULL');
    }
}
