<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251113000741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absence ADD aluno_id INT NOT NULL, DROP aluno');
        $this->addSql('ALTER TABLE absence ADD CONSTRAINT FK_765AE0C9B2DDF7F4 FOREIGN KEY (aluno_id) REFERENCES `aluno` (id)');
        $this->addSql('CREATE INDEX IDX_765AE0C9B2DDF7F4 ON absence (aluno_id)');
        $this->addSql('ALTER TABLE presence ADD disciplina_id INT NOT NULL, ADD aluno_id INT NOT NULL, DROP disciplina, DROP aluno');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A52A30B056 FOREIGN KEY (disciplina_id) REFERENCES disciplina (id)');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A5B2DDF7F4 FOREIGN KEY (aluno_id) REFERENCES `aluno` (id)');
        $this->addSql('CREATE INDEX IDX_6977C7A52A30B056 ON presence (disciplina_id)');
        $this->addSql('CREATE INDEX IDX_6977C7A5B2DDF7F4 ON presence (aluno_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absence DROP FOREIGN KEY FK_765AE0C9B2DDF7F4');
        $this->addSql('DROP INDEX IDX_765AE0C9B2DDF7F4 ON absence');
        $this->addSql('ALTER TABLE absence ADD aluno VARCHAR(255) NOT NULL, DROP aluno_id');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A52A30B056');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A5B2DDF7F4');
        $this->addSql('DROP INDEX IDX_6977C7A52A30B056 ON presence');
        $this->addSql('DROP INDEX IDX_6977C7A5B2DDF7F4 ON presence');
        $this->addSql('ALTER TABLE presence ADD disciplina VARCHAR(255) NOT NULL, ADD aluno VARCHAR(255) NOT NULL, DROP disciplina_id, DROP aluno_id');
    }
}
