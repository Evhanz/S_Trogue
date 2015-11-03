<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 27/10/2015
 * Time: 4:51 PM
 */

/** @var $I WebGuy */
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that frontpage works');
$I->amOnPage('/');
$I->see('Trogue');