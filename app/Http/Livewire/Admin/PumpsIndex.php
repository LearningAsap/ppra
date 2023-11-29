<?php

namespace App\Http\Livewire\Admin;

use App\Models\Pump;
use App\Models\User;
use Livewire\Component;

class PumpsIndex extends Component
{
    protected $page_title = "Petrol Pumps Management System | G-Link | Petrol Pumps";
    protected $main_title = "Petrol Pumps";
    protected $breadcrumb_title = "Petrol Pumps";
    protected $selected_main_menu = "admin_petrol_pumps";
    protected $card_title;
    protected $selected_sub_menu;

    public $action;
    public $selectedItem;

    public $modelId;
    public $pump_name;
    public $owner_id;
    public $pump_address;


    protected $listeners = [
        'getModelId',
        'hideModal',
        'openModal',
        'closeModal',
        'refreshParent' => '$refresh',
        'selectItem' => 'selectItem'
    ];

    public function selectItem($item)
    {
        $itemId = $item[0];
        $action = $item[1];
        $this->selectedItem = $itemId;

        if ($action == 'delete') {
            // This will show the modal on the frontend
            $this->dispatchBrowserEvent('showDeleteModal');
        } else {
            $this->resetValidation();
            $this->emit('getModelId', $this->selectedItem);
            $this->dispatchBrowserEvent('showModal');
        }
    }

    public function openModal()
    {
        $this->cleanVars();
        $this->resetValidation();
        $this->dispatchBrowserEvent('showModal');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('hideModal');
        $this->cleanVars();
        $this->resetValidation();
    }

    public function delete()
    {
        Pump::destroy($this->selectedItem);
        $this->dispatchBrowserEvent('hideDeleteModal');
        $this->emit('pg:eventRefresh-default');
        $this->dispatchBrowserEvent('showErrorToast');
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $model = Pump::find($this->modelId);

        $this->pump_name = $model->pump_name;
        $this->owner_id = $model->owner_id;
        $this->pump_address = $model->pump_address;
    }

    public function save()
    {
        // Data validation
        $validateData = [
            'pump_name' => 'required|min:3',
            'owner_id' => 'required|integer',
            'pump_address' => 'required|min:3'
        ];

        // Default data
        $data = [
            'pump_name' => $this->pump_name,
            'owner_id' => $this->owner_id,
            'pump_address' => $this->pump_address,
        ];

        $this->validate($validateData);

        if ($this->modelId) {
            Pump::find($this->modelId)->update($data);
            $postInstanceId = $this->modelId;
        } else {
            $postInstance = Pump::create($data);
            //$postInstanceId = $postInstance->id;
        }

        $this->emit('refreshParent');
        $this->emit('pg:eventRefresh-default');
        $this->dispatchBrowserEvent('showSuccessToast');
        $this->dispatchBrowserEvent('hideModal');
        $this->cleanVars();
    }

    public function forcedCloseModal()
    {
        // This is to reset our public variables
        $this->cleanVars();

        // These will reset our error bags
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function cleanVars()
    {
        $this->modelId = null;
        $this->pump_name = null;
        $this->owner_id = null;
        $this->pump_address = null;
    }

    public function render()
    {
        $this->selected_sub_menu = "admin_petrol_pumps";
        $this->card_title = "Petrol Pumps";

        $owners = User::all();

        return view('livewire.admin.pumps-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->with('owners', $owners)
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
