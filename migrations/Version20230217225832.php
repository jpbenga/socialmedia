<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230217225832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE micropost_user (micropost_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_185BF9D8DD1A3951 (micropost_id), INDEX IDX_185BF9D8A76ED395 (user_id), PRIMARY KEY(micropost_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE micropost_user ADD CONSTRAINT FK_185BF9D8DD1A3951 FOREIGN KEY (micropost_id) REFERENCES micropost (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE micropost_user ADD CONSTRAINT FK_185BF9D8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE micropost_user DROP FOREIGN KEY FK_185BF9D8DD1A3951');
        $this->addSql('ALTER TABLE micropost_user DROP FOREIGN KEY FK_185BF9D8A76ED395');
        $this->addSql('DROP TABLE micropost_user');
    }
}
