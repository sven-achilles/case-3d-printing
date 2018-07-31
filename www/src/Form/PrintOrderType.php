<?php
namespace App\Form;

use App\Entity\PrintOrder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
                ->add('material', ChoiceType::class, [
                    'choices' => [
                        'Plastic'    => PrintOrder::MATERIAL_PLASTIC,
                        'Fine detail plastic' => PrintOrder::MATERIAL_FINE_PLASTIC,
                        'Aluminum'   => PrintOrder::MATERIAL_ALUMINUM,
                        'Sand stone' => PrintOrder::MATERIAL_SAND_STONE,
                    ]
                ])
                ->add('finish', ChoiceType::class, [
                    'choices' => [
                        'None'     => PrintOrder::FINISH_NONE,
                        'Professional plastic' => PrintOrder::FINISH_PLASTIC,
                        'Platinum' => PrintOrder::FINISH_PLATINUM,
                        'Gold'     => PrintOrder::FINISH_GOLD,
                        'Silver'   => PrintOrder::FINISH_SILVER,
                        'Bronze'   => PrintOrder::FINISH_BRONZE,
                        'Brass'    => PrintOrder::FINISH_BRASS,
                    ]
                ])
                ->add('color', ColorType::class)
                ->add('polish', CheckboxType::class, [
                    'required' => false,
                ])
                ->add('design', FileType::class, [
                    'label' => '3D Design (STL file, 50MB max)',
                    'required' => false
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