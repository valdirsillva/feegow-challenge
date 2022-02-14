<?php



namespace App\Models;

use App\Models\Connection;

class Scheduling extends Connection
{
   protected $pdo;
   
   public function __construct() 
   {
      $this->pdo = parent::getConn();
   }


   public function add(array $data) 
   {
      $toSql = "INSERT INTO schedules (specialty_id, professional_id, name, cpf, source_id, birthdate) 
                    VALUES (:especialidade_id, :profissional_id, :nome, :cpf, :origem_id, :aniversario) ";

      $toSql = $this->pdo->prepare($toSql);
      $bindValues = array(
        ":especialidade_id" => $data['specialties'], 
        ":profissional_id" => $data['professional'], 
        ":nome" => $data['name'], 
        ":cpf" => $data['cpf'], 
        ":origem_id" => $data['source_id'], 
        ":aniversario" => $data['birthdate']

      );


      $toSql->execute($bindValues);

      $numRows = $this->pdo->lastInsertId();

      return $numRows ?? '';

   }
}