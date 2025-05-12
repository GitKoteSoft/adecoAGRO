<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoMonedaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoMonedaTable Test Case
 */
class TipoMonedaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoMonedaTable
     */
    public $TipoMoneda;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('TipoMoneda') ? [] : ['className' => TipoMonedaTable::class];
        $this->TipoMoneda = TableRegistry::getTableLocator()->get('TipoMoneda', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TipoMoneda);

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
}
