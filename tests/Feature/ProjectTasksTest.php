<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_add_tasks_to_projects()
    {
        $project = factory('App\Project')->create();
        $attributes = factory('App\Task')->raw(['body' => '']);
        $this->post($project->path() . '/tasks', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function authenticated_users_cannot_add_task_to_others_project()
    {

        $this->signIn();
        $project = ProjectFactory::withTasks(1)->create();

        $this->post($project->path() . '/tasks', ['body' => 'Task test'])->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'Task test']);

    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_a_task()
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();

        $this->patch($project->tasks[0]->path(), ['body' => 'changed'])
             ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

    /** @test */
    public function a_project_can_have_a_task()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
        ->post($project->path() . '/tasks', ['body' => 'Test Task']);
        $this->get($project->path())->assertSee('Test Task');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $project = ProjectFactory::ownedBy($this->signIn())->withTasks(1)->create();
        // $this->signIn();
        // $project = auth()->user()->projects()->create(
        //     factory('App\Project')->raw()
        // );

        // $task = $project->addTask('Test Update');

        $this->patch($project->tasks[0]->path(), [
            'body' => 'Test updated',
        ]);

        $this->assertDatabaseHas('tasks',[
            'body' => 'Test updated', 
        ]);
    }

    /** @test */
    public function a_task_can_be_completed()
    {
        $project = ProjectFactory::ownedBy($this->signIn())->withTasks(1)->create();
        

        $this->patch($project->tasks[0]->path(), [
            'body' => 'Test updated',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks',[
            'body' => 'Test updated', 
            'completed' => true
        ]);
    }

    /** @test */
    public function a_task_can_be_marked_as_incomplete()
    {
        $project = ProjectFactory::ownedBy($this->signIn())->withTasks(1)->create();
        

        $this->patch($project->tasks[0]->path(), [
            'body' => 'Test updated',
            'completed' => true
        ]);

        $this->patch($project->tasks[0]->path(), [
            'body' => 'Test updated',
            'completed' => false
        ]);

        $this->assertDatabaseHas('tasks',[
            'body' => 'Test updated', 
            'completed' => false
        ]);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $this->signIn();
        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        $attributes = factory('App\Task')->raw(['body' => '']);
        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
