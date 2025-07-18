<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250320112815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration to add Country, City and edit Travel entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE city (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, name VARCHAR(255) NOT NULL, country_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2D5B0234F92F3E70 ON city (country_id)');
        $this->addSql('CREATE TABLE country (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5373C9665E237E06 ON country (name)');
        $this->addSql('CREATE TABLE travel (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, trip_date DATE NOT NULL, id_user_id INT NOT NULL, from_city_id INT DEFAULT NULL, to_city_id INT DEFAULT NULL, from_country_id INT DEFAULT NULL, to_country_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2D0B6BCE79F37AE5 ON travel (id_user_id)');
        $this->addSql('CREATE INDEX IDX_2D0B6BCEDF28100 ON travel (from_city_id)');
        $this->addSql('CREATE INDEX IDX_2D0B6BCE5345F5A ON travel (to_city_id)');
        $this->addSql('CREATE INDEX IDX_2D0B6BCED28BF877 ON travel (from_country_id)');
        $this->addSql('CREATE INDEX IDX_2D0B6BCEDE1CDC0D ON travel (to_country_id)');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCE79F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCEDF28100 FOREIGN KEY (from_city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCE5345F5A FOREIGN KEY (to_city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCED28BF877 FOREIGN KEY (from_country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCEDE1CDC0D FOREIGN KEY (to_country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE city DROP CONSTRAINT FK_2D5B0234F92F3E70');
        $this->addSql('ALTER TABLE travel DROP CONSTRAINT FK_2D0B6BCE79F37AE5');
        $this->addSql('ALTER TABLE travel DROP CONSTRAINT FK_2D0B6BCEDF28100');
        $this->addSql('ALTER TABLE travel DROP CONSTRAINT FK_2D0B6BCE5345F5A');
        $this->addSql('ALTER TABLE travel DROP CONSTRAINT FK_2D0B6BCED28BF877');
        $this->addSql('ALTER TABLE travel DROP CONSTRAINT FK_2D0B6BCEDE1CDC0D');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE travel');
    }
}
