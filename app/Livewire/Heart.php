<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Heart extends Component
{
    public Model $hearteable;

    public function toggle()
    {
        if ($this->hearteable->isHearted()) {
            $this->hearteable->unheart();
        } else {
            $this->hearteable->heart();
        }
    }
    public function isHearted(): bool
    {
        return $this->hearteable->isHearted();
    }

    public function render()
    {
        return view('livewire.heart');
    }
}
