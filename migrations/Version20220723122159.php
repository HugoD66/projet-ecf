<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220723122159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipe_regime (recipe_id INT NOT NULL, regime_id INT NOT NULL, INDEX IDX_2798545D59D8A214 (recipe_id), INDEX IDX_2798545D35E7D534 (regime_id), PRIMARY KEY(recipe_id, regime_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE regime (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe_regime ADD CONSTRAINT FK_2798545D59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_regime ADD CONSTRAINT FK_2798545D35E7D534 FOREIGN KEY (regime_id) REFERENCES regime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergene ADD user_allergene_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE allergene ADD CONSTRAINT FK_93232AE584A816B0 FOREIGN KEY (user_allergene_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_93232AE584A816B0 ON allergene (user_allergene_id)');
        $this->addSql('ALTER TABLE user ADD regime_id INT DEFAULT NULL, DROP allergene');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64935E7D534 FOREIGN KEY (regime_id) REFERENCES regime (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64935E7D534 ON user (regime_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe_regime DROP FOREIGN KEY FK_2798545D35E7D534');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64935E7D534');
        $this->addSql('DROP TABLE recipe_regime');
        $this->addSql('DROP TABLE regime');
        $this->addSql('ALTER TABLE allergene DROP FOREIGN KEY FK_93232AE584A816B0');
        $this->addSql('DROP INDEX IDX_93232AE584A816B0 ON allergene');
        $this->addSql('ALTER TABLE allergene DROP user_allergene_id');
        $this->addSql('DROP INDEX UNIQ_8D93D64935E7D534 ON user');
        $this->addSql('ALTER TABLE user ADD allergene VARCHAR(255) DEFAULT NULL, DROP regime_id');
    }
}
