<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230423004039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id_user INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, date_naiss DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE echange (ID_echange INT AUTO_INCREMENT NOT NULL, ID_produit INT NOT NULL, ID_user INT NOT NULL, Statut VARCHAR(255) NOT NULL, Date_echange DATE NOT NULL, INDEX fk_Id (ID_user, ID_produit), PRIMARY KEY(ID_echange)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id_message INT AUTO_INCREMENT NOT NULL, to_conv INT DEFAULT NULL, from_user INT DEFAULT NULL, message_text TEXT NOT NULL, date_time DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX fk_conv (to_conv), INDEX fk_sender (from_user), PRIMARY KEY(id_message)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, sujet VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, nbr_jaime INT NOT NULL, image VARCHAR(255) DEFAULT NULL, nom_user VARCHAR(255) NOT NULL, date_p DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, communaute VARCHAR(255) NOT NULL, analyse_po VARCHAR(255) DEFAULT NULL, liked INT DEFAULT NULL, badlevel INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poste (id INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, img VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX fk_id_user (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (ID_produit INT AUTO_INCREMENT NOT NULL, ID_user INT NOT NULL, Categorie VARCHAR(255) NOT NULL, Valeur INT NOT NULL, INDEX fk_Iduser (ID_user), PRIMARY KEY(ID_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id_Rating INT AUTO_INCREMENT NOT NULL, id_post INT NOT NULL, id_user INT NOT NULL, rating DOUBLE PRECISION NOT NULL, PRIMARY KEY(id_Rating)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, reclamation_category_id INT DEFAULT NULL, reclamation_type VARCHAR(30) DEFAULT NULL, reclamation_Date DATE NOT NULL, contenu VARCHAR(50) NOT NULL, objet VARCHAR(20) DEFAULT NULL, INDEX ezadaz (reclamation_category_id), INDEX zadzad (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation_category (category_id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, description_cat VARCHAR(50) NOT NULL, PRIMARY KEY(category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, email VARCHAR(30) NOT NULL, age INT NOT NULL, mdp VARCHAR(30) NOT NULL, role VARCHAR(30) NOT NULL, verification_code VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FEEAA8803 FOREIGN KEY (to_conv) REFERENCES conv (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF8050BAA FOREIGN KEY (from_user) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT FK_7C890FAB6B3CA4B FOREIGN KEY (id_user) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE6064046B3CA4B FOREIGN KEY (id_user) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404E122D73 FOREIGN KEY (reclamation_category_id) REFERENCES reclamation_category (category_id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE commentairee ADD CONSTRAINT FK_2D6A75956B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE commentairee ADD CONSTRAINT FK_2D6A7595920C4E9B FOREIGN KEY (id_poste) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE conv ADD CONSTRAINT FK_94499CCF3524A02 FOREIGN KEY (idconv_user2) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE conv ADD CONSTRAINT FK_94499CCE4513A06 FOREIGN KEY (idconv_user) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC4B89032C');
        $this->addSql('ALTER TABLE commentairee DROP FOREIGN KEY FK_2D6A7595920C4E9B');
        $this->addSql('ALTER TABLE commentairee DROP FOREIGN KEY FK_2D6A75956B3CA4B');
        $this->addSql('ALTER TABLE conv DROP FOREIGN KEY FK_94499CCF3524A02');
        $this->addSql('ALTER TABLE conv DROP FOREIGN KEY FK_94499CCE4513A06');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FEEAA8803');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF8050BAA');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY FK_7C890FAB6B3CA4B');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE6064046B3CA4B');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404E122D73');
        $this->addSql('DROP TABLE echange');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reclamation_category');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
