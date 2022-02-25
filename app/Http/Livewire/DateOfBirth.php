<?php

namespace App\Http\Livewire;

use App\Models\BirthDateList;
use App\Models\Person;
use App\Models\SharedPerson;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
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
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec',
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
        if ($this->selectedPerson) {
            $query = new SharedPerson();

            if (str_starts_with($this->selectedPerson, 'person')) {
                $query = new Person();
            }

            return $query->newQuery()->find(explode('-', $this->selectedPerson)[1]);
        }

        return null;
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

        if ($person instanceof Person || $person instanceof SharedPerson) {
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
            if ($content->count() < $this->getMaxDateOfBirth()) {
                $list->content = $content->push([
                    'name' => $name,
                    'date' => Carbon::parse($date)->toDateString()
                ]);

                $list->save();
            }
        }
    }

    protected function getMaxDateOfBirth(): int
    {
        $roles = $this->getRoles();
        if ($roles->contains(User::TRAINER)) return 5;
        if ($roles->contains(User::PRACTITIONER)) return 3;
        return 1;
    }

    public function getHasListProperty(): bool
    {
        $roles = $this->getRoles();
        return $roles->contains(User::PRACTITIONER) || $roles->contains(User::TRAINER);
    }

    protected function getRoles(): Collection
    {
        /** @noinspection PhpPossiblePolymorphicInvocationInspection */
        return auth()->user()->roles()->pluck('slug');
    }
}
