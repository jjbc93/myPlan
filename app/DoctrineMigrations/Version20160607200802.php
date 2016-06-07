<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160607200802 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_4E10122DA02A2F00 (descripcion), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evento (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, horario VARCHAR(255) NOT NULL, fecha VARCHAR(255) NOT NULL, patrocinadores VARCHAR(255) NOT NULL, lugar VARCHAR(255) NOT NULL, direccion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_categoria (event_id INT NOT NULL, categoria_id INT NOT NULL, INDEX IDX_C8852C1071F7E88B (event_id), INDEX IDX_C8852C103397707A (categoria_id), PRIMARY KEY(event_id, categoria_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, correo VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, imagen VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_2265B05D77040BC9 (correo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user (usuario_id INT NOT NULL, evento_id INT NOT NULL, INDEX IDX_92589AE2DB38439E (usuario_id), INDEX IDX_92589AE287A5F842 (evento_id), PRIMARY KEY(usuario_id, evento_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_categoria ADD CONSTRAINT FK_C8852C1071F7E88B FOREIGN KEY (event_id) REFERENCES evento (id)');
        $this->addSql('ALTER TABLE event_categoria ADD CONSTRAINT FK_C8852C103397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE287A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event_categoria DROP FOREIGN KEY FK_C8852C103397707A');
        $this->addSql('ALTER TABLE event_categoria DROP FOREIGN KEY FK_C8852C1071F7E88B');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE287A5F842');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE2DB38439E');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE evento');
        $this->addSql('DROP TABLE event_categoria');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE event_user');
    }
}
