<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211227212929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE application_programming_lang (application_id INT NOT NULL, programming_lang_id INT NOT NULL, INDEX IDX_1C9756693E030ACD (application_id), INDEX IDX_1C975669997125BC (programming_lang_id), PRIMARY KEY(application_id, programming_lang_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programming_lang (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE application_programming_lang ADD CONSTRAINT FK_1C9756693E030ACD FOREIGN KEY (application_id) REFERENCES application (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE application_programming_lang ADD CONSTRAINT FK_1C975669997125BC FOREIGN KEY (programming_lang_id) REFERENCES programming_lang (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application_programming_lang DROP FOREIGN KEY FK_1C975669997125BC');
        $this->addSql('DROP TABLE application_programming_lang');
        $this->addSql('DROP TABLE programming_lang');
    }
}
