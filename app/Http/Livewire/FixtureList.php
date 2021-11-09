<?php

namespace App\Http\Livewire;

use App\Http\Traits\HasFixtures;
use Livewire\Component;

class FixtureList extends Component
{
    use HasFixtures;

    public $fixtures;
    public $dota2_fixtures;

    public function mount(){
        $this->fixtures = $this->getLatestFixture();
    }
    public function render()
    {
        return view('livewire.fixture-list');
    }
}
