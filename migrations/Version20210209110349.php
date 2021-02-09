<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210209110349 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, quantity INTEGER DEFAULT NULL, category VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, resume CLOB NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE customer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE TABLE customer_book (customer_id INTEGER NOT NULL, book_id INTEGER NOT NULL, PRIMARY KEY(customer_id, book_id))');
        $this->addSql('CREATE INDEX IDX_9F7407469395C3F3 ON customer_book (customer_id)');
        $this->addSql('CREATE INDEX IDX_9F74074616A2B381 ON customer_book (book_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE customer_book');
    }
}
