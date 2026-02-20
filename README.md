# Perse

### Installation

composer require mattsolar123/perse

### Configuration

Add the following to your .env file
```
PERSE_API_URL=https://api.thelabrador.co.uk
PERSE_API_KEY=
PERSE_SECRET=
PERSE_UTM_SOURCE=
```

## Appointments

### Usage

To update an appointment, initialize the `AppointmentDetails` data object and pass it to the `Appointment::update` method.

```php
use Mattsolar123\Perse\Gateways\Appointment;
use Mattsolar123\Perse\Data\AppointmentDetails;

$data = new AppointmentDetails(
    appointmentDate: '2024-12-25',
    appointmentTimeFrom: '10:00',
    appointmentTimeTo: '12:00',
    siteId: 'SITE_123',
    customerGuid: 'cust_987654',
    appointmentId: '101',
    appointmentStatus: 'scheduled'
);

Appointment::update(
    $data
);
```

### Parameter Specifications

| Parameter | Type | Format / Example | Required | Description |
| :--- | :--- | :--- | :---: | :--- |
| `appointmentDate` | `string` | `Y-m-d` (2024-10-15) | Yes | The scheduled date of the visit. |
| `appointmentTimeFrom` | `string` | `H:i` (14:00) | Yes | Start time in 24-hour format. |
| `appointmentTimeTo` | `string` | `H:i` (16:00) | Yes | End time in 24-hour format. |
| `siteId` | `string` | `SITE_123` | Yes | The unique identifier for the site. |
| `customerGuid` | `string` | UUID / String | Yes | Unique Global ID for the customer. |
| `appointmentId` | `string` | `"105"` | Yes | Internal ID (must be cast to string). |
| `appointmentStatus` | `string` | `booked` | Yes | Current state of the appointment. |
| `repId` | `string\|null` | `"99"` | No | ID of the assigned representative. |
| `repEmailId` | `string\|null` | `rep@company.com` | No | Email for the representative. |
| `repFirstName` | `string\|null` | `John` | No | Representative's first name. |
| `repLastName` | `string\|null` | `Doe` | No | Representative's last name. |


