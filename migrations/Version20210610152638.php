<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210610152638 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            create table catalogue
(
    id         int auto_increment primary key,
    client_id  int                not null,
    product_id int                not null,
    price      smallint default 0 not null,
    unique INDEX catalague_unique_key (client_id, product_id),
    constraint catalogue_client_id_fk
        foreign key (client_id) references client (id),
    constraint catalogue_product_id_fk
        foreign key (product_id) references product (id)
)
    collate = utf8mb4_unicode_ci;
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE catalogue');
    }
}
