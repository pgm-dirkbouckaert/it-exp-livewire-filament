<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class ModalLogin extends Component
{

  public $showModalLogin = false;

  #[On('openModalLogin')]
  public function openModalLogin()
  {
    $this->showModalLogin = true;
  }

  public function closeModalLogin()
  {
    $this->showModalLogin = false;
  }

  public function render()
  {
    return view('livewire.modal-login');
  }
}
