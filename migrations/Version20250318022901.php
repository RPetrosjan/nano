<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250318022901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE questions (id INT AUTO_INCREMENT NOT NULL, type_section_id INT DEFAULT NULL, question VARCHAR(255) NOT NULL, n_reponse INT DEFAULT NULL, INDEX IDX_8ADC54D5C520355F (type_section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponses (id INT AUTO_INCREMENT NOT NULL, questions_id INT DEFAULT NULL, reponse VARCHAR(128) NOT NULL, is_correct TINYINT(1) NOT NULL, INDEX IDX_1E512EC6BCB134CE (questions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE results (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, n_result VARCHAR(64) NOT NULL, success TINYINT(1) DEFAULT NULL, INDEX IDX_9FA3E4141E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_section (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(128) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D5C520355F FOREIGN KEY (type_section_id) REFERENCES type_section (id)');
        $this->addSql('ALTER TABLE reponses ADD CONSTRAINT FK_1E512EC6BCB134CE FOREIGN KEY (questions_id) REFERENCES questions (id)');
        $this->addSql('ALTER TABLE results ADD CONSTRAINT FK_9FA3E4141E27F6BF FOREIGN KEY (question_id) REFERENCES questions (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D5C520355F');
        $this->addSql('ALTER TABLE reponses DROP FOREIGN KEY FK_1E512EC6BCB134CE');
        $this->addSql('ALTER TABLE results DROP FOREIGN KEY FK_9FA3E4141E27F6BF');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE reponses');
        $this->addSql('DROP TABLE results');
        $this->addSql('DROP TABLE type_section');
    }
}
