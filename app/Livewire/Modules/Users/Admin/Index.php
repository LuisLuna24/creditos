<?php

namespace App\Livewire\Modules\Users\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $perEstatus, $perPage = '10', $search;
    public function render()
    {
        $collection = User::query();

        if ($this->perEstatus) {
            switch ($this->perEstatus) {
                case '1':
                    $collection = $collection->where('estatus', '1');
                    break;
                case '2':
                    $collection = $collection->where('estatus', '0');
                    break;
            }
        }

        $collection = $collection->where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        });

        $collection = $collection->orderBy('created_at','desc')->paginate($this->perPage, pageName: "collection-page");
        return view(
            'livewire.modules.users.admin.index',
            ['collection' => $collection]
        );
    }
}
