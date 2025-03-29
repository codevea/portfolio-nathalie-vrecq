<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityPermission('ROLE_ADMIN')
            ->renderContentMaximized()
            ->setEntityLabelInSingular('catégorie')
            ->setEntityLabelInPlural('catégories')
            ->setPageTitle('index', 'Liste des %entity_label_plural%')
            ->setPageTitle('edit', fn (Category $project) => sprintf('Modification : <b>%s</b>', $project->getName()))
            ->setDefaultSort(['name' => 'ASC'])
            ->setPaginatorPageSize(15)
            ;
    }

    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Catégorie'),
            SlugField::new('slug', 'Slug')->setTargetFieldName('name'),
        ];
    }
}
