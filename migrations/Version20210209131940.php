<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210209131940 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer AS SELECT id, firstname, lastname, created_at, modified_at FROM customer');
        $this->addSql('DROP TABLE customer');
        $this->addSql('CREATE TABLE customer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL COLLATE BINARY, lastname VARCHAR(255) NOT NULL COLLATE BINARY, modified_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO customer (id, firstname, lastname, created_at, modified_at) SELECT id, firstname, lastname, created_at, modified_at FROM __temp__customer');
        $this->addSql('DROP TABLE __temp__customer');
        $this->addSql('DROP INDEX IDX_9F74074616A2B381');
        $this->addSql('DROP INDEX IDX_9F7407469395C3F3');
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer_book AS SELECT customer_id, book_id FROM customer_book');
        $this->addSql('DROP TABLE customer_book');
        $this->addSql('CREATE TABLE customer_book (customer_id INTEGER NOT NULL, book_id INTEGER NOT NULL, PRIMARY KEY(customer_id, book_id), CONSTRAINT FK_9F7407469395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9F74074616A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO customer_book (customer_id, book_id) SELECT customer_id, book_id FROM __temp__customer_book');
        $this->addSql('DROP TABLE __temp__customer_book');
        $this->addSql('CREATE INDEX IDX_9F74074616A2B381 ON customer_book (book_id)');
        $this->addSql('CREATE INDEX IDX_9F7407469395C3F3 ON customer_book (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer AS SELECT id, firstname, lastname, created_at, modified_at FROM customer');
        $this->addSql('DROP TABLE customer');
        $this->addSql('CREATE TABLE customer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, modified_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO customer (id, firstname, lastname, created_at, modified_at) SELECT id, firstname, lastname, created_at, modified_at FROM __temp__customer');
        $this->addSql('DROP TABLE __temp__customer');
        $this->addSql('DROP INDEX IDX_9F7407469395C3F3');
        $this->addSql('DROP INDEX IDX_9F74074616A2B381');
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer_book AS SELECT customer_id, book_id FROM customer_book');
        $this->addSql('DROP TABLE customer_book');
        $this->addSql('CREATE TABLE customer_book (customer_id INTEGER NOT NULL, book_id INTEGER NOT NULL, PRIMARY KEY(customer_id, book_id))');
        $this->addSql('INSERT INTO customer_book (customer_id, book_id) SELECT customer_id, book_id FROM __temp__customer_book');
        $this->addSql('DROP TABLE __temp__customer_book');
        $this->addSql('CREATE INDEX IDX_9F7407469395C3F3 ON customer_book (customer_id)');
        $this->addSql('CREATE INDEX IDX_9F74074616A2B381 ON customer_book (book_id)');
    }
}
