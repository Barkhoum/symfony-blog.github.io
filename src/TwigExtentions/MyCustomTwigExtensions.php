<?php

namespace App\TwigExtentions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MyCustomTwigExtensions  extends AbstractExtension
{
 public function getFilters()
 {
     /** @var TYPE_NAME $this */
     return [
         new TwigFilter(name: 'defaultImage', callable: [$this, 'defaultImage'])
     ];
 }
 public function defaultImage(string $path): string{

   if (strlen(trim($path))==0 ){
       return 'image.jpg';
   }
    return $path;
    }
 }
