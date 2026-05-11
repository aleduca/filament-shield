<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Reports extends Page
{
	protected string $view = 'filament.pages.reports';

	protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentCheck;

	protected static ?string $navigationLabel = 'Reports';

	protected static ?int $navigationSort = 3;
}
