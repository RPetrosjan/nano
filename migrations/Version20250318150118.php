<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250318150118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new Entity Documentation';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE documentation (id INT AUTO_INCREMENT NOT NULL, text LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE questions ADD documentation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D5C703EEC9 FOREIGN KEY (documentation_id) REFERENCES documentation (id)');
        $this->addSql('CREATE INDEX IDX_8ADC54D5C703EEC9 ON questions (documentation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D5C703EEC9');
        $this->addSql('DROP TABLE documentation');
        $this->addSql('DROP INDEX IDX_8ADC54D5C703EEC9 ON questions');
        $this->addSql('ALTER TABLE questions DROP documentation_id');
    }
}
