<?php

namespace App\Filament\Resources\CatagoriesResource\Pages;

use App\Filament\Resources\CatagoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCatagories extends CreateRecord
{
    protected static string $resource = CatagoriesResource::class;
    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.catagories.index');
    }
}
