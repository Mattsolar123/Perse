<?php

namespace Mattsolar123\Perse\Contracts;

use Mattsolar123\Perse\Data\AppointmentDetails;
use Mattsolar123\Perse\Data\AppointmentResponse;

interface AppointmentServiceInterface
{
    public function update(
        AppointmentDetails $appointmentDetails,
    ): AppointmentResponse;
}