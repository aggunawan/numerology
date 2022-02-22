<?php

namespace App\Http\Livewire;

use App\Models\BirthDateList;
use App\Models\Person;
use Carbon\Carbon;
use Livewire\Component;

class DateOfBirth extends Component
{
    public $people;
    public $personName = null;
    public $selectedPerson = null;
    public $selectedDate = 1;
    public $selectedMonth = 'January';
    public $selectedYear = null;

    public function mount()
    {
        $this->selectedYear = date('Y');
        $this->selectedMonth = date('F');
        $this->selectedDate = date('d');
    }

    public $months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];

    protected $rules = [
        "selectedPerson" => "required",
    ];

    public function render()
    {
        return view('livewire.date-of-birth');
    }

    public function getPersonProperty()
    {
        return $this->selectedPerson ? (new Person())->newQuery()->find($this->selectedPerson) : null;
    }

    public function getListProperty()
    {
        return (new BirthDateList())->newQuery()->where('user_id', auth()->user()->getAuthIdentifier())->first();
    }

    public function getDateProperty(): array
    {
        return range(1, Carbon::parse($this->selectedMonth)->endOfMonth()->format('d'));
    }

    public function getValidProperty(): bool
    {
        return !is_null($this->selectedDate) &&
            !is_null($this->selectedMonth) &&
            !is_null($this->selectedYear) &&
            !is_null($this->personName);
    }

    public function storeList()
    {
        if ($this->getValidProperty()) {
            $this->updateList($this->personName, "$this->selectedDate $this->selectedMonth $this->selectedYear");
            $this->personName = null;
        }
    }

    public function removeList(int $index)
    {
        $list = $this->getListProperty();

        if ($list instanceof BirthDateList) {
            $content = collect($list->content);
            $content[$index] = null;
            $list->content = $content->filter();
            $list->save();
        }
    }

    public function addFromList()
    {
        $person = $this->getPersonProperty();

        if ($person instanceof Person) {
            $this->updateList($person->name, $person->birth_date->toDateString());
        }
    }

    private function updateList(string $name, string $date)
    {
        $id = auth()->user()->getAuthIdentifier();
        $list = (new BirthDateList())->newQuery()->firstOrCreate(
            ['user_id' => $id],
            ['content' => [], 'user_id' => $id]
        );

        if ($list instanceof BirthDateList) {
            $content = collect($list->content);
            if ($content->count() < 3) {
                $list->content = $content->push([
                    'name' => $name,
                    'date' => Carbon::parse($date)->toDateString()
                ]);

                $list->save();
            }
        }
    }
}
