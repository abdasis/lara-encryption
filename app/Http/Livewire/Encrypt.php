<?php

namespace App\Http\Livewire;

use App\Helpers\EncryptionUtil;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Encrypt extends Component
{
    public $password;
    public $password_decrypt;
    public $private_key;

    public function rules()
    {
        return [
            'password' => 'required',
            'private_key' => 'required',
        ];
    }

    public function submit()
    {
        $this->validate();

        if (Hash::check($this->password, auth()->user()->password)) {
            $encryptedData = EncryptionUtil::encryptData($this->private_key, $this->password);
        } else {
            dd('Password yang dimasukan tidak benar');
        }

        \App\Models\Encrypt::create([
            'private_key' => $encryptedData
        ]);
    }

    public function decrypt($id)
    {
        if (Hash::check($this->password_decrypt, auth()->user()->password)) {
            $encrypt = \App\Models\Encrypt::find($id);
            $decrypt = EncryptionUtil::decryptData($encrypt->private_key, $this->password_decrypt);
            dd($decrypt);
        } else {
            dd('Password yang dimasukan tidak benar');
        }
    }

    public function render()
    {
        $encrypts = \App\Models\Encrypt::latest()->get();
        return view('livewire.encrypt', [
            'encrypts' => $encrypts
        ]);
    }
}
