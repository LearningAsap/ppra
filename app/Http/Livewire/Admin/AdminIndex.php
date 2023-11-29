<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminIndex extends Component
{
    protected $page_title = "Directorate of Education Colleges GB | Admin";
    protected $main_title = "Dashboard";
    protected $breadcrumb_title = "Dashboard";
    protected $selected_main_menu = "admin_dashboard";
    protected $card_title;
    protected $selected_sub_menu;

    public function render()
    {
        $this->selected_sub_menu = "admin_dashboard";
        $this->card_title = "Admin Dashboard";

        return view('livewire.admin.admin-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
