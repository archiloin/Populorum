<?php
 
namespace App\Validator\Constraints;
 
use Symfony\Component\Validator\Constraint;
 
/**
 * @Annotation
 */
class Image extends Constraint
 
{
    public $message = "L'image n'a pas �t� renseign�e.";
    
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}