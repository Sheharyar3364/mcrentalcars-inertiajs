<?php

namespace App\Filament\Resources\Users\Tables\Actions;

use Filament\Actions\Action;
use Filament\Notifications\Notification;

class VerifyUserAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'verify';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Verify User')
            ->icon('heroicon-o-check-badge')
            ->color('success')
            ->requiresConfirmation()
            ->visible(fn($record): bool => $record->email_verified_at === null)
            ->action(function ($record) {
                $record->update(['email_verified_at' => now()]);

                Notification::make()
                    ->title('User Verified')
                    ->success()
                    ->send();
            });
    }
}
