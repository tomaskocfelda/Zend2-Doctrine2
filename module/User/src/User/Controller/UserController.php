<?php
namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;

use User\Entity\User;
use User\Entity\Registry;
use User\Form\UserForm;

/**
 * User Controller
 */
class UserController extends AbstractActionController
{
  /**
   * @var EntityManager
   */
  protected $entityManager;

  /**
   * Sets the EntityManager
   *
   * @param EntityManager $em
   * @access protected
   * @return UserController
   */
  protected function setEntityManager(EntityManager $em)
  {
    $this->entityManager = $em;
    return $this;
  }

  /**
   * Returns the EntityManager
   *
   * Fetches the EntityManager from ServiceLocator if it has not been initiated
   * and then returns it
   *
   * @access protected
   * @return EntityManager
   */
  protected function getEntityManager()
  {
    if (null === $this->entityManager) {
      $this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
    }
    return $this->entityManager;
  }

  /**
   * Users list action
   *
   * Fetches and displays all users.
   *
   * @return array view variables
   */
  public function indexAction()
  {
    $repository = $this->getEntityManager()->getRepository('User\Entity\User');
    $users      = $repository->findAll();
    return array(
      'users' => $users
    );
  }

  /**
   * Adds new User
   * @return array view variables
   */
  public function addAction()
  {
    // Loading and saving entity manager to Registry
    $em = $this->getEntityManager();
    Registry::set('entityManager', $em);

    $user = new User();
    $form = new UserForm();
    $form->bind($user);
    
    $request = $this->getRequest();
    if ($request->isPost()) {
      $form->setData($request->getPost());
      if ($form->isValid()) {
        $em->persist($user);
        $em->flush();

        $this->redirect()->toRoute('user');
      }
    }

    return array(
        'form' => $form
    );
  }

  /**
   * Edits User
   * @return array view variables
   */
  public function editAction()
  {
    $request = $this->getRequest();
    // Getting id parameter either from request or POST
    $id = $request->isPost() ? $request->getPost()->user["id"]:
            (int) $this->params('id', null);
    
    if (null === $id) {
      return $this->redirect()->toRoute('user');
    }

    $em = $this->getEntityManager();
    Registry::set('entityManager', $em);

    $user = $em->find('User\Entity\User', $id);

    $form = new UserForm();
    $form->bind($user);

    if ($request->isPost()) {
      $form->setData($request->getPost());
      if ($form->isValid()) {
        $em->persist($user);
        $em->flush();

        $this->redirect()->toRoute('user');
      }
    }

    return array(
      'form' => $form,
      'id' => $id
    );
  }

  /**
   * Deletes an User
   */
  public function deleteAction()
  {
    $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('user');
    }

    $em = $this->getEntityManager();

    $user = $em->find('User\Entity\User', $id);

    $em->remove($user);
    $em->flush();

    $this->redirect()->toRoute('user');
  }
}