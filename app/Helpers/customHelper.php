<?php
/**
 * File: customHelper.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 03/04/17
 * Time: 13:24
 * Project: lacc_videos
 * Copyright: 2017
 */
if ( !function_exists( 'dateHoraBR' ) ) {
    function dateHoraBR( $date )
    {
        if ( !$date instanceof \DateTime ) {
            $date = new DateTime( $date );
        }

        return $date->format( 'd-m-Y' );
    }

}
if ( !function_exists( 'dateHoraMinuteBR' ) ) {
    function dateHoraMinuteBR( $date )
    {
        if ( !$date instanceof \DateTime ) {
            $date = new DateTime( $date );
        }

        return $date->format( 'd-m-Y H:m:s' );
    }
}
if ( !function_exists( 'priceBR' ) ) {
    function priceBR( $price )
    {
        $price = number_format( $price, 2, ".", "" );

        return $price;
    }
}
if ( !function_exists( 'customEcho' ) ) {
    function customEcho( $string, $qtdCharacter )
    {
        if ( strlen( $string ) <= $qtdCharacter ) {
            return $string;
        } else {
            $y = substr( $string, 0, $qtdCharacter ) . ' ...';

            return $y;
        }
    }
}

