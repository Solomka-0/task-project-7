<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240411171518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("CREATE TABLE user (
        id INT AUTO_INCREMENT NOT NULL, 
        email VARCHAR(255) unique NOT NULL, 
        name VARCHAR(255) unique NOT NULL, 
        sex ENUM('male', 'female') DEFAULT NULL, 
        birthday DATE NOT NULL, 
        phone VARCHAR(20) unique NOT NULL, 
        created_at DATETIME NOT NULL, 
        updated_at DATETIME NOT NULL, 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");

        $this->addSql("CREATE INDEX name_index ON user(name) USING BTREE");
        $this->addSql("CREATE INDEX email_index ON user(email) USING BTREE");
        $this->addSql("CREATE INDEX phone_index ON user(phone) USING BTREE");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
    }
}
