<?php
/**
 * @package IrisnetAPIClient
 */
namespace Inc\Helper;

class RulesHelper
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
                'plural' => 'female breasts',
                'allowMinMax' => false
            ),
            'chest' => array(
                'plural' => 'male breasts',
                'allowMinMax' => false
            ),
            'vulva' => array(
                'plural' => 'vulvae',
                'allowMinMax' => false
            ),
            'penis' => array(
                'plural' => 'penises',
                'allowMinMax' => false
            ),
            'vagina' => array(
                'plural' => 'vaginae',
                'allowMinMax' => false
            ),
            'buttocks' => array(
                'plural' => 'buttocks', 
                'allowMinMax' => false
            ),
            'anus' => array(
                'plural' => 'ani', 
                'allowMinMax' => false
            ),
            'toy' => array(
                'plural' => 'toys', 
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
        'Attributes Check' => array(
            'female' => array(
                'plural' => 'women',
                'allowMinMax' => true
            ),
            'male' => array(
                'plural' => 'men',
                'allowMinMax' => true
            ),
            'hair' => array(
                'plural' => 'persons with hair',
                'allowMinMax' => true
            ),
            'hairless' => array(
                'plural' => 'hairless persons',
                'allowMinMax' => true
            ),
            'beard' => array(
                'plural' => 'persons with a beard',
                'allowMinMax' => true
            ),
            'moustache' => array(
                'plural' => 'persons with a moustache',
                'allowMinMax' => true
            ),
            'headpiece' => array(
                'plural' => 'persons with a hat',
                'allowMinMax' => true
            ),
            'glasses' => array(
                'plural' => 'persons with glasses',
                'allowMinMax' => true
            ),
            'sunglasses' => array(
                'plural' => 'persons with sunglasses',
                'allowMinMax' => true
            ),
            'mask' => array(
                'plural' => 'persons with a mask',
                'allowMinMax' => true
            ),
            'slimSized' => array(
                'plural' => 'slimSized faces',
                'allowMinMax' => false
            ),
            'realSized' => array(
                'plural' => 'realSized faces',
                'allowMinMax' => false
            ),
            'plusSized' => array(
                'plural' => 'plusSized faces',
                'allowMinMax' => false
            ),
        ),
        'Nipple Check' => array(
            'noNipple' => array(
                'plural' => 'female breasts without a visible nipple',
                'allowMinMax' => false
            ),
            'hasNipple' => array(
                'plural' => 'female breasts with a visible nipple',
                'allowMinMax' => false
            ),
        ),
        'Body Attributes' => array(
            'slimSized' => array(
                'plural' => 'slimSized bodies',
                'allowMinMax' => false
            ),
            'realSized' => array(
                'plural' => 'realSized bodies',
                'allowMinMax' => false
            ),
            'plusSized' => array(
                'plural' => 'plusSized bodies',
                'allowMinMax' => false
            ),
        ),
        'Illegal Symbols' => array(
            'illegalSymbols' => array(
                'plural' => 'illegal symbols',
                'allowMinMax' => false
            ),
        ),
        'Unwanted Substances' => array(
            'beer' => array(
                'plural' => 'beers',
                'allowMinMax' => false
            ),
            'beerBottle' => array(
                'plural' => 'bottles of beer',
                'allowMinMax' => false
            ),
            'beerCan' => array(
                'plural' => 'cans of beer',
                'allowMinMax' => false
            ),
            'wine' => array(
                'plural' => 'wine',
                'allowMinMax' => false
            ),
            'wineBottle' => array(
                'plural' => 'bottles of wine',
                'allowMinMax' => false
            ),
            'cocktail' => array(
                'plural' => 'cocktails',
                'allowMinMax' => false
            ),
            'alcohol' => array(
                'plural' => 'alcohol',
                'allowMinMax' => false
            ),
            'cannabis' => array(
                'plural' => 'cannabis',
                'allowMinMax' => false
            ),
            'cigarette' => array(
                'plural' => 'cigarettes',
                'allowMinMax' => false
            ),
            'cocaine' => array(
                'plural' => 'cocaine',
                'allowMinMax' => false
            ),
            'heroine' => array(
                'plural' => 'heroines',
                'allowMinMax' => false
            ),
            'coffee' => array(
                'plural' => 'coffees',
                'allowMinMax' => false
            ),
        ),
        'Violence Check' => array(
            'camouflage' => array(
                'plural' => 'camouflage',
                'allowMinMax' => false
            ),
            'club' => array(
                'plural' => 'clubs',
                'allowMinMax' => false
            ),
            'knife' => array(
                'plural' => 'knives',
                'allowMinMax' => false
            ),
            'sword' => array(
                'plural' => 'swords',
                'allowMinMax' => false
            ),
            'pistol' => array(
                'plural' => 'pistols',
                'allowMinMax' => false
            ),
            'rifle' => array(
                'plural' => 'rifles',
                'allowMinMax' => false
            ),
            'cannon' => array(
                'plural' => 'cannons',
                'allowMinMax' => false
            ),
            'fire' => array(
                'plural' => 'fire',
                'allowMinMax' => false
            ),
        ),
        'Text Recognition' => array(
            'textRecognition' => array(
                'plural' => 'letters',
                'allowMinMax' => true
            ),
        ),
    );

    /**
     * Converts the ClassObjectGroups array to a two dimensional array
     */ 
    public static function getSimplifiedClassObjectArray()
    {
        $objectGroups = array();
        foreach (self::$classObjectGroups as $key => $value) {
            foreach ($value as $paramKey => $ignore) {
                $objectGroups[self::getIdentifiableGroupKey($key)][] = $paramKey;
            }
        }
        return $objectGroups;
    }

    /**
     * Converts the ClassObjectGroups array to a two dimensional array
     */ 
    public static function findClassParent($paramName)
    {
        return self::find_parent(self::getSimplifiedClassObjectArray(), $paramName);
    }

    /**
     * Converts a group key to an identifiable string 
     * e.g. "Base Parameters" -> "baseParameters"
     */ 
    public static function getIdentifiableGroupKey($key)
    {
        return lcfirst(str_replace(' ', '', $key));
    }

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
    public static function getClassObjectGroups($identifiable = false)
    {
        if (!$identifiable) {
            return self::$classObjectGroups;
        } else {
            $groups = array();
            foreach(self::$classObjectGroups as $groupName => $c) {
                $groups[self::getIdentifiableGroupKey($groupName)] = $c;
            }
            return $groups;
        }
    }

    private static function find_parent($array, $needle, $parent = null) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $pass = $parent;
                if (is_string($key)) {
                    $pass = $key;
                }
                $found = self::find_parent($value, $needle, $pass);
                if ($found !== false) {
                    return $found;
                }
            } else if ($value === $needle) {
                return $parent;
            }
        }
    
        return false;
    }

}