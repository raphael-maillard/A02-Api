<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216101804 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthday DATE NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, name, author, quantity, category, image, resume, created_at, isbn FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, author VARCHAR(255) NOT NULL COLLATE BINARY, quantity INTEGER DEFAULT NULL, category VARCHAR(255) NOT NULL COLLATE BINARY, image VARCHAR(255) DEFAULT NULL COLLATE BINARY, created_at DATETIME DEFAULT NULL, isbn VARCHAR(255) DEFAULT NULL COLLATE BINARY, summary CLOB NOT NULL)');
        $this->addSql('INSERT INTO book (id, name, author, quantity, category, image, summary, created_at, isbn) SELECT id, name, author, quantity, category, image, resume, created_at, isbn FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
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
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, name, author, quantity, category, image, summary, created_at, isbn FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, quantity INTEGER DEFAULT NULL, category VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, isbn VARCHAR(255) DEFAULT NULL, resume CLOB NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO book (id, name, author, quantity, category, image, resume, created_at, isbn) SELECT id, name, author, quantity, category, image, summary, created_at, isbn FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
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
