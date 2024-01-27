<?php
declare(strict_types=1);

namespace App\Subsidiary\Infrastructure\Controller;

use App\Relation\Domain\Entity\Relation;
use App\Subsidiary\Domain\Entity\Subsidiary;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SubsidiaryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Subsidiary::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
