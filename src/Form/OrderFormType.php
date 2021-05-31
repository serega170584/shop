<?php


namespace App\Form;


use App\Form\DataTransformer\HiddenToOrderStatusEntityTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class OrderFormType extends AbstractType
{
    /**
     * @var HiddenToOrderStatusEntityTransformer
     */
    private $transformer;

    public function __construct(HiddenToOrderStatusEntityTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class);

        $builder
            ->add('telephone', TelType::class);

        $builder
            ->add('address', TextareaType::class);

        $builder
            ->add('orderStatus', HiddenType::class);

        $builder->get('orderStatus')
            ->addModelTransformer($this->transformer);
    }
}