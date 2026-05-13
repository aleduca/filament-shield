<?php

namespace App\Filament\Resources\Roles;

use App\Filament\Resources\Roles\Pages\ListRoles;
use BezhanSalleh\FilamentShield\Resources\Roles\Pages\CreateRole;
use BezhanSalleh\FilamentShield\Resources\Roles\Pages\EditRole;
use BezhanSalleh\FilamentShield\Resources\Roles\Pages\ViewRole;
use BezhanSalleh\FilamentShield\Resources\Roles\RoleResource as RolesRoleResource;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class RoleResource extends RolesRoleResource
{
	public static function table(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('name')
					->weight(FontWeight::Medium)
					->label(__('filament-shield::filament-shield.column.name'))
					->formatStateUsing(fn (string $state): string => Str::headline($state))
					->searchable(),
				TextColumn::make('guard_name')
					->badge()
					->color('warning')
					->label(__('filament-shield::filament-shield.column.guard_name')),
				TextColumn::make('team.name')
					->default('Global')
					->badge()
					->color(fn (mixed $state): string => str($state)->contains('Global') ? 'gray' : 'primary')
					->label(__('filament-shield::filament-shield.column.team'))
					->searchable()
					->visible(fn (): bool => static::shield()->isCentralApp() && Utils::isTenancyEnabled()),
				TextColumn::make('permissions_count')
					->badge()
					->label(__('filament-shield::filament-shield.column.permissions'))
					->counts('permissions')
					->color('primary'),
				TextColumn::make('updated_at')
					->label(__('filament-shield::filament-shield.column.updated_at'))
					->dateTime(),
			])
			->filters([
				//
			])
			->recordActions([
				ViewAction::make(),
				EditAction::make(),
				DeleteAction::make(),
			])
			->toolbarActions([
				DeleteBulkAction::make(),
			]);
	}

	public static function getPages(): array
	{
		return [
			'index' => ListRoles::route('/'),
			'create' => CreateRole::route('/create'),
			'view' => ViewRole::route('/{record}'),
			'edit' => EditRole::route('/{record}/edit'),
		];
	}
}
