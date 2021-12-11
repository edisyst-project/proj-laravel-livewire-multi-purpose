<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class ListUsers extends AdminComponent
{
    use WithFileUploads;

    public $state = [];
    public $showEditModal = false;
    public $user;
    public $userIdBeingRemoved = null;
    public $searchTerm = null;
    public $photo;


    public function changeRole(User $user, $role)
    {
        Validator::make(['role' => $role], [
//            'role' =>'required|in:admin,user'
            'role' => [
                'required',
                Rule::in(User::ROLE_ADMIN, User::ROLE_USER),
            ],
        ])->validate();

        $user->update(['role' => $role]);

        $this->dispatchBrowserEvent('updated', ['message' => "Role changed to {$role} successfully!"]);
    }

    public function storeUser()
    {
        $data = Validator::make($this->state, [
            'name'      => ['required'],
            'email'     => ['required', 'email', 'unique:users'],
            'password'  => ['required', 'confirmed'],
        ])->validate();

        $data['password'] = bcrypt($data['password']);

        if ($this->photo){
            $data['avatar'] = $this->photo->store('/', 'avatars');
        }

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

        if ($this->photo){
            Storage::disk('avatars')->delete($this->user->avatar);
            $data['avatar'] = $this->photo->store('/', 'avatars');
        }

        $this->user->update($data);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);
    }


    public function deleteUser()
    {
        $user = User::findOrFail($this->userIdBeingRemoved);

        $user->delete();

        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'User deleted successfully!']);
    }



    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false;

        $this->dispatchBrowserEvent('show-form');
    }


    public function edit(User $user)
    {
        $this->reset();
        $this->showEditModal = true;
        $this->user = $user;
        $this->state = $user->toArray();

        $this->dispatchBrowserEvent('show-form');
    }


    public function confirmDelete(User $user)
    {
        $this->userIdBeingRemoved = $user->id;

        $this->dispatchBrowserEvent('show-delete-modal');
    }


    public function render()
    {
        $users = User::query()
            ->where('name', 'like', '%' .$this->searchTerm. '%')
            ->orWhere('email', 'like', '%' .$this->searchTerm. '%')
            ->latest()
            ->paginate(5);

        return view('livewire.admin.users.list-users', compact('users'));
    }
}
