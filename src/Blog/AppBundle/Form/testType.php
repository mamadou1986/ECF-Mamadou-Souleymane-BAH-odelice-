<?php
/**
 * Created by PhpStorm.
 * User: Sow
 * Date: 16/08/2018
 * Time: 13:35
 */
namespace AppBundle\Form;

use AppBundle\Entity\user;
use Symfony\Component\Form\AbstractType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;

class testType extends AbstractType
   {
       public function buildForm(FormBuilderInterface $builder, array $options)
       {
          // parent::buildForm($builder, $options);
           $builder
               ->add('email')
               ->add('nom',NULL,array('required' => false))
               ->add('prenom')
               ->add('contenu')


           ;
       }

       public function getName()
       {
           return 'AppBundle_test';
       }
   }
