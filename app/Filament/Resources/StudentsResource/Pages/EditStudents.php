<?php

namespace App\Filament\Resources\StudentsResource\Pages;

use App\Filament\Resources\StudentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStudents extends EditRecord
{
    protected static string $resource = StudentsResource::class;

    // protected function getHeaderActions(): array
    // {
    //     // return [
    //     //     Actions\DeleteAction::make(),
    //     // ];
    // }/

    // Redirecting students list page after edit
    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.students.index');
    }
}
