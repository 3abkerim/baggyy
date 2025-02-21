<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250220142115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add roles';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE "user" ADD roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE "user" DROP roles');
    }
}
