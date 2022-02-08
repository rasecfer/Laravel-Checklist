<?php

namespace Tests\Feature;

use App\Models\ChecklistGroup;
use App\Models\User;
use App\Services\MenuService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminChecklistsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->post('admin/checklist_groups', [
            'name' => 'Test Group'
        ]);

        $response->assertRedirect('/');

        $group = ChecklistGroup::where('name', 'Test Group')->first();
        $this->assertNotNull($group);

        $response = $this->actingAs($admin)->get('admin/checklist_groups/'. $group->id .'/edit');
        $response->assertOk();

        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->put('admin/checklist_groups/'. $group->id, [
            'name' => 'Test Group Updated'
        ]);

        $response->assertRedirect('/');

        $group = ChecklistGroup::where('name', 'Test Group Updated')->first();
        $this->assertNotNull($group);

        $menu = (new MenuService())->get_menu();
        //dd($menu);
        $this->assertEquals(1,$menu['admin_menu']->where('name', 'Test Group Updated')->count());
    }
}
