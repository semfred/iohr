@component('mail::message')
# Hello {{ $leave->employee->name }}! Your leave has been {{ getStatus($leave->status) }}

@component('mail::table')
|        |          |   |
| ------------- |:-------------|
| Approving Manager:      | <strong>{{ $leave->approveUser->employee_info->name }}</strong>      |
| Notes:      | <em>{{ $leave->status_note }}</em>      |
@endcomponent

@component('mail::table')
|        |          |   |
| ------------- |:-------------:|
| Type:      | <strong>{{ ucfirst($leave->type) }}</strong>      |
| If Other, Please Specify:      | <strong>{{ $leave->type == 'other' ? $leave->other_specify : 'N/A' }} </strong> |
| From Date:      | <strong>{{ $leave->from_date->format('F d, Y') }}</strong> |
| To Date:      | <strong>{{ $leave->to_date->format('F d, Y') }}</strong> |
| Days:      | <strong>{{ $leave->days }}</strong> |
| Reference ID:      | <strong>{{ $leave->id }}</strong> |
@endcomponent

{{-- Regards,<br> --}}
<strong><span style="color:#EA2036;">Intelligent</span> <span style="color:#6D7172;">Outsourcing</span></strong>
@endcomponent
