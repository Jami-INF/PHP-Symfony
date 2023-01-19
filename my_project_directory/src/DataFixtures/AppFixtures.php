<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use App\Entity\Categorie;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

           $categorie = Array();
            for ($i = 0; $i < 10; $i++) {
                $categorie[$i] = new Categorie();
                $categorie[$i]->setNom($faker->sentence($nbWords = 1, $variableNbWords = true));
                $categorie[$i]->setCouleur($faker->sentence($nbWords = 1, $variableNbWords = true));
                $manager->persist($categorie[$i]);
            }

           // on crée 4 annonces avec noms et prénoms "aléatoires" en français
            $annonces = Array();
            for ($i = 0; $i < 4; $i++) {
                $annonces[$i] = new Annonce();
                $annonces[$i]->setTitre($faker->sentence($nbWords = 6, $variableNbWords = true));
                $annonces[$i]->setContenu($faker->sentence($nbWords = 20, $variableNbWords = true));
                $annonces[$i]->setPrix($faker->numberBetween($min = 0, $max = 1000));
                $annonces[$i]->setPostal($faker->numberBetween($min = 10000, $max = 100000));
                $annonces[$i]->setDateCreation(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $annonces[$i]->setCategorie($categorie[rand(0, 9)]);
                $manager->persist($annonces[$i]);
            }
       // nouvelle boucle pour créer des livres

        $manager->flush();


    }
}
