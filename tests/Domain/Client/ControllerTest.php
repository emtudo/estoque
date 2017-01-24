<?php
/**
 * @author: Leandro Henrique
 * @date:   2016-09-10 18:20:57
 * @last modified by:   Leandro Henrique
 * @last modified time: 2017-01-24 19:01:10
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

    public function testCreateWithOnlyCpf()
    {
        //Sets
        factory(Client::class)->create([
            'cpf' => '96638237632',
        ]);
        $headers = $this->getHeaders();

        $name = 'Emtudo';
        $cpf  = '96638237632';
        $data = [
            'name' => $name,
            'cpf'  => $cpf,
        ];

        //expects
        $this->post('client', $data, $headers);

        //Asserts
        $this->seeStatusCode(422);
    }

    public function testUpdate()
    {
        //Sets
        $client = factory(Client::class)->create([
            'cpf' => '96638237632',
        ]);
        $headers = $this->getHeaders();

        $name = 'Emtudo';
        $cpf  = '50403281091';
        $data = [
            'name'      => $name,
            'cpf'       => $cpf,
            'birthdate' => '2016-09-11',
        ];
        $this->put('client/' . $client->id, $data, $headers);

        //Asserts
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

    public function testDelete()
    {
        $client = factory(Client::class)->create();

        $headers = $this->getHeaders();

        $this->delete('client/' . $client->id, [], $headers);

        $this->seeStatusCode(200);
    }

    public function testShow()
    {
        $client = factory(Client::class)->create();

        $headers = $this->getHeaders();

        $this->get('client/' . $client->id, $headers);

        $this->seeStatusCode(200);

        $this->seeJson([
            'id' => $client->id,
        ]);
    }
}
