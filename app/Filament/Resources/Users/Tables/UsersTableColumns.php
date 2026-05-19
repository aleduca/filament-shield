<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Tables\Columns\PercentPostsColumn;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ToggleColumn;

class UsersTableColumns
{
	public static function make($totalPosts)
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
			TextColumn::make('posts_count')->label('Posts')->icon(Heroicon::ClipboardDocumentList),
			TextColumn::make('created_at')->label('Created')->dateTime('d/m/Y')->toggleable(isToggledHiddenByDefault:true)->alignCenter(),
			TextColumn::make('updated_at')->label('Updated')->dateTime('d/m/Y')->toggleable(isToggledHiddenByDefault:true),

		];
	}
}
