<?php

namespace App\Livewire\Users;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class LivewireUsers extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];
    public $search;
    public $user;
    public $folder = 'all';

    //form
    public $name, $email, $gender, $role, $password, $status, $slug;

    /**
     * dev by Techlink360
     * The roles that can be assigned to a user.
     *
     * @var array
     */
    public $allRoles = ['system', 'owner', 'seller'];

    /**
     * dev by Techlink30
     * Returns the available roles.
     *
     * @return array
     */
    public function getRolesProperty()
    {
        return $this->allRoles;
    }

    /**
     * dev by Techlink360
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $this->reset(['name', 'email', 'gender', 'role', 'password', 'status', 'slug']);
        $this->folder = 'create';
        $this->password = "AA123";
        $this->status = true; // Default status to active
    }

    /**
     * dev by Techlink360
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required|string',
            'role' => 'required|string',
            'status' => 'boolean',
        ]);

        $u = new User();
        $u->name = $this->name;
        $u->slug = Str::slug($this->name);
        $u->email = $this->email;
        $u->role = $this->role;
        $u->gender = $this->gender;
        $u->status = $this->status;
        $u->password = Hash::make($this->password);
        $u->save();

        AuditLog::create([
            'action' => 'store',
            'table_name' => 'users',
            'record_id' => $u->id,
            'user_id' => auth()->id(),
        ]);

        $this->reset(['name', 'email', 'gender', 'role', 'status', 'slug', 'folder']);
        $this->alert('success', 'User successfully added!');
    }

    /**
     * dev by Techlink360
     * Activate a user.
     *
     * @param  int  $id
     * @return void
     */
    public function activate($id)
    {
        $u = User::find($id);
        $u->status = true;
        $u->save();
        AuditLog::create([
            'action' => 'activate',
            'table_name' => 'users',
            'record_id' => $id,
            'user_id' => auth()->id(),
        ]);
        $this->alert('success', 'successfully activated');
    }

    /**
     * dev by Techlink360
     * Deactivate a user.
     *
     * @param  int  $id
     * @return void
     */
    public function deactivate($id)
    {

        $u = User::find($id);
        $u->status = false;
        $u->save();
        AuditLog::create([
            'action' => 'deactivate',
            'table_name' => 'users',
            'record_id' => $id,
            'user_id' => auth()->id(),
        ]);
        $this->alert('success', 'successfully deactivated');
    }

    

    /**
     * dev by Techlink360
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function edit($id)
    {
        $this->user = User::find($id);

        $this->folder = 'edit';
        $this->name = $this->user->name;
        $this->slug = $this->user->slug;
        $this->email = $this->user->email;
        $this->role = $this->user->role;
        $this->gender = $this->user->gender;
        $this->status = $this->user->status;
        $this->password = '';
    }

    /**
     * dev by Techlink360
     * Cancel the current action and reset the form.
     *
     * @return void
     */
    public function cancel()
    {
        $this->reset();
    }

    /**
     * dev by Techlink360
     * Update the specified resource in storage.
     *
     * @return void
     */
    public function update()
    {

        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'role' => 'required|string',
            'gender' => 'required',
            'status' => 'boolean',
            'password' => 'nullable|string',
        ]);

        $this->user->name = $this->name;
        $this->user->slug = Str::slug($this->name);
        $this->user->email = $this->email;
        $this->user->role = $this->role;
        $this->user->gender = $this->gender;
        $this->user->status = $this->status;
        if ($this->password) {
            $this->user->password = Hash::make($this->password);
        }
        $this->user->save();

        AuditLog::create([
            'action' => 'update',
            'table_name' => 'users',
            'record_id' => $this->user->id,
            'user_id' => auth()->id(),
        ]);

        $this->alert('success', 'Updated');
    }

    /**
     * dev by Techlink360
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return void
     */
    public function delete($id)
    {
        $u = User::find($id);
        $u->delete();
        AuditLog::create([
            'action' => 'delete',
            'table_name' => 'users',
            'record_id' => $id,
            'user_id' => auth()->id(),
        ]);
        $this->alert('success', 'User successfully deleted!');
    }

    /**
     * dev by Techlink360
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('role', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('status', 'like', '%' . $this->search . '%')
            ->paginate(5);

        return view('livewire.users.livewire-users', [
            'u' => $users,
            'allRoles' => $this->allRoles, // dev by Techlink360: Pass all roles to the view
        ]);
    }
}

