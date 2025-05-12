<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrdenCompraTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrdenCompraTable Test Case
 */
class OrdenCompraTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrdenCompraTable
     */
    public $OrdenCompra;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.OrdenCompra',
        'app.Proveedores',
        'app.TipoMoneda',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OrdenCompra') ? [] : ['className' => OrdenCompraTable::class];
        $this->OrdenCompra = TableRegistry::getTableLocator()->get('OrdenCompra', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrdenCompra);

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
