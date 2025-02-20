<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeTransportasiResource\Pages;
use App\Filament\Resources\TypeTransportasiResource\RelationManagers;
use App\Models\TypeTransportasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn; 
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Actions\Exceptions\Halt;

class TypeTransportasiResource extends Resource
{
    protected static ?string $model = TypeTransportasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';
    protected static ?string $navigationGroup = 'Transportasi';  

    protected static ?string $label = 'Type Transportasi';
    protected static ?string $pluralLabel = 'Type Transportasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_type')
                ->label('Type')
                ->required()
                ->maxLength(50),
                Textarea::make('keterangan')
                ->label('Keterangan')
                ->required()
                ->maxLength(255),
            ]);
    }
 
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_type_transportasi')
                ->label('ID Type Transportasi')
                ->searchable(),
                TextColumn::make('nama_type')
                ->label('Type')
                ->searchable(),
                TextColumn::make('keterangan')->label('Keterangan')->wrap(),
                TextColumn::make('transportasi_count')
                    ->label('Jumlah Transportasi')
                    ->counts('transportasi')
                    ->color(fn (int $state): string => $state > 0 ? 'danger' : 'success')
                    ->description(fn (int $state): string => $state > 0 ? 'Tidak dapat dihapus' : 'Dapat dihapus'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalDescription(fn (TypeTransportasi $record) => 
                        $record->transportasi()->exists() 
                            ? "Tipe transportasi ini sedang digunakan oleh beberapa transportasi. Tidak dapat dihapus."
                            : "Apakah Anda yakin ingin menghapus tipe transportasi ini?"
                    )
                    ->modalSubmitActionLabel('Hapus')
                    ->modalCancelActionLabel('Batal')
                    ->hidden(fn (TypeTransportasi $record): bool => $record->transportasi()->exists())
                    ->before(function (TypeTransportasi $record) {
                        if ($record->transportasi()->exists()) {
                            $transportasiList = $record->transportasi()
                                ->pluck('keterangan')
                                ->join(', ');
                                
                            Notification::make()
                                ->danger()
                                ->title('Tidak Dapat Menghapus')
                                ->body("Tipe transportasi ini sedang digunakan oleh: {$transportasiList}")
                                ->persistent()
                                ->actions([
                                    \Filament\Notifications\Actions\Action::make('view')
                                        ->button()
                                        ->color(Color::Red)
                                        ->label('Lihat Detail')
                                        ->url(route('filament.admin.resources.transportasis.index'))
                                ])
                                ->send();

                            return false;
                        }
                        return true;
                    })
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Berhasil')
                            ->body('Type transportasi berhasil dihapus.')
                            ->duration(5000)
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalDescription('Apakah Anda yakin ingin menghapus tipe transportasi yang dipilih?')
                        ->modalSubmitActionLabel('Hapus Semua')
                        ->modalCancelActionLabel('Batal')
                        ->deselectRecordsAfterCompletion()
                        ->before(function (Collection $records) {
                            foreach ($records as $record) {
                                if ($record->transportasi()->exists()) {
                                    $transportasiList = $record->transportasi()
                                        ->pluck('keterangan')
                                        ->join(', ');

                                    Notification::make()
                                        ->danger()
                                        ->title('Tidak Dapat Menghapus')
                                        ->body("Beberapa tipe transportasi masih digunakan oleh: {$transportasiList}")
                                        ->persistent()
                                        ->actions([
                                            \Filament\Notifications\Actions\Action::make('view')
                                                ->button()
                                                ->color(Color::Red)
                                                ->label('Lihat Detail')
                                                ->url(route('filament.admin.resources.transportasis.index'))
                                        ])
                                        ->send();

                                    return false;
                                }
                            }
                            return true;
                        })
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Berhasil')
                                ->body('Type transportasi yang dipilih berhasil dihapus.')
                                ->duration(5000)
                        ),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTypeTransportasi::route('/'),
            'create' => Pages\CreateTypeTransportasi::route('/create'),
            'edit' => Pages\EditTypeTransportasi::route('/{record}/edit'),
        ];
    }
}
