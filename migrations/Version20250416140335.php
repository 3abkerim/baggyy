<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250416140335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Change id_user to user';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE travel DROP CONSTRAINT fk_2d0b6bce79f37ae5
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_2d0b6bce79f37ae5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE travel RENAME COLUMN id_user_id TO user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCEA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2D0B6BCEA76ED395 ON travel (user_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE travel DROP CONSTRAINT FK_2D0B6BCEA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_2D0B6BCEA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE travel RENAME COLUMN user_id TO id_user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE travel ADD CONSTRAINT fk_2d0b6bce79f37ae5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_2d0b6bce79f37ae5 ON travel (id_user_id)
        SQL);
    }
}
