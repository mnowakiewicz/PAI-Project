<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190106193630 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE message ADD from_id BIGINT DEFAULT NULL, ADD to_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F78CED90B FOREIGN KEY (from_id) REFERENCES operator (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F30354A65 FOREIGN KEY (to_id) REFERENCES operator (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F78CED90B ON message (from_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F30354A65 ON message (to_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F78CED90B');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F30354A65');
        $this->addSql('DROP INDEX IDX_B6BD307F78CED90B ON message');
        $this->addSql('DROP INDEX IDX_B6BD307F30354A65 ON message');
        $this->addSql('ALTER TABLE message DROP from_id, DROP to_id');
    }
}
