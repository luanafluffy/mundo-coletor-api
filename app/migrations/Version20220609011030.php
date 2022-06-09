<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220609011030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collector DROP facebook, DROP instagram, DROP whatsapp, DROP image, CHANGE fetch_collection fetch_collection INT NOT NULL, CHANGE receive_collection receive_collection INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collector ADD facebook VARCHAR(255) DEFAULT NULL, ADD instagram VARCHAR(255) DEFAULT NULL, ADD whatsapp VARCHAR(255) DEFAULT NULL, ADD image VARCHAR(255) DEFAULT NULL, CHANGE fetch_collection fetch_collection TINYINT(1) NOT NULL, CHANGE receive_collection receive_collection TINYINT(1) NOT NULL');
    }
}
