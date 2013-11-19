<?php

namespace Alchemy\Phrasea\Setup\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class UserAuthProviderMigration extends AbstractMigration
{
    public function doUpSql(Schema $schema)
    {
        $this->addSql("CREATE TABLE UsrAuthProviders (id INT AUTO_INCREMENT NOT NULL, usr_id INT NOT NULL, provider VARCHAR(32) NOT NULL, distant_id VARCHAR(192) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, UNIQUE INDEX unique_provider_per_user (usr_id, provider), UNIQUE INDEX provider_ids (provider, distant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
    }

    public function doDownSql(Schema $schema)
    {
        $this->addSql("DROP TABLE UsrAuthProviders");
    }
}
