<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250320095053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new typeSection in Documentation';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documentation ADD type_section_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE documentation ADD CONSTRAINT FK_73D5A93BC520355F FOREIGN KEY (type_section_id) REFERENCES type_section (id)');
        $this->addSql('CREATE INDEX IDX_73D5A93BC520355F ON documentation (type_section_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documentation DROP FOREIGN KEY FK_73D5A93BC520355F');
        $this->addSql('DROP INDEX IDX_73D5A93BC520355F ON documentation');
        $this->addSql('ALTER TABLE documentation DROP type_section_id');
    }
}
