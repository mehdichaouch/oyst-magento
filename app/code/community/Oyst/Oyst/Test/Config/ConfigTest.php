<?php
/**
 * This file is part of Oyst_Oyst for Magento.
 *
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author Oyst <dev@oyst.com> <@oystcompany>
 * @category Oyst
 * @package Oyst_Oyst
 * @copyright Copyright (c) 2017 Oyst (http://www.oyst.com)
 */

/**
 * Test that the module is configured correctly
 * Config_ConfigTest Model
 */
class Oyst_Oyst_Test_Config_ConfigTest extends EcomDev_PHPUnit_Test_Case_Config
{
    /**
     * Ensure the module is in the right code pool
     */
    public function testShouldBeInCommunityPool()
    {
        $this->assertModuleCodePool('community');
    }
}
