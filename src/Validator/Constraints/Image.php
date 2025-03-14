<?php
 
namespace App\Validator\Constraints;
 
use Symfony\Component\Validator\Constraint;
 
/**
 * @Annotation
 */
class Image extends Constraint
 
{
    public $message = "L'image n'a pas été renseignée.";
    
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}