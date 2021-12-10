<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208125419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur (id_user INT AUTO_INCREMENT NOT NULL, nom_user VARCHAR(50) NOT NULL, prenom_user VARCHAR(50) NOT NULL, email VARCHAR(150) NOT NULL, num_tel INT NOT NULL, username VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, depart VARCHAR(50) DEFAULT \'NULL\', destination VARCHAR(50) DEFAULT \'NULL\', cout INT DEFAULT NULL, type_service VARCHAR(50) DEFAULT \'NULL\', role VARCHAR(50) NOT NULL, PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE utilisateur');
    }
}
