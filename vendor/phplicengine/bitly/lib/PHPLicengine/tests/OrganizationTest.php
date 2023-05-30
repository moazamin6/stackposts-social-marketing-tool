<?php

// OrganizationTest.php
#################################################
##
## PHPLicengine
##
#################################################
## Copyright 2009-{current_year} PHPLicengine
## 
## Licensed under the Apache License, Version 2.0 (the "License");
## you may not use this file except in compliance with the License.
## You may obtain a copy of the License at
##
##    http://www.apache.org/licenses/LICENSE-2.0
##
## Unless required by applicable law or agreed to in writing, software
## distributed under the License is distributed on an "AS IS" BASIS,
## WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
## See the License for the specific language governing permissions and
## limitations under the License.
#################################################

use PHPLicengine\Api\ApiInterface;
use PHPLicengine\Service\Organization;
use PHPUnit\Framework\TestCase;

class OrganizationTest extends TestCase
{

    public function testGetOrganizations()
    {
        $mock = $this->createMock(ApiInterface::class);
        $mock
            ->expects($this->once())
            ->method('get')
            ->with(
                    $this->equalTo('https://api-ssl.bitly.com/v4/organizations')                    
                    );
        $bitlink = new Organization($mock);
        $bitlink->getOrganizations();
    } 
    
    public function testGetOrganizationShortenCounts()
    {
        $mock = $this->createMock(ApiInterface::class);
        $mock
            ->expects($this->once())
            ->method('get')
            ->with(
                    $this->equalTo('https://api-ssl.bitly.com/v4/organizations/test/shorten_counts'),
                    $this->identicalTo(['key' => 'value'])
                    );
        $bitlink = new Organization($mock);
        $bitlink->getOrganizationShortenCounts('test', ['key' => 'value']);
    }     
    
    public function testGetOrganization()
    {
        $mock = $this->createMock(ApiInterface::class);
        $mock
            ->expects($this->once())
            ->method('get')
            ->with(
                    $this->equalTo('https://api-ssl.bitly.com/v4/organizations/test')                    
                    );
        $bitlink = new Organization($mock);
        $bitlink->getOrganization('test');
    }         
    
    public function testGetPlanLimits()
    {
        $mock = $this->createMock(ApiInterface::class);
        $mock
            ->expects($this->once())
            ->method('get')
            ->with(
                    $this->equalTo('https://api-ssl.bitly.com/v4/organizations/test/plan_limits')                    
                    );
        $bitlink = new Organization($mock);
        $bitlink->getPlanLimits('test');
    }         
    
}
