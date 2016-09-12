<?php
/**
 * @author: Leandro Henrique
 * @date:   2016-09-10 18:20:57
 * @last modified by:   Leandro Henrique
 * @last modified time: 2016-09-11 23:16:57
 */

namespace Domain\Client;

class ControllerTest extends \TestCase
{
    public function testCreate()
    {
        //Sets
        $headers = $this->getHeaders();

        $name = 'Emtudo';
        $data = [
            'name' => $name,
        ];
        $this->post('client', $data, $headers);
        $this->seeStatusCode(200);
        $this->seeJson([
            'name' => $name,
        ]);
        $this->seeInDatabase('clients', [
            'name' => $name,
        ]);
    }

    public function testCreateWithCpf()
    {
        //Sets
        $headers = $this->getHeaders();

        $name = 'Emtudo';
        $cpf  = '96638237632';
        $data = [
            'name' => $name,
            'cpf'  => $cpf,
        ];
        $this->post('client', $data, $headers);
        $this->seeStatusCode(200);
        $this->seeJson([
            'name' => $name,
            'cpf'  => $cpf,
        ]);
        $this->seeInDatabase('clients', [
            'name' => $name,
            'cpf'  => $cpf,
        ]);
    }

    public function testCreateWithCpfAndBirthdate()
    {
        //Sets
        $headers = $this->getHeaders();

        $name = 'Emtudo';
        $cpf  = '96638237632';
        $data = [
            'name'      => $name,
            'cpf'       => $cpf,
            'birthdate' => '2016-09-11',
        ];
        $this->post('client', $data, $headers);
        $this->seeStatusCode(200);
        $this->seeJson([
            'name' => $name,
            'cpf'  => $cpf,
        ]);
        $this->seeInDatabase('clients', [
            'name' => $name,
            'cpf'  => $cpf,
        ]);
    }
}
