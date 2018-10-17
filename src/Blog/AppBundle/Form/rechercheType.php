<?php
/**
 * Created by PhpStorm.
 * User: Sow
 * Date: 18/08/2018
 * Time: 11:33
 */
namespace AppBundle\Form;

use AppBundle\Entity\user;
use Symfony\Component\Form\AbstractType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;


class rechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('recherche', 'text', array('label' => false,
                                                              'attr' => array('class' => 'input-medium search-query'))
    );
    }

    public function getName()
    {
        return 'AppBundle_recherche';
    }
}