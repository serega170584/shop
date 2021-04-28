<?php

namespace App\Form;

use App\Entity\BasketItem;
use App\Form\DataTransformer\HiddenToEntityTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductAddFormType extends AbstractType
{
    private $transformer;

    public function __construct(HiddenToEntityTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', HiddenType::class);

        $builder->get('product')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BasketItem::class,
        ]);
    }
}
