<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304163750 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feature (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, content VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feature_result (feature_id INT NOT NULL, result_id INT NOT NULL, INDEX IDX_6A7F27BD60E4B879 (feature_id), INDEX IDX_6A7F27BD7A7B643 (result_id), PRIMARY KEY(feature_id, result_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposal (id INT AUTO_INCREMENT NOT NULL, next_step_id INT DEFAULT NULL, step_id INT NOT NULL, final_result_id INT DEFAULT NULL, courses_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, INDEX IDX_BFE59472B13C343E (next_step_id), INDEX IDX_BFE5947273B21E9C (step_id), INDEX IDX_BFE5947221016FC1 (final_result_id), INDEX IDX_BFE59472F9295384 (courses_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE result (id INT AUTO_INCREMENT NOT NULL, text VARCHAR(255) NOT NULL, result_name VARCHAR(255) NOT NULL, result_photo VARCHAR(255) NOT NULL, photo_species VARCHAR(255) DEFAULT NULL, photo_more VARCHAR(255) DEFAULT NULL, photo_complementary VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE feature_result ADD CONSTRAINT FK_6A7F27BD60E4B879 FOREIGN KEY (feature_id) REFERENCES feature (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE feature_result ADD CONSTRAINT FK_6A7F27BD7A7B643 FOREIGN KEY (result_id) REFERENCES result (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE59472B13C343E FOREIGN KEY (next_step_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE5947273B21E9C FOREIGN KEY (step_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE5947221016FC1 FOREIGN KEY (final_result_id) REFERENCES result (id)');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE59472F9295384 FOREIGN KEY (courses_id) REFERENCES course (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proposal DROP FOREIGN KEY FK_BFE59472F9295384');
        $this->addSql('ALTER TABLE feature_result DROP FOREIGN KEY FK_6A7F27BD60E4B879');
        $this->addSql('ALTER TABLE proposal DROP FOREIGN KEY FK_BFE59472B13C343E');
        $this->addSql('ALTER TABLE proposal DROP FOREIGN KEY FK_BFE5947273B21E9C');
        $this->addSql('ALTER TABLE feature_result DROP FOREIGN KEY FK_6A7F27BD7A7B643');
        $this->addSql('ALTER TABLE proposal DROP FOREIGN KEY FK_BFE5947221016FC1');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE feature');
        $this->addSql('DROP TABLE feature_result');
        $this->addSql('DROP TABLE proposal');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE result');
    }
}
