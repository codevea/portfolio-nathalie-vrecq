<?php

namespace App\Controller\Admin;

use App\Entity\Monitoring;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MonitoringCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityPermission('ROLE_ADMIN')
            ->renderContentMaximized()
            ->setEntityLabelInSingular('une veille informationnelle')
            ->setEntityLabelInPlural('veilles informationnelles')
            ->setPageTitle('index', 'Liste des %entity_label_plural%')
            ->setPageTitle('edit', fn (Monitoring $project) => sprintf('Modification : <b>%s</b>', $project->getTitle()))
            ->setDefaultSort(['category' => 'ASC'])
            ->setPaginatorPageSize(15)
            ;
    }

    public static function getEntityFqcn(): string
    {
        return Monitoring::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addColumn(7),
            ChoiceField::new('category', 'Catégorie')->setChoices([
                'Actualitées Informatiques et générales' => 'actualites-informatiques-et-generales',
                'Sources d\'inspiration: formation, tutoriel et resources' => 'sources-d-inspiration-formation-tutoriel-et-resources',
                'Reglementations, droits et protection' => 'reglementations-droits-et-protection',
                'Thécnologies et outils' => 'thecnologies-et-outils',
            ]),
            TextareaField::new('content', 'Déscription')->hideOnIndex(),


            FormField::addColumn(5),
            TextField::new('title', 'Titre'),
            UrlField::new('url')->hideOnIndex(),
            ChoiceField::new('uxicon', 'Icône')->setChoices([
                'Icône : Voyage' => 'icone-voyage',
                'Icône : Live journal' => 'icone-live-journal',
                'Icône : Information' => 'icone-information',
                'Icône : Symfony' => 'icone-symfony',
                'Icône : Vidéo, tutoriels et formations' => 'icone-video-tutoriels-et-formations',
                'Icône : Github' => 'icone-github',
                'Icône : Mathématique' => 'icone-mathematique',
                'Icône : MOOC et formations numériques' => 'icone-mooc-et-formations-numeriques',
                'Icône : Vite' => 'icone-vite-outil-de-construction-frontend',
                'Icône : Code et programmation' => 'icone-code-et-programmation',
                'Icône : Sécurité générale' => 'icone-securite-generale',
                'Icône : Donnée personnelle' => 'icone-donnee-personnelle',
            ])->hideOnIndex(),
        ];
    }

}
