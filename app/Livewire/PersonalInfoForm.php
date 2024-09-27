<?php

namespace App\Livewire;

use Filament\Forms;
use Jeffgreco13\FilamentBreezy\Livewire\PersonalInfo;

class PersonalInfoForm extends PersonalInfo
{
    public array $only = ['name', 'email', 'locale'];

    protected function getProfileFormSchema()
    {
        $groupFields = Forms\Components\Group::make([
            $this->getNameComponent(),
            $this->getEmailComponent(),
            $this->getLocaleComponent(),
        ])->columnSpan(2);

        return ($this->hasAvatars)
            ? [filament('filament-breezy')->getAvatarUploadComponent(), $groupFields]
            : [$groupFields];
    }

    protected function getLocaleComponent(): Forms\Components\Select
    {
        return Forms\Components\Select::make('locale')
            ->options([
                'en' => 'English',
                'de' => 'Deutsch',
            ])
            ->selectablePlaceholder(false)
            ->required()
            ->label(__('Language'));;
    }

    public function submit(): void
    {
        $locale = $this->form->getState()['locale'] ?? null;

        if (!in_array($locale, config('app.available_locales'))) {
            abort(404);
        }

        session(['locale' => $locale]);
        app()->setLocale($locale);

        parent::submit();
    }
}
