<?php

namespace Mattsolar123\Perse\Contracts;

use Mattsolar123\Perse\Data\AppointmentDetails;

interface AppointmentServiceInterface
{
    public function update(
        AppointmentDetails $appointmentDetails,
    ): AppointmentDetails;
}