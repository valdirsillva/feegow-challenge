<?php 

namespace App\Controller;

use App\Models\Scheduling;

class ControllerShendule 
{
    public static function  add( array $content) 
    {
        
        if (!empty( $content )) {

           $data = self::setDataValues($content);

            $shenduling = new Scheduling;
            $lastId = $shenduling->add($data);

            if (!empty($lastId)) {
                http_response_code(201);
                echo json_encode(['message' => 'Dados salvos com sucesso']);
                die;
            }
        }
        http_response_code(400);
        echo json_encode(['message' => 'Erro ao tentar salvar os dados']);  
    }

    protected function setDataValues($content) 
    {
        return [
            'specialties' =>   $content['specialties'],
            'professional' =>  $content['professional'],
            'name' =>  $content['name'],
            'cpf' =>   $content['cpf'], 
            'source_id' =>   $content['source_id'], 
            'birthdate' =>   $content['birthdate']
        ];
    }
}
