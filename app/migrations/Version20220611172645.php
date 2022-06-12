<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220611172645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Descriptions about our app.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE about_us (id INT AUTO_INCREMENT NOT NULL, text VARCHAR(1000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE about_us');
    }
}
