<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250416135800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Change from_city and to_city -> departure_city and destination_city';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
                ALTER TABLE travel DROP CONSTRAINT fk_2d0b6bcedf28100
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel DROP CONSTRAINT fk_2d0b6bce5345f5a
            SQL);
        $this->addSql(<<<'SQL'
                DROP INDEX idx_2d0b6bce5345f5a
            SQL);
        $this->addSql(<<<'SQL'
                DROP INDEX idx_2d0b6bcedf28100
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel ADD departure_city_id INT DEFAULT NULL
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel ADD destination_city_id INT DEFAULT NULL
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel DROP from_city_id
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel DROP to_city_id
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCE918B251E FOREIGN KEY (departure_city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCEE5955DD7 FOREIGN KEY (destination_city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            SQL);
        $this->addSql(<<<'SQL'
                CREATE INDEX IDX_2D0B6BCE918B251E ON travel (departure_city_id)
            SQL);
        $this->addSql(<<<'SQL'
                CREATE INDEX IDX_2D0B6BCEE5955DD7 ON travel (destination_city_id)
            SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
                ALTER TABLE travel DROP CONSTRAINT FK_2D0B6BCE918B251E
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel DROP CONSTRAINT FK_2D0B6BCEE5955DD7
            SQL);
        $this->addSql(<<<'SQL'
                DROP INDEX IDX_2D0B6BCE918B251E
            SQL);
        $this->addSql(<<<'SQL'
                DROP INDEX IDX_2D0B6BCEE5955DD7
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel ADD from_city_id INT DEFAULT NULL
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel ADD to_city_id INT DEFAULT NULL
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel DROP departure_city_id
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel DROP destination_city_id
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel ADD CONSTRAINT fk_2d0b6bcedf28100 FOREIGN KEY (from_city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel ADD CONSTRAINT fk_2d0b6bce5345f5a FOREIGN KEY (to_city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            SQL);
        $this->addSql(<<<'SQL'
                CREATE INDEX idx_2d0b6bce5345f5a ON travel (to_city_id)
            SQL);
        $this->addSql(<<<'SQL'
                CREATE INDEX idx_2d0b6bcedf28100 ON travel (from_city_id)
            SQL);
    }
}
