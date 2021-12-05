<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ListUsers extends Component
{
    public $state = [];


    public function storeUser()
    {
        $data = Validator::make($this->state, [
            'name'      => ['required'],
            'email'     => ['required', 'email', 'unique:users'],
            'password'  => ['required', 'confirmed'],
        ])->validate();

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User created successfully!']);

//        session()->flash('message', 'User created successfully!'); //stò usando toastr, quindi non mi serve più

        return redirect()->back();
    }

    public function addNew()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function render()
    {
        $users = User::latest()->paginate();
        return view('livewire.admin.users.list-users', compact('users'));
    }
}
