<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180730140805 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE print_order ADD user_id INT DEFAULT NULL, ADD create_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE print_order ADD CONSTRAINT FK_844C1953A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_844C1953A76ED395 ON print_order (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE print_order DROP FOREIGN KEY FK_844C1953A76ED395');
        $this->addSql('DROP INDEX IDX_844C1953A76ED395 ON print_order');
        $this->addSql('ALTER TABLE print_order DROP user_id, DROP create_date');
    }
}
