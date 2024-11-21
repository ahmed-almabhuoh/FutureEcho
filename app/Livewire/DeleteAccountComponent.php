<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class DeleteAccountComponent extends Component
{
    public $signature;

    public function mount() {}

    public function rules(): array
    {
        return [
            'signature' => 'required|string|in:I ware about the when delete my account I cannot access to my content.,أنا على علم أنني بعد عملية حذف الحساب لن أستطيع الوصول الى محتوى حسابي',
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'signature' => 'agreement',
        ];
    }

    public function close() {}

    public function deleteAccount()
    {
        $this->validate();

        User::where('id', auth()->id())->delete();
        return redirect(route('login'));
    }

    public function cancel()
    {
        return redirect(route('memories'));
    }

    public function render()
    {
        return view('livewire.delete-account-component')->title('Future Echo - Delete Account');
    }
}
