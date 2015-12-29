<?php
/**
 * FormHelpExtension.php
 * avanzu-admin-2
 * Date: 29.12.15
 */

namespace Avanzu\AdminThemeBundle\Form;


use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormHelpExtension extends AbstractTypeExtension
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefined(array('help'));
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (isset($options['help'])) {
            $view->vars['help'] = $options['help'];
        }
    }


    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return 'Symfony\Component\Form\Extension\Core\Type\FormType';
    }
}