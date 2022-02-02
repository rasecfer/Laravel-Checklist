<?php

namespace App\Http\View\Composers;

use App\Models\Checklist;
use Carbon\Carbon;
use Illuminate\View\View;
use function PHPUnit\Framework\isNull;

class MenuComposer
{

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $menu = \App\Models\ChecklistGroup::with(['checklists' => function ($query) {
            $query->whereNull('user_id');
        }])->get();

        $view->with('admin_menu', $menu);

        $groups = [];
        $last_action_at = auth()->user()->last_action_at;
        if (is_null($last_action_at)) {
            $last_action_at = now()->subYears(10);
        }

        $user_checklist = Checklist::where('user_id', auth()->id())->get();

        foreach ($menu->toArray() as $group) {
            if (count($group['checklists']) > 0) {
                $group_updated_at = $user_checklist->where('checklist_group_id', $group['id'])->max('updated_at');
                $group['is_new'] = Carbon::create($group['created_at'])->greaterThan($group_updated_at);
                $group['is_updated'] = !($group['is_new']) && Carbon::create($group['updated_at'])->greaterThan($group_updated_at);

                foreach ($group['checklists'] as &$checklist) {
                    $checklist_updated_at = $user_checklist->where('checklist_id', $checklist['id'])->max('updated_at');
                    $checklist['is_new'] = !($group['is_new']) && Carbon::create($checklist['created_at'])->greaterThan($checklist_updated_at);
                    $checklist['is_updated'] = !($group['is_new']) && !($group['is_updated']) && !($checklist['is_new']) && Carbon::create($checklist['updated_at'])->greaterThan($checklist_updated_at);
                    $checklist['tasks'] = 1;
                    $checklist['completed'] = 0;
                }
                $groups[] = $group;
            }

        }

        $view->with('user_menu', $groups);
    }
}
