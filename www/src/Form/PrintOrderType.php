<?php
namespace App\Form;


use App\Entity\PrintOrder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrintOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class)
                ->add('color', ColorType::class)
                ->add('polish', CheckboxType::class, [
                    'required' => false,
                ])
                ->add('width', RangeType::class, [
                    'attr' => [
                        'min' => 50,
                        'max' => 1000,
                        'data-postfix' => 'mm'
                    ]
                ])
                ->add('height',RangeType::class, [
                    'attr' => [
                        'min' => 50,
                        'max' => 1000,
                        'data-postfix' => 'mm'
                    ]
                ])
                ->add('Save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PrintOrder::class,
        ]);
    }
}