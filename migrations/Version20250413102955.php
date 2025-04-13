<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250413102955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'alter travek and shop_request';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
                ALTER TABLE shop_request ADD departure_country_id INT NOT NULL
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE shop_request ADD destination_city_id INT NOT NULL
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE shop_request ADD CONSTRAINT FK_38A4CFB52781C6E4 FOREIGN KEY (departure_country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE shop_request ADD CONSTRAINT FK_38A4CFB5E5955DD7 FOREIGN KEY (destination_city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            SQL);
        $this->addSql(<<<'SQL'
                CREATE INDEX IDX_38A4CFB52781C6E4 ON shop_request (departure_country_id)
            SQL);
        $this->addSql(<<<'SQL'
                CREATE INDEX IDX_38A4CFB5E5955DD7 ON shop_request (destination_city_id)
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel DROP CONSTRAINT fk_2d0b6bced28bf877
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel DROP CONSTRAINT fk_2d0b6bcede1cdc0d
            SQL);
        $this->addSql(<<<'SQL'
                DROP INDEX idx_2d0b6bcede1cdc0d
            SQL);
        $this->addSql(<<<'SQL'
                DROP INDEX idx_2d0b6bced28bf877
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel DROP from_country_id
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel DROP to_country_id
            SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
                ALTER TABLE shop_request DROP CONSTRAINT FK_38A4CFB52781C6E4
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE shop_request DROP CONSTRAINT FK_38A4CFB5E5955DD7
            SQL);
        $this->addSql(<<<'SQL'
                DROP INDEX IDX_38A4CFB52781C6E4
            SQL);
        $this->addSql(<<<'SQL'
                DROP INDEX IDX_38A4CFB5E5955DD7
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE shop_request DROP departure_country_id
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE shop_request DROP destination_city_id
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel ADD from_country_id INT DEFAULT NULL
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel ADD to_country_id INT DEFAULT NULL
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel ADD CONSTRAINT fk_2d0b6bced28bf877 FOREIGN KEY (from_country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            SQL);
        $this->addSql(<<<'SQL'
                ALTER TABLE travel ADD CONSTRAINT fk_2d0b6bcede1cdc0d FOREIGN KEY (to_country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            SQL);
        $this->addSql(<<<'SQL'
                CREATE INDEX idx_2d0b6bcede1cdc0d ON travel (to_country_id)
            SQL);
        $this->addSql(<<<'SQL'
                CREATE INDEX idx_2d0b6bced28bf877 ON travel (from_country_id)
            SQL);
    }
}
