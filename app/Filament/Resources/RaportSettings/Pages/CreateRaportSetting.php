<?php

namespace App\Filament\Resources\RaportSettings\Pages;

use App\Filament\Resources\RaportSettings\RaportSettingResource;
use App\Models\RaportSetting;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Exceptions\Halt;

class CreateRaportSetting extends CreateRecord
{
    protected static string $resource = RaportSettingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Cek jika status yang diinput adalah 'aktif'
        if ($data['status'] === 'aktif') {
            $isAlreadyActive = RaportSetting::where('status', 'aktif')->exists();

            if ($isAlreadyActive) {
                // Tampilkan notifikasi gagal di pojok kanan atas ala Filament
                Notification::make()
                    ->title('Gagal Membuat Data')
                    ->body('Sudah ada pengaturan rapor yang berstatus aktif saat ini.')
                    ->danger()
                    ->send();

                // Hentikan proses pembuatan data
                throw new Halt();
            }
        }

        return $data;
    }
}
