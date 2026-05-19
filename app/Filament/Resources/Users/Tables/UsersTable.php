<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Resources\Users\Tables\Actions\DeleteUserAction;
use App\Filament\Resources\Users\Tables\Actions\EditUserAction;
use App\Filament\Resources\Users\Tables\Actions\UserBulkDeleteAction;
use App\Filament\Resources\Users\Tables\Actions\ViewUserAction;
use App\Filament\Resources\Users\Tables\UsersTableColumns;
use App\Filament\Resources\Users\Tables\UsersTableFilters;
use App\Models\Post;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class UsersTable
{
	public static function configure(Table $table): Table
	{
		return $table
			->columns(UsersTableColumns::make())->deferColumnManager(false)
			->filters(UsersTableFilters::make(), layout: FiltersLayout::AboveContent)->deferFilters(false)
			->recordActions([
				ViewAction::make(),
				DeleteAction::make(),
			])
			->toolbarActions([
				BulkActionGroup::make([
					UserBulkDeleteAction::make(),
				]),
			]);
	}
}
