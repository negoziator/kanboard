<?php

require_once __DIR__.'/Base.php';

use Model\Project;
use Model\Category;
use Model\ProjectPermission;
use Model\User;
use Model\Task;
use Model\TaskCreation;
use Model\Acl;
use Model\Board;

class ProjectDuplicationTest extends Base
{
    public function testClonePublicProject()
    {
        $p = new Project($this->container);

        $this->assertEquals(1, $p->create(array('name' => 'Public')));
        $this->assertEquals(2, $p->duplicate(1));

        $project = $p->getById(2);
        $this->assertNotEmpty($project);
        $this->assertEquals('Public (Clone)', $project['name']);
        $this->assertEquals(0, $project['is_private']);
        $this->assertEquals(0, $project['is_public']);
        $this->assertEmpty($project['token']);
    }

    public function testClonePrivateProject()
    {
        $p = new Project($this->container);

        $this->assertEquals(1, $p->create(array('name' => 'Private', 'is_private' => 1), 1, true));
        $this->assertEquals(2, $p->duplicate(1));

        $project = $p->getById(2);
        $this->assertNotEmpty($project);
        $this->assertEquals('Private (Clone)', $project['name']);
        $this->assertEquals(1, $project['is_private']);
        $this->assertEquals(0, $project['is_public']);
        $this->assertEmpty($project['token']);

        $pp = new ProjectPermission($this->container);

        $this->assertEquals(array(1 => 'admin'), $pp->getMembers(1));
        $this->assertEquals(array(1 => 'admin'), $pp->getMembers(2));
    }

    public function testCloneProjectWithCategories()
    {
        $p = new Project($this->container);
        $c = new Category($this->container);

        $this->assertEquals(1, $p->create(array('name' => 'P1')));

        $this->assertEquals(1, $c->create(array('name' => 'C1', 'project_id' => 1)));
        $this->assertEquals(2, $c->create(array('name' => 'C2', 'project_id' => 1)));
        $this->assertEquals(3, $c->create(array('name' => 'C3', 'project_id' => 1)));

        $this->assertEquals(2, $p->duplicate(1));

        $project = $p->getById(2);
        $this->assertNotEmpty($project);
        $this->assertEquals('P1 (Clone)', $project['name']);

        $categories = $c->getAll(2);
        $this->assertNotempty($categories);
        $this->assertEquals(3, count($categories));

        $this->assertEquals(4, $categories[0]['id']);
        $this->assertEquals('C1', $categories[0]['name']);

        $this->assertEquals(5, $categories[1]['id']);
        $this->assertEquals('C2', $categories[1]['name']);

        $this->assertEquals(6, $categories[2]['id']);
        $this->assertEquals('C3', $categories[2]['name']);
    }

    // TODO: test users
    // TODO: test actions
}
