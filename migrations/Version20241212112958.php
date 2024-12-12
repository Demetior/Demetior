<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241212112958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campaign ADD brand_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE campaign ADD CONSTRAINT FK_1F1512DD44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_1F1512DD44F5D008 ON campaign (brand_id)');
        $this->addSql('ALTER TABLE user ADD blogger_id INT NOT NULL, ADD brand_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D700BD1D FOREIGN KEY (blogger_id) REFERENCES blogger (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D700BD1D ON user (blogger_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64944F5D008 ON user (brand_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campaign DROP FOREIGN KEY FK_1F1512DD44F5D008');
        $this->addSql('DROP INDEX IDX_1F1512DD44F5D008 ON campaign');
        $this->addSql('ALTER TABLE campaign DROP brand_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D700BD1D');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64944F5D008');
        $this->addSql('DROP INDEX UNIQ_8D93D649D700BD1D ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D64944F5D008 ON user');
        $this->addSql('ALTER TABLE user DROP blogger_id, DROP brand_id');
    }
}
