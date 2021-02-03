<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class AlbumCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Album::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
//            $id = IdField::new('id'),
            $name = TextField::new('name'),
            $artist = TextField::new('artist'),
            $description = TextEditorField::new('description'),
            $image = ImageField::new('image')->setUploadDir('public/images'),
            $release_date = DateField::new('release_date'),
            $code = IntegerField::new('code'),
            $public = BooleanField::new('public'),
            $cid = IntegerField::new('cid'),
        ];
    }
}
