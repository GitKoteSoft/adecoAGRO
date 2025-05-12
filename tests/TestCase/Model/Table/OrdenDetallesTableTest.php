<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrdenDetallesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrdenDetallesTable Test Case
 */
class OrdenDetallesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrdenDetallesTable
     */
    public $OrdenDetalles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.OrdenDetalles',
        'app.OrdenCompra',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OrdenDetalles') ? [] : ['className' => OrdenDetallesTable::class];
        $this->OrdenDetalles = TableRegistry::getTableLocator()->get('OrdenDetalles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrdenDetalles);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
