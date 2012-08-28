<?php
namespace User\Form;

use User\Entity\User;
use User\Entity\Registry;


use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;


class UserFieldset extends Fieldset implements InputFilterProviderInterface
{
  public function __construct()
  {
    parent::__construct('user');

    $em = Registry::get('entityManager');

    $this->setHydrator(new DoctrineEntity($em))
         ->setObject(new User());

    $this->setLabel('Post');

    $this->add(array(
      'name' => 'id',
      'attributes' => array(
        'type' => 'hidden'
      )
    ));

    $this->add(array(
      'name' => 'name',
      'options' => array(
        'label' => 'Name of user'
      ),
      'attributes' => array(
        'type' => 'text'
      )
    ));

    $this->add(array(
      'name' => 'motto',
      'options' => array(
        'label' => 'Motto of user'
      ),
      'attributes' => array(
        'type' => 'textarea'
      )
    ));
  }

  /**
   * Define InputFilterSpecifications
   *
   * @access public
   * @return array
   */
  public function getInputFilterSpecification()
  {
    return array(
      'name' => array(
        'required' => true,
        'filters' => array(
          array('name' => 'StringTrim'),
          array('name' => 'StripTags')
        ),
        'properties' => array(
          'required' => true
        )
      ),
      'motto' => array(
        'required' => true,
        'filters' => array(
          array('name' => 'StringTrim'),
          array('name' => 'StripTags')
        ),
        'properties' => array(
          'required' => true
        )
      )
    );
  }
}