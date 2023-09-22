<?php

namespace Pokedex\Models;

use Pokedex\Utils\Database;
use PDO;

class Type extends CoreModel
{
    private $color;

    public function getColor(): string
    {
        return $this->color;
    }

    public function findAll()
    {
        $sql = '
            SELECT *
            FROM `type`
            ORDER BY `name`
        ';

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);
        $types = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $types;
    }
}