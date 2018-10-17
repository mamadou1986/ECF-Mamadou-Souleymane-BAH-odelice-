<?php
/**
 * Created by PhpStorm.
 * User: Sow
 * Date: 19/08/2018
 * Time: 01:37
 */
namespace AppBundle\Twig\extension;
class MontantTvaExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('montantTva', array($this,'montantTva')));
    }

    function montantTva($prixHT,$tva)
    {
        return round((($prixHT / $tva) - $prixHT),2);
    }

    public function getName()
    {
        return 'montant_tva_extension';
    }
}