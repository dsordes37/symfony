<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251113000253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absence ADD disciplina_id INT NOT NULL, DROP disciplina');
        $this->addSql('ALTER TABLE absence ADD CONSTRAINT FK_765AE0C92A30B056 FOREIGN KEY (disciplina_id) REFERENCES `disciplina` (id)');
        $this->addSql('CREATE INDEX IDX_765AE0C92A30B056 ON absence (disciplina_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absence DROP FOREIGN KEY FK_765AE0C92A30B056');
        $this->addSql('DROP INDEX IDX_765AE0C92A30B056 ON absence');
        $this->addSql('ALTER TABLE absence ADD disciplina VARCHAR(255) NOT NULL, DROP disciplina_id');
    }
}
