<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace tests\models;

use app\models\UserSearch;

const SLEEP_TIME = 2;

/**
 * Description of TransfersTest
 *
 * @author agroprom
 */
class TransfersTest extends \Codeception\Test\Unit {

    public function testMakeCommonTransfer() 
    {
        expect_that($from = UserSearch::findByUsername('from'));
        expect($from->username)->equals('from');
        expect_that($to = UserSearch::findByUsername('to'));
        expect($from->transfer($to, 100));
        sleep(SLEEP_TIME);
        expect($from->balance == -100 );
        expect($to->balance == 100 );
        $to->transfer($from, 100);
        sleep(SLEEP_TIME);
        expect($from->balance == 0 );
        expect($to->balance == 0 );        
                
    }
    
    
    public function testMakeBorderTransfer() 
    {
        expect_that($from = UserSearch::findByUsername('fromBorder'));
        expect($from->username)->equals('fromBorder');
        expect_that($to = UserSearch::findByUsername('toBorder'));
        expect($from->transfer($to, 1000));
        sleep(SLEEP_TIME);
        expect($from->balance == -1000 );
        expect($to->balance == 1000 );
        $to->transfer($from, 1000);
        sleep(SLEEP_TIME);
        expect($from->balance == 0 );
        expect($to->balance == 0 );      
    }
    
    
        public function testMakeOutBorderTransfer() 
    {
        expect_that($from = UserSearch::findByUsername('fromOutBorder'));
        expect($from->username)->equals('fromOutBorder');
        expect_that($to = UserSearch::findByUsername('toOutBorder'));
        expect($from->transfer($to, 1001));
        sleep(SLEEP_TIME);        
        expect($from->balance == 0 );
        expect($to->balance == 0 );
      
    }

}
