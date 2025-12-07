<?php

namespace App\Livewire\Admin\AuditLogs;

use App\Models\AuditLog;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User; // To filter by user

class AuditLogLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $filterByUser = '';
    public $filterByAction = '';
    public $filterByTable = '';
    public $filterByDate = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterByUser' => ['except' => ''],
        'filterByAction' => ['except' => ''],
        'filterByTable' => ['except' => ''],
        'filterByDate' => ['except' => ''],
    ];

    public function updated($propertyName)
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = AuditLog::with('user')
            ->when($this->search, function ($query) {
                $query->where('action', 'like', '%' . $this->search . '%')
                      ->orWhere('table_name', 'like', '%' . $this->search . '%')
                      ->orWhere('record_id', 'like', '%' . $this->search . '%')
                      ->orWhere('details', 'like', '%' . $this->search . '%')
                      ->orWhereHas('user', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');
                      });
            })
            ->when($this->filterByUser, function ($query) {
                $query->where('user_id', $this->filterByUser);
            })
            ->when($this->filterByAction, function ($query) {
                $query->where('action', $this->filterByAction);
            })
            ->when($this->filterByTable, function ($query) {
                $query->where('table_name', $this->filterByTable);
            })
            ->when($this->filterByDate, function ($query) {
                $query->whereDate('created_at', $this->filterByDate);
            })
            ->latest();

        $auditLogs = $query->paginate(10);

        // Get distinct values for filters
        $users = User::orderBy('name')->get();
        $actions = AuditLog::select('action')->distinct()->pluck('action');
        $tableNames = AuditLog::select('table_name')->distinct()->pluck('table_name');

        return view('livewire.admin.audit-logs.audit-log-livewire', [
            'auditLogs' => $auditLogs,
            'users' => $users,
            'actions' => $actions,
            'tableNames' => $tableNames,
        ]);
    }
}