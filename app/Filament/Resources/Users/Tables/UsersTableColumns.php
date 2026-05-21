<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;

class UsersTableColumns
{
	public static function make()
	{
		return [
			TextColumn::make('name')->sortable()->searchable(),
			TextColumn::make('email')
			->tooltip(fn ($record) => $record->email)
			->limit(10)->sortable()->searchable(),
			TextColumn::make('roles.name')
				->badge()
				->default('No role')
				->label('Roles')
				->color(
					fn ($state) => $state === 'No role'
						? 'gray'
						: 'success'
				),
			TextColumn::make('permissions.name')
			->badge()
			->default(0)
			->label('Permissions')
			->tooltip(fn ($record) => $record->getPermissionNames()->map(fn ($permission) => $permission))
			->color(
				fn ($state) => $state === 0
					? 'gray'
					: 'warning'
			)->getStateUsing(fn ($record) => $record->getPermissionNames()->count()),
			TextColumn::make('posts_count')->label('Posts')->icon(Heroicon::ClipboardDocumentList),
			TextColumn::make('created_at')->label('Created')->dateTime('d/m/Y')->toggleable(isToggledHiddenByDefault:true)->alignCenter(),
			TextColumn::make('updated_at')->label('Updated')->dateTime('d/m/Y')->toggleable(isToggledHiddenByDefault:true),

		];
	}
}
