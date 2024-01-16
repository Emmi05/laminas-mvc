<?php
namespace Album\Form;

use Laminas\Form\Form;
use Album\Model\AlbumTable;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Validator\Db\NoRecordExists; //es para validar repetidor
use Laminas\Validator\StringLength; //validar espacios


class AlbumForm extends Form implements InputFilterProviderInterface
{
  //modifique el construscur para que reciba la base de datos
    public function __construct(private AlbumTable $albumTable, $name = null, $options= [])
    {
        // We will ignore the name provided to the constructor
        parent::__construct('album', $options);
    }

    //necesito la clase init dque deriva del __contrusctir 
    public function init()
    {
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Title',
            ],
        ]);
        $this->add([
            'name' => 'artist',
            'type' => 'text',
            'options' => [
                'label' => 'Artist',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }

    public function getInputFilterSpecification(): array
    {
        return [
            'artist' => [
                'required' => true,
                'validators' => [
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 3,
                            'max'      => 100,
                        ],
                    ],
                    [
                        'name'    => NoRecordExists::class,
                        'options' => [
                            'table'     => $this->albumTable->getTable(),
                            'field'     => 'artist',
                            'dbAdapter' => $this->albumTable->getAdapter(),
                            'messages'  => [
                                NoRecordExists::ERROR_RECORD_FOUND => 'Artist name is already in use!!',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}