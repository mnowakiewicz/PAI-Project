<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181112115424 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql(
                "INSERT INTO printType (printType.name, printType.isActive, printType.creationDate, printType.editDate)
                      VALUES 
                        ('MAGAZINE', true, NOW(), NULL ),
                        ('BOOK', true, NOW(), NULL );
                    
                    ");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql(
            "DELETE FROM printType WHERE printType.name IN ('MAGAZINE', 'BOOK')");

    }
}
