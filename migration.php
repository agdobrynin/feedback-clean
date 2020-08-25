<?php

declare(strict_types=1);
/**
 * CLI утилита миграцмй БД
 * Запуск php migration.php ***
 */

use Core\Config;

require_once 'autoload.php';
$pdo = (new Config(require 'config.php'))->pdo();

// Справка
$help = <<< EOL

Это консольная утилита для выполнения миграций БД.

Для применения миграций выполнить в командной строке:
php {$argv[0]} -m=up

Для отмены миграций выполнить в командной строке:
php {$argv[0]} -m=down

EOL;

if (PHP_SAPI !== 'cli') {
    die($help);
}

$options = getopt('m::', ['migration::']);
$migrationType = $options['m'] ?? ($options['migration'] ?? '');
if (empty($migrationType) || !\in_array($migrationType, ['up', 'down'])) {
    die($help);
}

// выполнить миграцию на создание
if ('up' === $migrationType) {
    return migrationSqlUp($pdo);
}
// выполнить миграцию на отмену
if ('down' === $migrationType) {
    return migrationSqlDown($pdo);
}


function migrationSqlUp(\PDO $pdo): void
{
    $tableMessages = App\Entity\Message::TABLE;

    $sql = <<< SQL
            CREATE TABLE IF NOT EXISTS {$tableMessages} (
                id integer constraint Messages_pk primary key autoincrement,
                name varchar default 255 not null,
                email varchar default 100 not null,
                message text not null,
                createdAt integer not null
            );
        SQL;
    print 'Создание таблицы ' . $tableMessages . ' = ';
    print $pdo->query($sql)->execute() ? 'success' : 'fail';
    print PHP_EOL;
}

function migrationSqlDown(\PDO $pdo): void
{
    $tableMessages = App\Entity\Message::TABLE;
    $sql = sprintf('DROP TABLE IF EXISTS %s;', $tableMessages);
    print 'Удаление таблицы ' . $tableMessages . ' = ' . $sql . ' : ';
    print $pdo->query($sql)->execute() ? 'success' : 'fail';
    print PHP_EOL;
}
