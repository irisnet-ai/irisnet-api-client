<?php
/**
 * @package IrisnetAPIClient
 */
namespace Inc\Instructions;

class RulesInstructions
{

    private static $drawModeVars = array(
        0 => 'none',
        1 => 'frame + name',
        2 => 'mask',
        3 => 'mask + frame + name',
        6 => 'blur',
        7 => 'blur + frame + name'
    );

    private static $classObjectGroups = array(
        'Base Parameters' => array (
            'face' => array(
                'plural' => 'many faces',
                'allowMinMax' => true
            ),
            'hand' => array(
                'plural' => 'many hands',
                'allowMinMax' => true
            ),
            'foot' => array(
                'plural' => 'many feet',
                'allowMinMax' => true
            ),
            'footwear' => array(
                'plural' => 'many shoes or similar footwear',
                'allowMinMax' => true
            ),
            'breast' => array(
                'plural' => 'many breasts',
                'allowMinMax' => false
            ),
            'vulva' => array(
                'plural' => 'many vulvae',
                'allowMinMax' => false
            ),
            'penis' => array(
                'plural' => 'many penises',
                'allowMinMax' => false
            ),
            'vagina' => array(
                'plural' => 'many vaginae',
                'allowMinMax' => false
            ),
            'buttocks' => array(
                'plural' => 'many buttocks', 
                'allowMinMax' => false
            ),
            'anus' => array(
                'plural' => 'many ani', 
                'allowMinMax' => false
            ),
            'toy' => array(
                'plural' => 'sex toys', 
                'allowMinMax' => false
            ),
            'oral' => array(
                'plural' => 'oral', 
                'allowMinMax' => false
            ),
            'penetration' => array(
                'plural' => 'penetrations', 
                'allowMinMax' => false
            ),
        ),
        'Age Estimation' => array(
            'child' => array(
                'plural' => 'child faces',
                'allowMinMax' => false
            ),
            'adult' => array(
                'plural' => 'adult faces',
                'allowMinMax' => true
            ),
            'senior' => array(
                'plural' => 'senior faces',
                'allowMinMax' => true
            ),
            'pose' => array(
                'plural' => 'poses (obstructed or looking to the side)',
                'allowMinMax' => false
            ),
        ),
        'Illegal Symbols' => array(
            'illegalSymbols' => array(
                'plural' => 'illegal symbols',
                'allowMinMax' => false
            ),
        ),
    );

    /**
     * Get the value of drawModeVars
     */ 
    public static function getDrawModeVars()
    {
        return self::$drawModeVars;
    }

    /**
     * Get the value of classObjectGroups
     */ 
    public static function getClassObjectGroups()
    {
        return self::$classObjectGroups;
    }

}