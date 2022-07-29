<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220729132630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allergene_recipe DROP FOREIGN KEY FK_FD80E2CA4646AB2');
        $this->addSql('DROP TABLE allergene');
        $this->addSql('DROP TABLE allergene_recipe');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergene (id INT AUTO_INCREMENT NOT NULL, user_allergene_id INT DEFAULT NULL, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_93232AE584A816B0 (user_allergene_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE allergene_recipe (allergene_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_FD80E2CA59D8A214 (recipe_id), INDEX IDX_FD80E2CA4646AB2 (allergene_id), PRIMARY KEY(allergene_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE allergene ADD CONSTRAINT FK_93232AE584A816B0 FOREIGN KEY (user_allergene_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE allergene_recipe ADD CONSTRAINT FK_FD80E2CA4646AB2 FOREIGN KEY (allergene_id) REFERENCES allergene (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergene_recipe ADD CONSTRAINT FK_FD80E2CA59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
    }
}
