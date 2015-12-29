<?php
/**
 * FormDemoModelType.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FormDemoModelType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options = array(
            'opt1' => 'This is option 1',
            'opt2' => 'This is option 2',
            'opt3' => 'This is option 3',
        );

        $choices = array(
            'choice1' => 'This is choice 1',
            'choice2' => 'This is choice 2',
            'choice3' => 'This is choice 3',
        );

        $builder->add('name')
                ->add('gender', ChoiceType::class, array('choices' => array('m' => 'male', 'f' => 'female')))
                ->add('someOption', ChoiceType::class, array('choices' => $options, 'expanded' => true))
                ->add('someChoices',  ChoiceType::class, array('choices' => $choices, 'expanded' => true, 'multiple' => true))
                ->add('username')
                ->add('email')
                ->add('termsAccepted',CheckboxType::class)
                ->add('message', TextareaType::class)
                ->add('price')
                ->add('date', DateType::class, array('widget' => 'single_text'))
                ->add('time', TimeType::class, array('widget' => 'single_text'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Avanzu\AdminThemeBundle\Model\FormDemoModel',
            ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'form_demo';
    }
}