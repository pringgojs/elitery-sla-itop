<?php

namespace App\Constants;

class Constants
{
    const TICKET_CLOSED = 'closed';
    const TICKET_ONGOING = 'ongoing';
    const TICKET_TYPES = [
        ['id' => 'UserRequest', 'name' => 'User Request'],
        ['id' => 'NormalChange', 'name' => 'Normal Change'],
        ['id' => 'RoutineChange', 'name' => 'Routine Change'],
        ['id' => 'EmergencyChange', 'name' => 'Emergency Change'],
        ['id' => 'Incident', 'name' => 'Incident'],
        ['id' => 'Problem', 'name' => 'Problem'],
    ];
}
