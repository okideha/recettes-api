<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230822121012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipe_has_source (id INT AUTO_INCREMENT NOT NULL, recipe_id INT NOT NULL, source_id INT NOT NULL, url LONGTEXT NOT NULL, INDEX IDX_3AD6EE8B59D8A214 (recipe_id), INDEX IDX_3AD6EE8B953C1C61 (source_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe_has_source ADD CONSTRAINT FK_3AD6EE8B59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE recipe_has_source ADD CONSTRAINT FK_3AD6EE8B953C1C61 FOREIGN KEY (source_id) REFERENCES source (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe_has_source DROP FOREIGN KEY FK_3AD6EE8B59D8A214');
        $this->addSql('ALTER TABLE recipe_has_source DROP FOREIGN KEY FK_3AD6EE8B953C1C61');
        $this->addSql('DROP TABLE recipe_has_source');
    }
}
