<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Controller\Admin\CategoryCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use App\Controller\Admin\TechnologyCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjectCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityPermission('ROLE_ADMIN')
            ->renderContentMaximized()
            ->setEntityLabelInSingular('projet')
            ->setEntityLabelInPlural('projets')
            ->setPageTitle('index', 'Liste des %entity_label_plural%')
            ->setPageTitle('edit', fn (Project $project) => sprintf('Modification : <b>%s</b>', $project->getTitle()))
            ->setDefaultSort(['updatedAt' => 'ASC'])
            ->setPaginatorPageSize(15)
            ;
    }

    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Projet'),
            FormField::addColumn(6),
            TextField::new('title', 'Titre du projet'),
            SlugField::new('slug')->setTargetFieldName('title')->hideOnIndex(),
            AssociationField::new('category', 'Catégorie')->setCrudController(CategoryCrudController::class),
            TextareaField::new('content', 'Déscription')->hideOnIndex(),
            CollectionField::new('technology', 'Technologies')->useEntryCrudForm(TechnologyCrudController::class)->hideOnIndex(),

            FormField::addColumn(6),
            TextField::new('imageFile', 'Image')->setFormType(VichImageType::class)->onlyOnForms(),            
            ImageField::new('imageName', 'Image')->setBasePath('/pictures/uploads/project')->hideOnForm(),
            SlugField::new('imageSlug')->setTargetFieldName('title')->hideOnIndex(),
            UrlField::new('url', 'Url du projet')->hideOnIndex(),
           
        ];
    }
}
