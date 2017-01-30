<?php

namespace BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('role')
            ->add('name', TextType::class, array("label"=>"Nombre", "required"=>"required", "attr"=>array(
                "class"=>"form-name form-control")))

            ->add('surname', TextType::class, array("label"=>"Apellido", "required"=>"required", "attr"=>array(
                "class"=>"form-surname form-control")))
            ->add('email', EmailType::class, array("label"=>"Email", "required"=>"required", "attr"=>array(
                "class"=>"form-email form-control")))
            ->add('password', PasswordType::class, array("label"=>"Contrasena","required"=>"required", "attr"=>array(
                "class"=>"form-password form-control")))

            ->add('Guardar', SubmitType::class, array("attr"=>array(
                "class"=>"btn btn-success"
                )))
            //->add('image')
            //->add('createdAt', 'datetime')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\User'
        ));
    }
}
