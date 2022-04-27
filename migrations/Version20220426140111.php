<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220426140111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE flight (id INT AUTO_INCREMENT NOT NULL, departure_city_id INT NOT NULL, arrival_city_id INT NOT NULL, departure_datetime DATETIME NOT NULL, departure_date_time DATETIME NOT NULL, arrival_date_time DATETIME NOT NULL, price NUMERIC(8, 2) NOT NULL, reduction TINYINT(1) NOT NULL, seat_max INT NOT NULL, INDEX IDX_C257E60E918B251E (departure_city_id), INDEX IDX_C257E60E4067ACA7 (arrival_city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E918B251E FOREIGN KEY (departure_city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E4067ACA7 FOREIGN KEY (arrival_city_id) REFERENCES city (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE flight');
    }
}
