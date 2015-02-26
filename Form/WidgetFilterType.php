<?php

namespace Victoire\Widget\FilterBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Victoire\Bundle\CoreBundle\Form\WidgetType;

/**
 * WidgetFilter form type
 */
class WidgetFilterType extends WidgetType
{
    /**
     * define form fields
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = array();

        foreach ($options['filters'] as $filter) {
            $choices[$filter->getName()] = 'widget_filter.'.$filter->getName();
        }

        $builder->add('listing', null, array(
                    'label' => 'widget_filter.form.list.label',
                ))
                ->add('filter', 'choice', array(
                    'label' => 'widget_filter.form.filters.label',
                    'choices' => $choices,
                ))
                ->add('ajax', null, array(
                    'label' => 'widget_filter.form.ajax.label',
                ))
                ->add('multiple', null, array(
                    'label' => 'widget_filter.form.multiple.label',
                ))
                ;

        $mode = $options['mode'];

        //add the mode to the form
        $builder->add('mode', 'hidden', array(
            'data' => $mode,
        ));
    }

    /**
     * bind form to WidgetRedactor entity
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'data_class'         => 'Victoire\Widget\FilterBundle\Entity\WidgetFilter',
            'widget'             => 'filter',
            'filters'            => array(),
            'translation_domain' => 'victoire',
        ));
    }

    /**
     * get form name
     *
     * @return string
     */
    public function getName()
    {
        return 'victoire_widget_form_filter';
    }
}
