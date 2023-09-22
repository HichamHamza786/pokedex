<?php

namespace Pokedex\Models;   

use Pokedex\Utils\Database;
use PDO;
use Pokedex\Models\Type;

class Pokemon extends CoreModel
{
    /**
     * Properties storing pokemon datas
     */
    private $hp;
    private $attack;
    private $defense;
    private $spe_attack;
    private $spe_defense;
    private $speed;
    private $number;

    /**
     * Get the value of hp
     */
    public function getHp(): int
    {
        return $this->hp;
    }

    /**
     * Get the value of attack
     */
    public function getAttack(): int
    {
        return $this->attack;
    }

    /**
     * Get the value of defense
     */
    public function getDefense(): int
    {
        return $this->defense;
    }

    /**
     * Get the value of spe_attack
     */
    public function getSpe_attack(): int
    {
        return $this->spe_attack;
    }

    /**
     * Get the value of spe_defense
     */
    public function getSpe_defense(): int
    {
        return $this->spe_defense;
    }

    /**
     * Get the value of speed
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * Get the value of number
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * Get the pokemon list by number
     */
    public function findAll()
    {
        $sql = '
            SELECT *
            FROM `pokemon`
            ORDER BY `number`
        ';

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);
        $pokemons = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);

        return $pokemons;
    }

    /**
     * Get the pokemon details
     */
    public function find($number)
    {
        $sql = '
            SELECT *
            FROM `pokemon`
            WHERE `number` = :number
            LIMIT 1
        ';

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':number', $number, PDO::PARAM_INT);
        $pdoStatement->execute();
        $pokemon = $pdoStatement->fetchObject(static::class);

        return $pokemon;
    }

    /**
     * Get the pokemon list type
     */
    public function findByType($typeId)
    {
        $sql = '
            SELECT *
            FROM `pokemon`
            INNER JOIN `pokemon_type` ON `pokemon_type`.`pokemon_number` = `pokemon`.`number`
            WHERE `pokemon_type`.`type_id` = :typeId
            ORDER BY `pokemon`.`number`
        ';

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':typeId', $typeId, PDO::PARAM_INT);
        $pdoStatement->execute();
        $pokemons = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);

        return $pokemons;
    }

    /**
     * Get types of current pokemon
     */
    public function getTypes()
    {
        $sql = '
            SELECT `type`.*
            FROM `pokemon_type`
            INNER JOIN `type` ON `type`.`id` = `pokemon_type`.`type_id`
            WHERE `pokemon_type`.`pokemon_number` = :number
        ';

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':number', $this->number, PDO::PARAM_INT);
        $pdoStatement->execute();
        $types = $pdoStatement->fetchAll(PDO::FETCH_CLASS, Type::class);

        return $types;
    }
}