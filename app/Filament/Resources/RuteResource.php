<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RuteResource\Pages;
use App\Filament\Resources\RuteResource\RelationManagers;
use App\Models\Rute;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TimePicker;
use Carbon\Carbon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;

class RuteResource extends Resource
{
    protected static ?string $model = Rute::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';
    protected static ?string $navigationGroup = 'Transportasi';     
       protected static ?string $label = 'Rute';
       protected static ?string $pluralLabel = 'Rute';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('tujuan')
                    ->label('Tujuan')
                    ->required() 
                    ->maxLength(255),
                TextInput::make('rute_awal')
                    ->label('Rute Awal')
                    ->required() 
                    ->maxLength(255),            
                TextInput::make('rute_akhir')
                    ->label('Rute Akhir')
                    ->required() 
                    ->maxLength(255),           
                FileUpload::make('gambar')
                    ->label('Gambar Rute')
                    ->image()
                    ->directory('rute-images')
                    ->preserveFilenames()
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                    ->disk('public')
                    ->downloadable()
                    ->openable()
                    ->previewable()
                    ->imageEditor()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080'),
                TextInput::make('harga')
                    ->label('Harga Dasar')
                    ->required() 
                    ->numeric()
                    ->prefix('Rp')
                    ->reactive()
                    ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                        $classId = $get('id_class');
                        if ($classId) {
                            $class = \App\Models\ClassModel::find($classId);
                            if ($class) {
                                $set('total_harga', intval($state) + intval($class->harga_tambahan));
                            }
                        }
                    }),
                Select::make('id_class')
                    ->relationship('class', 'nama_class')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                        if ($state) {
                            $class = \App\Models\ClassModel::find($state);
                            if ($class) {
                                $hargaDasar = intval($get('harga') ?? 0);
                                $set('total_harga', $hargaDasar + intval($class->harga_tambahan));
                            }
                        }
                    }),
                TextInput::make('total_harga')
                    ->label('Total Harga')
                    ->disabled()
                    ->dehydrated(true)
                    ->prefix('Rp'),
                Select::make('id_transportasi')
                    ->label('Transportasi')
                    ->relationship('transportasi', 'kode')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        if ($state) {
                            $transportasi = \App\Models\Transportasi::find($state);
                            if ($transportasi) {
                                $set('jumlah_kursi', $transportasi->jumlah_kursi);
                                $set('kursi_tersedia', $transportasi->jumlah_kursi);
                            }
                        }
                    }),
                TextInput::make('jumlah_kursi')
                    ->label('Total Kursi')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(1000)
                    ->reactive()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        $set('kursi_tersedia', $state);
                    })
                    ->default(0),
                TextInput::make('kursi_tersedia')
                    ->label('Kursi Tersedia')
                    ->disabled()
                    ->dehydrated(true)
                    ->numeric(),
                DatePicker::make('tanggal_berangkat')
                    ->label('Tanggal Berangkat')
                    ->required()
                    ->format('Y-m-d'),
                TimePicker::make('waktu_berangkat')
                    ->label('Waktu Berangkat')
                    ->required()
                    ->format('H:i:s'),
                TimePicker::make('waktu_tiba')
                    ->label('Waktu Tiba')
                    ->required()
                    ->format('H:i:s'),
            ]);
    }
  
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_rute')
                    ->label('ID')
                    ->searchable(),
                TextColumn::make('tujuan')
                    ->label('Tujuan')
                    ->searchable(),
                TextColumn::make('rute_awal')
                    ->label('Rute Awal')
                    ->searchable(),             
                TextColumn::make('rute_akhir')
                    ->label('Rute Akhir')
                    ->searchable(),             
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->circular(),
                TextColumn::make('transportasi.kode')
                    ->label('Transportasi')
                    ->searchable(),
                TextColumn::make('jumlah_kursi')
                    ->label('Total Kursi')
                    ->numeric()
                    ->alignCenter(),
                TextColumn::make('kursi_tersedia')
                    ->label('Kursi Tersedia')
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->color(fn ($state): string => $state > 0 ? 'success' : 'danger'),
                TextColumn::make('harga')
                    ->label('Harga Dasar')
                    ->money('idr'),   
                TextColumn::make('class.harga_tambahan')
                    ->label('Harga Tambahan Kelas')
                    ->money('idr'),
                TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->money('idr')
                    ->sortable(),
                TextColumn::make('tanggal_berangkat')
                    ->label('Tanggal Berangkat')
                    ->date(),
                TextColumn::make('waktu_berangkat')
                    ->label('Waktu Berangkat')
                    ->time(),
                TextColumn::make('waktu_tiba')
                    ->label('Waktu Tiba')
                    ->time(),
                TextColumn::make('class.nama_class')
                    ->label('Kelas')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRutes::route('/'),
            'create' => Pages\CreateRute::route('/create'),
            'edit' => Pages\EditRute::route('/{record}/edit'),
        ];
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $class = \App\Models\ClassModel::find($data['id_class']);
        if ($class) {
            $data['total_harga'] = intval($data['harga']) + intval($class->harga_tambahan);
        } else {
            $data['total_harga'] = $data['harga'];
        }
        return $data;
    }

    public static function mutateFormDataBeforeUpdate(array $data): array
    {
        $class = \App\Models\ClassModel::find($data['id_class']);
        if ($class) {
            $data['total_harga'] = intval($data['harga']) + intval($class->harga_tambahan);
        } else {
            $data['total_harga'] = $data['harga'];
        }
        return $data;
    }
}
