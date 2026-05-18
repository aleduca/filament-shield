<?php

namespace App\Filament\Widgets;

use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class LatestUsers extends TableWidget
{
	use HasWidgetShield;
	protected static ?string $heading = 'Latest Users';

	protected static bool $isDiscovered = false;

	// public static function canView(): bool
	// {
	// 	return Auth::user()->hasRole('super_admin');
	// }

	public function table(Table $table): Table
	{
		return $table
			->query(fn (): Builder => User::query()
					->limit(5)
					->withCount('posts'))
			->columns([
				TextColumn::make('id')->label('ID'),

				TextColumn::make('name')
					->label('Usuário')
					->limit(10)
					->tooltip(fn ($record) => $record->name),

				TextColumn::make('roles.name')
					->badge()
					->default('No role')
					->label('Role')
					->color(
						fn ($state) => $state === 'No role'
							? 'gray'
							: 'success'
					),

				TextColumn::make('posts_count')
					->label('Posts')
					->badge(),
			])
			->paginated(false)
			->filters([
				//
			])
			->headerActions([
				//
			])
			->recordActions([
				//
			])
			->toolbarActions([
				BulkActionGroup::make([
					//
				]),
			]);
	}
}
