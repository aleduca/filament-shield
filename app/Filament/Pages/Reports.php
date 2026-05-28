<?php

namespace App\Filament\Pages;

use BackedEnum;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class Reports extends Page
{
	use HasPageShield;
	protected string $view = 'filament.pages.reports';

	protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentCheck;

	protected static ?string $navigationLabel = 'Reports';

	protected static ?int $navigationSort = 3;

	public function export()
	{
		$this->authorize('Export:User');
		dd('export user');
	}

	// public static function canAccess(): bool
	// {
	// 	return Auth::user()->hasRole(['super_admin', 'Editor']);
	// }
}
