<?php

namespace Mattsolar123\Perse\Data;

class AppointmentDetails
{
    public function __construct(
        public string $appointmentDate,
        public string $appointmentTimeFrom,
        public string $appointmentTimeTo,
        public string $siteId,
        public string $customerGuid,
        public string $appointmentId,
        public string $appointmentStatus,
        public string|null $repId,
        public string|null $repEmailId,
        public string|null $repFirstName,
        public string|null $repLastName,
        public string|null $loginUrl = null,
    ) {}

    public function toArray(): array
    {
        $array = [
            'appointmentDate' => $this->appointmentDate,
            'appointmentTimeFrom' => $this->appointmentTimeFrom,
            'appointmentTimeTo' => $this->appointmentTimeTo,
            'siteId' => $this->siteId,
            'customerGuid' => $this->customerGuid,
            'appointmentId' => $this->appointmentId,
            'appointmentStatus' => $this->appointmentStatus,
        ];

        if ($this->repId) {
            $array['repId'] = $this->repId;
        }

        if ($this->repEmailId) {
            $array['repEmailId'] = $this->repEmailId;
        }

        if ($this->repFirstName) {
            $array['repFirstName'] = $this->repFirstName;
        }

        if ($this->repLastName) {
            $array['repLastName'] = $this->repLastName;
        }

        return $array;
    }

    public function getLoginUrl(): string
    {
        return $this->loginUrl;
    }
}