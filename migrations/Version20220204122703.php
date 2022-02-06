<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204122703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455326528F7 FOREIGN KEY (correspondence_address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE repair_order ADD CONSTRAINT FK_55F6573419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE repair_order ADD CONSTRAINT FK_55F65734545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE repair_order ADD CONSTRAINT FK_55F6573427E92E18 FOREIGN KEY (registered_by_id) REFERENCES worker (id)');
        $this->addSql('ALTER TABLE serivce ADD date_completion_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE serivce ADD CONSTRAINT FK_FE9D3956E4071493 FOREIGN KEY (repair_order_id) REFERENCES repair_order (id)');
        $this->addSql('ALTER TABLE serivce_worker ADD CONSTRAINT FK_4ADE503C8E4AF58F FOREIGN KEY (serivce_id) REFERENCES serivce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serivce_worker ADD CONSTRAINT FK_4ADE503C6B20BA36 FOREIGN KEY (worker_id) REFERENCES worker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496B20BA36 FOREIGN KEY (worker_id) REFERENCES worker (id)');
        $this->addSql('ALTER TABLE worker ADD CONSTRAINT FK_9FB2BF62D8132845 FOREIGN KEY (work_place_id) REFERENCES work_place (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address CHANGE country country VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE province province VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE town town VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE street street VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE post_code post_code VARCHAR(6) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE house_number house_number VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455326528F7');
        $this->addSql('ALTER TABLE client CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE surname surname VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE pesel pesel VARCHAR(11) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nip nip VARCHAR(11) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE regon regon VARCHAR(9) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(22) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE repair_order DROP FOREIGN KEY FK_55F6573419EB6921');
        $this->addSql('ALTER TABLE repair_order DROP FOREIGN KEY FK_55F65734545317D1');
        $this->addSql('ALTER TABLE repair_order DROP FOREIGN KEY FK_55F6573427E92E18');
        $this->addSql('ALTER TABLE repair_order CHANGE client_code client_code VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE serivce DROP FOREIGN KEY FK_FE9D3956E4071493');
        $this->addSql('ALTER TABLE serivce DROP date_completion_date, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE serivce_worker DROP FOREIGN KEY FK_4ADE503C8E4AF58F');
        $this->addSql('ALTER TABLE serivce_worker DROP FOREIGN KEY FK_4ADE503C6B20BA36');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6496B20BA36');
        $this->addSql('ALTER TABLE `user` CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE vehicle CHANGE manufacturer manufacturer VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE model model VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE production_year production_year VARCHAR(4) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE vin vin VARCHAR(17) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE registration_number registration_number VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE work_place CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE worker DROP FOREIGN KEY FK_9FB2BF62D8132845');
        $this->addSql('ALTER TABLE worker CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE surname surname VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
