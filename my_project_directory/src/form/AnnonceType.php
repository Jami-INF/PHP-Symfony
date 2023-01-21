<?php

namespace App\form;

use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Categorie;
use App\Repository\CategorieRepository;

class AnnonceType extends AbstractType
{
     private $categorieRepo;

     public function __construct(CategorieRepository $categorieRepo)
     {
         $this->categorieRepo = $categorieRepo;
     }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre')
            ->add('Contenu')
            ->add('Prix')
            ->add('Postal')
            ->add('Date_creation')
            ->add('categorie',EntityType::class,[
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'choices' => $this->categorieRepo->findAll(),
                'expanded' => true,
                'multiple' => false,
                'attr' => ['class' => 'form-control'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
