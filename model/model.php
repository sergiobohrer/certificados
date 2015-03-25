<?php

function getParticipant( $id ) {
    $participants = array(
        'XXXXXXXX' => array( 'nome' => 'Sérgio Bohrer Reis' ),
    );

    if ( isset( $participants[$id] ) ) {
        return $participants[$id];
    }
    return false;
}