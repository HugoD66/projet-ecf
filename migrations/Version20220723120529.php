<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220723120529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipe (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, cooking_time INT NOT NULL, cooking_rest INT NOT NULL, heat_time INT NOT NULL, ingrédients VARCHAR(255) NOT NULL, steps VARCHAR(255) NOT NULL, allergene_list LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', regime_list LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) DEFAULT NULL, ADD allergene VARCHAR(255) DEFAULT NULL, ADD regime VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE recipe');
        $this->addSql('ALTER TABLE user DROP username, DROP allergene, DROP regime');
    }
}
