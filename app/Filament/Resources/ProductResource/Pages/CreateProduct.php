<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    // Get the redirect URL after creating a product
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
