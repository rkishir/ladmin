<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Http\Livewire\Base;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use App\Models\Roles\Role;
use App\Models\Roles\RoleUser;


use function add_user_log;
use function flash;
use function view;

class AddUser extends Base
{


    public $name = '';
    public $email = '';
    public $password  = '';
    public $confirmPassword = '';
    public $rolesSelected = [];


    public function render()
    {
        $roles = Role::orderby('name')->get();
        return view('livewire.admin.users.add-user', compact('roles'));
    }

    // Validation
    protected function rules(): array
    {
        return [
            'name'            => 'required',
            'email'           => 'required|email|unique:users,email',
            'password'     => [
                'required',
                Password::min(16)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->uncompromised()
            ],
            'confirmPassword' => 'required|same:password',
        ];
    }
    // Validation Messages
    protected array $messages = [
        'name.required' => 'Name is required',
        'password.required'        => 'Password is required TO ENTER',
        'password.uncompromised'   => 'The given new password has appeared in a data leak by https://haveibeenpwned.com please choose a different new password. ',
        'confirmPassword.required' => 'Confirm password is required',
        'confirmPassword.same'     => 'Confirm password and new password must match',
    ];
    // Need to check why?
    /**
     * @throws ValidationException
     */

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }
    public function store(): void
    {
        $this->validate();


        // Prepare Model Data
        $user = User::create([
            'name'                 => $this->name,
            'slug'                 => Str::slug($this->name),
            'email'                => $this->email,
            'password'             => bcrypt($this->password),
            'is_active'            => 1,
            'is_office_login_only' => 0,
        ]);
        //generate image
        $name      = get_initials($user->name);
        $id        = $user->id . '.png';
        $path      = 'users/';
        $imagePath = create_avatar($name, $id, $path);

        //save image
        $user->image = $imagePath;
        $user->save();
        // Assign Role
        foreach ($this->rolesSelected as $role_id) {
            RoleUser::create([
                'role_id' => $role_id,
                'user_id' => $user->id
            ]);
        }

        /// Enter to log
        add_user_log([
            'title'        => "UserAdded " . $user->name,
            'reference_id' => $user->id,
            'section'      => 'Auth',
            'type'         => 'Added'
        ]);
        flash('User Added successfully.')->success();
        $this->reset();
    }
}
