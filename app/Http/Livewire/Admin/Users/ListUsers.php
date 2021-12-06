<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ListUsers extends Component
{
    public $state = [];
    public $showEditModal = false;
    public $user;


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
    }


    public function updateUser()
    {
        $data = Validator::make($this->state, [
            'name'      => ['required'],
//            'email'     => ['required', 'email', 'unique:users,email,' . $this->user->id],
            'email'     => 'required|email|unique:users,email,' . $this->user->id,
            'password'  => ['sometimes', 'confirmed'],
        ])->validate();

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $this->user->update($data);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);
    }


    public function addNew()
    {
        $this->showEditModal = false;

        $this->dispatchBrowserEvent('show-form');
    }


    public function edit(User $user)
    {
        $this->showEditModal = true;
        $this->user = $user;
        $this->state = $user->toArray();

        $this->dispatchBrowserEvent('show-form');
    }


    public function render()
    {
        $users = User::latest()->paginate();

        return view('livewire.admin.users.list-users', compact('users'));
    }
}
