<?php

namespace App\Http\Livewire;

use App\Models\BirthDateList;
use App\Models\Person;
use App\Models\SharedPerson;
use App\Models\User;
use App\Repositories\BirthDateListRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\Redirector;

class DateOfBirth extends Component
{
    public ?array $people;
    public string $personName = 'Today';
    public ?string $selectedPerson = null;
    public int $selectedDate = 1;
    public string $selectedMonth = 'January';
    public ?string $selectedYear = null;

    protected $listeners = ['selectedPersonUpdated' => 'updateSelectedPerson'];

    public function mount()
    {
        $this->selectedYear = date('Y');
        $this->selectedMonth = date('M');
        $this->selectedDate = date('d');
    }

    public array $months = [
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

    protected array $rules = [
        "selectedPerson" => "required",
    ];

    public function render()
    {
        return view('livewire.date-of-birth');
    }

    public function updateSelectedPerson($data)
    {
        $this->selectedPerson = $data['value'];
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

    public function getListProperty(BirthDateListRepository $birthDateListRepository)
    {
        /** @noinspection PhpParamsInspection */
        return $birthDateListRepository->findInactiveBirthDateList(auth()->user());
    }

    public function getDateProperty(): array
    {
        return range(1, Carbon::parse($this->selectedMonth)->endOfMonth()->format('d'));
    }

    /** @noinspection PhpConditionAlreadyCheckedInspection */
    public function getValidProperty(): bool
    {
        return !is_null($this->selectedDate) &&
            !is_null($this->selectedMonth) &&
            !is_null($this->selectedYear) &&
            !is_null($this->personName);
    }

    public function storeList(BirthDateListRepository $birthDateListRepository)
    {
        if ($this->getValidProperty()) {
            $this->updateList(
                $this->personName,
                "$this->selectedDate $this->selectedMonth $this->selectedYear",
                $birthDateListRepository
            );
            $this->personName = 'Today';
        }
    }

    public function removeList(int $index, BirthDateListRepository $birthDateListRepository)
    {
        $list = $this->getListProperty($birthDateListRepository);

        if ($list instanceof BirthDateList) {
            $content = collect($list->content);
            $content[$index] = null;
            $list->content = $content->filter();
            $list->save();
        }
    }

    /** @noinspection PhpUnused */
    public function addFromList(BirthDateListRepository $birthDateListRepository)
    {
        $person = $this->getPersonProperty();

        if ($person instanceof Person || $person instanceof SharedPerson) {
            $this->updateList($person->name, $person->birth_date->toDateString(), $birthDateListRepository);
            $this->emit('clearSelectedPerson');
        }
    }

    private function updateList(string $name, string $date, BirthDateListRepository $birthDateListRepository)
    {
        $id = auth()->user()->getAuthIdentifier();

        /** @noinspection PhpParamsInspection */
        $list = $birthDateListRepository->findInactiveBirthDateList(auth()->user());
        if (is_null($list)) $list = new BirthDateList(['content' => [], 'user_id' => $id]);

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
        return 5;
    }

    /** @noinspection PhpUnused */
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

    public function recalculate(BirthDateListRepository $birthDateListRepository): Redirector
    {
        $user = auth()->user();

        if ($user instanceof User) {
            if ($user->credit->point > 0) {
                $activeList = $birthDateListRepository->findActiveBirthDateList($user);
                $inactiveList = $birthDateListRepository->findInactiveBirthDateList($user);

                if ($inactiveList instanceof BirthDateList) {
                    if (is_null($activeList)) {
                        $this->createActiveList($inactiveList);
                    } elseif ($activeList instanceof BirthDateList) {
                        $activeList->update(['content' => $inactiveList->content]);
                    }
                }

                $user->credit()->decrement('point');

                /** @noinspection PhpIncompatibleReturnTypeInspection */
                return redirect()->route('dashboard.index');
            }
        }

        return abort(403);
    }

    private function createActiveList(BirthDateList $inactiveList): void
    {
        $activeList = new BirthDateList([
            'content' => $inactiveList->content,
            'user_id' => auth()->user()->getAuthIdentifier()
        ]);
        $activeList->is_active = true;
        $activeList->save();
    }

    public function getRecalculateableProperty(): bool
    {
        $user = auth()->user();

        return $user instanceof User && ($user->credit->point ?? 0) > 0;
    }
}
