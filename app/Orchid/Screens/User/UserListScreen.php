<?php
namespace App\Orchid\Screens\User;

use App\Orchid\Layouts\User\UserEditLayout;
use App\Orchid\Layouts\User\UserFiltersLayout;
use App\Orchid\Layouts\User\UserListLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class UserListScreen extends Screen
{
    public function query(): iterable
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return [
            'users' => User::with('roles')
                ->filters()
                ->filtersApplySelection(UserFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    public function name(): ?string
    {
        return 'User';
    }

    public function description(): ?string
    {
        return 'All registered users';
    }

    public function permission(): ?iterable
    {
        return [
            'platform.systems.users',
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.systems.users.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            UserFiltersLayout::class,
            UserListLayout::class,

            Layout::modal('asyncEditUserModal', UserEditLayout::class)
                ->async('asyncGetUser'),
        ];
    }

    /** @noinspection PhpUnused */
    public function asyncGetUser(User $user): iterable
    {
        return [
            'user' => $user,
        ];
    }

    public function saveUser(Request $request, User $user): void
    {
        $request->validate([
            'user.email' => [
                'required',
                Rule::unique(User::class, 'slug')->ignore($user),
            ],
        ]);

        $user->fill($request->input('user'))->save();

        Toast::info(__('User was saved.'));
    }

    /** @noinspection PhpUndefinedMethodInspection */
    public function remove(Request $request): void
    {
        User::findOrFail($request->get('id'))->delete();

        Toast::info(__('User was removed'));
    }
}
