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
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Override;

class LatestUsers extends TableWidget
{
	use HasWidgetShield;
	// protected static ?string $heading = 'Usuários Recentes';

	// protected int|string|array $columnSpan = 'full';

	protected static bool $isDiscovered = false;

	// public static function canView(): bool
	// {
	// 	return Auth::user()->hasRole(['super_admin']);
	// }

	protected function getColumns(): int | array | null
	{
		return 4;
	}

	#[Override]
	protected function getTableHeading(): string|Htmlable|null
	{
		return 'Usuários Recentes';
	}

	public function table(Table $table): Table
	{
		return $table
			->query(fn (): Builder => User::query()->latest()
					->with('roles')
					->withCount('posts'))
			->columns([
				TextColumn::make('name')
					->label('Usuário')
					->limit(10)
					->sortable()
					->tooltip(fn ($record) => $record->name)
					->searchable(),

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
					->sortable()
					->label('Posts')
					->badge()
					->color('success'),
			])
			->defaultPaginationPageOption(5) // Por página
			->filters([
				//
			])
			->headerActions([
				//
			])
			->recordActions([
				DeleteAction::make(),
			])
			->toolbarActions([
				BulkActionGroup::make([
					DeleteBulkAction::make(),
				]),
			]);
	}
}
