<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190214211134 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE airport_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE air_trafic_controller_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE city_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE company_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE country_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE flight_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE flights_controllers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pilot_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE plane_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE terminal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE track_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE airport (id INT NOT NULL, city_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7E91F7C28BAC62AF ON airport (city_id)');
        $this->addSql('CREATE TABLE air_trafic_controller (id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthdate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE city (id INT NOT NULL, country_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2D5B0234F92F3E70 ON city (country_id)');
        $this->addSql('CREATE TABLE company (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE country (id INT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(5) NOT NULL, lang VARCHAR(45) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE flight (id INT NOT NULL, plane_id INT NOT NULL, pilot_id INT NOT NULL, departureTrack_id INT DEFAULT NULL, arrivalTrack_id INT DEFAULT NULL, departureTerminal_id INT DEFAULT NULL, arrivalTerminal_id INT DEFAULT NULL, departureAirport_id INT NOT NULL, arrivalAirport_id INT NOT NULL, number VARCHAR(255) NOT NULL, departureDate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, arrivalDate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, status VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C257E60EF53666A8 ON flight (plane_id)');
        $this->addSql('CREATE INDEX IDX_C257E60ECE55439B ON flight (pilot_id)');
        $this->addSql('CREATE INDEX IDX_C257E60EE2AE981E ON flight (departureTrack_id)');
        $this->addSql('CREATE INDEX IDX_C257E60E50C27FBF ON flight (arrivalTrack_id)');
        $this->addSql('CREATE INDEX IDX_C257E60E10C7954D ON flight (departureTerminal_id)');
        $this->addSql('CREATE INDEX IDX_C257E60E9D46EAF0 ON flight (arrivalTerminal_id)');
        $this->addSql('CREATE INDEX IDX_C257E60EF631AB5C ON flight (departureAirport_id)');
        $this->addSql('CREATE INDEX IDX_C257E60E7F43E343 ON flight (arrivalAirport_id)');
        $this->addSql('CREATE TABLE flights_controllers (id INT NOT NULL, controller_id INT NOT NULL, flight_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_563BD9EDF6D1A74B ON flights_controllers (controller_id)');
        $this->addSql('CREATE INDEX IDX_563BD9ED91F478C5 ON flights_controllers (flight_id)');
        $this->addSql('CREATE TABLE pilot (id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthdate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE plane (id INT NOT NULL, company_id INT NOT NULL, serialNumber VARCHAR(15) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C1B32D80979B1AD6 ON plane (company_id)');
        $this->addSql('CREATE TABLE terminal (id INT NOT NULL, airport_id INT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(45) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8F7B1541289F53C8 ON terminal (airport_id)');
        $this->addSql('CREATE TABLE track (id INT NOT NULL, airport_id INT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(45) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D6E3F8A6289F53C8 ON track (airport_id)');
        $this->addSql('ALTER TABLE airport ADD CONSTRAINT FK_7E91F7C28BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60EF53666A8 FOREIGN KEY (plane_id) REFERENCES plane (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60ECE55439B FOREIGN KEY (pilot_id) REFERENCES pilot (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60EE2AE981E FOREIGN KEY (departureTrack_id) REFERENCES track (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E50C27FBF FOREIGN KEY (arrivalTrack_id) REFERENCES track (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E10C7954D FOREIGN KEY (departureTerminal_id) REFERENCES terminal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E9D46EAF0 FOREIGN KEY (arrivalTerminal_id) REFERENCES terminal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60EF631AB5C FOREIGN KEY (departureAirport_id) REFERENCES airport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E7F43E343 FOREIGN KEY (arrivalAirport_id) REFERENCES airport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flights_controllers ADD CONSTRAINT FK_563BD9EDF6D1A74B FOREIGN KEY (controller_id) REFERENCES air_trafic_controller (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flights_controllers ADD CONSTRAINT FK_563BD9ED91F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plane ADD CONSTRAINT FK_C1B32D80979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE terminal ADD CONSTRAINT FK_8F7B1541289F53C8 FOREIGN KEY (airport_id) REFERENCES airport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A6289F53C8 FOREIGN KEY (airport_id) REFERENCES airport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60EF631AB5C');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60E7F43E343');
        $this->addSql('ALTER TABLE terminal DROP CONSTRAINT FK_8F7B1541289F53C8');
        $this->addSql('ALTER TABLE track DROP CONSTRAINT FK_D6E3F8A6289F53C8');
        $this->addSql('ALTER TABLE flights_controllers DROP CONSTRAINT FK_563BD9EDF6D1A74B');
        $this->addSql('ALTER TABLE airport DROP CONSTRAINT FK_7E91F7C28BAC62AF');
        $this->addSql('ALTER TABLE plane DROP CONSTRAINT FK_C1B32D80979B1AD6');
        $this->addSql('ALTER TABLE city DROP CONSTRAINT FK_2D5B0234F92F3E70');
        $this->addSql('ALTER TABLE flights_controllers DROP CONSTRAINT FK_563BD9ED91F478C5');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60ECE55439B');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60EF53666A8');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60E10C7954D');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60E9D46EAF0');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60EE2AE981E');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60E50C27FBF');
        $this->addSql('DROP SEQUENCE airport_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE air_trafic_controller_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE city_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE company_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE country_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE flight_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE flights_controllers_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pilot_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE plane_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE terminal_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE track_id_seq CASCADE');
        $this->addSql('DROP TABLE airport');
        $this->addSql('DROP TABLE air_trafic_controller');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE flight');
        $this->addSql('DROP TABLE flights_controllers');
        $this->addSql('DROP TABLE pilot');
        $this->addSql('DROP TABLE plane');
        $this->addSql('DROP TABLE terminal');
        $this->addSql('DROP TABLE track');
    }
}
