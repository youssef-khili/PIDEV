<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208145746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE covoiturage (id_covoiturage INT AUTO_INCREMENT NOT NULL, depart VARCHAR(255) DEFAULT NULL, arrive VARCHAR(255) NOT NULL, tarif INT DEFAULT NULL, longueurtrajet INT NOT NULL, idveh INT NOT NULL, nbpsg INT NOT NULL, PRIMARY KEY(id_covoiturage)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateur CHANGE cout cout INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE covoiturage');
        $this->addSql('ALTER TABLE utilisateur CHANGE cout cout INT DEFAULT NULL');
    }
}
