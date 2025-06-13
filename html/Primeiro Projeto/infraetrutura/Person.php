<?php
class Person
{
    //Atributos
    private $id;
    private $name;
    private $idade;
    private $data_nascimento;

    //Construtor
    public function _construct()
    {

    }

    //Métodos
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getIdade()
    {
        return $this->idade;
    }

    public function setIdade($idade)
    {
        $this->idade = $idade;
    }

    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento($data_nascimento)
    {
        $this->data_nascimento = $data_nascimento;
    }

    public function toString()
    {
        return "Pessoas: \nID: $this->id\nNome: $this->name\nIdade: $this->idade\nData de Nascimento: $this->data_nascimento";
    }
}