<?php

namespace App\Controller\Admin;

use App\Entity\Skills;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SkillsCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityPermission('ROLE_ADMIN')
            ->renderContentMaximized()
            ->setEntityLabelInSingular('compétence')
            ->setEntityLabelInPlural('compétences')
            ->setPageTitle('index', 'Liste des %entity_label_plural%')
            ->setPageTitle('edit', fn (Skills $project) => sprintf('Modification : <b>%s</b>', $project->getName()))
            ->setDefaultSort(['category' => 'ASC'])
            ->setPaginatorPageSize(15)
            ;
    }

    public static function getEntityFqcn(): string
    {
        return Skills::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Désignation'),
            ChoiceField::new('category', 'Catégorie')->setChoices([
                'Langages de programmation et de balisage' => 'ProgrammingAndMarkupLanguages',
                'Outils de développement et environnements' => 'DevelopmentToolsAndEnvironments',
                'Design et création visuelle' => 'DesignAndVisualCreation',
                'Outils de transfert de fichiers et gestion' => 'FileTransferAndManagementTools',
            ]),
            ChoiceField::new('progressbar', 'Niveau de connaissance')->setChoices([
                'Notions' => 'notions',
                'Basique' => 'basique',
                'Correcte' => 'correcte',
                'Avancé' => 'avance'
            ]),
        ];
    }
}
