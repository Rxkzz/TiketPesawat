<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemesananResource\Pages;
use App\Models\Pemesanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;

class PemesananResource extends Resource
{
    protected static ?string $model = Pemesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Pemesanan';
    protected static ?string $modelLabel = 'Pemesanan';
    protected static ?string $pluralModelLabel = 'Pemesanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_pemesanan')
                    ->label('Kode Pemesanan')
                    ->disabled(),
                DatePicker::make('tanggal_pemesanan')
                    ->label('Tanggal Pemesanan')
                    ->disabled(),
                TextInput::make('nama_penumpang')
                    ->label('Nama Penumpang')
                    ->disabled(),
                TextInput::make('nomor_identitas')
                    ->label('Nomor Identitas')
                    ->disabled(),
                TextInput::make('email')
                    ->label('Email')
                    ->disabled(),
                TextInput::make('nomor_telepon')
                    ->label('Nomor Telepon')
                    ->disabled(),
                TextInput::make('total_bayar')
                    ->label('Total Bayar')
                    ->disabled(),
                Select::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->options([
                        'PENDING' => 'Pending',
                        'WAITING_CONFIRMATION' => 'Menunggu Konfirmasi',
                        'PAID' => 'Lunas'
                    ])
                    ->disabled(fn () => !auth()->user()->hasAnyRole(['admin', 'petugas'])),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_pemesanan')
                    ->label('Kode Pemesanan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama_penumpang')
                    ->label('Nama Penumpang')
                    ->searchable(),
                TextColumn::make('total_bayar')
                    ->label('Total Bayar')
                    ->money('idr')
                    ->sortable(),
                TextColumn::make('status_pembayaran')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'PAID' => 'success',
                        'WAITING_CONFIRMATION' => 'warning',
                        'PENDING' => 'danger',
                    }),
                Tables\Columns\ImageColumn::make('payment_proof')
                    ->label('Bukti Pembayaran')
                    ->disk('public'),
                TextColumn::make('petugas.name')
                    ->label('Diverifikasi Oleh')
                    ->default('-'),
            ])
            ->actions([
                Action::make('verify_payment')
                    ->label('Verifikasi Pembayaran')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Pemesanan $record): bool => 
                        $record->status_pembayaran === 'WAITING_CONFIRMATION' && 
                        auth()->user()->hasAnyRole(['admin', 'petugas'])
                    )
                    ->action(function (Pemesanan $record): void {
                        $record->update([
                            'status_pembayaran' => 'PAID',
                            'id_petugas' => auth()->id()
                        ]);
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Verifikasi Pembayaran')
                    ->modalDescription('Apakah Anda yakin ingin memverifikasi pembayaran ini? Pastikan bukti pembayaran sudah valid.')
                    ->modalSubmitActionLabel('Ya, Verifikasi')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Berhasil')
                            ->body('Pembayaran berhasil diverifikasi')
                    ),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListPemesanan::route('/'),
            'view' => Pages\ViewPemesanan::route('/{record}'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status_pembayaran', 'WAITING_CONFIRMATION')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
} 