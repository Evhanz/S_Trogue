<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('Provar el registro de Proveedores');
$I->amOnPage('proveedores/all');
$I->see('Módulo del Proveedores ','h4');
$I->click('Nuevo');
$I->amOnPage('/proveedores/newProveedor');
$I->see('Formulario de Registro','h3');
$I->submitForm('#formulario',[
    'name'=>'Zuleyca',
    'apellidoP'=>'Mujica',
    'apellidoM'=>'Rabanal',
    'dni'=>47085019,
    'celular'=>990212662,
    'ruta'=>1,
    'anexos'=>1

    ]);
$I->seeInCurrentUrl('proveedores/all');
$I->see('Perfecto!!');

/*
$I->see('The dni has already been taken');+/