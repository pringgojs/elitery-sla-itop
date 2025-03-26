<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class UserForm extends Form
{
    public $id = ''; // digunakan untuk edit

    // #[Validate('required|max:250')]
    public $name = '';

    // #[Validate('required|max:250')]
    public $username = '';

    // #[Validate('required|max:250')]
    public $domain = '';

    // #[Validate('required|string|email')]
    public $email = '';

    // #[Validate('required|string|min:6')]
    public $password = '';

    // #[Validate('required_with:password|same:password|min:6')]
    // public $repassword = '';

    // #[Validate('required')]
    public $role;

    public $is_create_cpanel_account = false;

    public $is_create_db_account = false;

    /* database */
    public $database = '';

    public $database_username = '';

    public $database_password = '';
    // public $database_repassword = '';

    public $user;

    public function rules()
    {
        return [
            'name' => 'required|max:250',
            'username' => 'required|max:16',
            // 'domain' => $this->user || !$this->is_create_cpanel_account ? 'nullable' : 'required|max:40',
            'role' => 'required',
            'password' => $this->user ? 'nullable' : 'required|string|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/',
            // 'repassword' => !$this->password ? 'nullable' : 'required_with:password|same:password|min:6',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore($this->user),
            ],
            // 'database' => $this->database ? 'string|max:40' : 'nullable',
            // 'database_username' => !$this->is_create_db_account ? 'nullable' : 'required|max:50',
            // 'database_password' => !$this->database_username || !$this->is_create_db_account? 'nullable' : 'required|string|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/',
            // 'database_repassword' => !$this->database_password || !$this->is_create_db_account ? 'nullable' : 'required_with:database_password|same:database_password',
        ];

    }

    public function messages()
    {
        $password_message = 'must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.';

        return [
            'password.regex' => 'The :attribute '.$password_message,
            'database_password.regex' => 'The :attribute '.$password_message,
        ];
    }

    public function store()
    {
        $this->validate();

        $payload = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
        ];

        /* jika password terisi, maka masukkan ke proses simpan */
        if ($this->password) {
            $payload['password'] = bcrypt($this->password);
        }

        /* proses simpan */
        $user = User::updateOrCreate([
            'id' => $this->id,
        ], $payload);

        $role = Role::find($this->role);
        $user->syncRoles($role);

        return $user;
    }

    public function setModel(User $user)
    {
        $this->user = $user; // untuk validasi email unique

        $this->id = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->domain = $user->domain;
        $this->email = $user->email;
        $this->role = $user->roles->first()->id;
    }
}
