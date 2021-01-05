@component('mail::message')
# {{ $leave->employee->name }} has requested a leave:

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

@component('mail::button', ['url' => route('web.requests.change.status', ['leave' => $leave->id, 'status' => 'approve']), 'color' => 'green'])
Approve Leave
@endcomponent

@component('mail::button', ['url' => route('web.requests.change.status', ['leave' => $leave->id, 'status' => 'decline']), 'color' => 'red'])
Decline Leave
@endcomponent

{{-- Regards,<br> --}}
<strong><span style="color:#EA2036;">Intelligent</span> <span style="color:#6D7172;">Outsourcing</span></strong>
@endcomponent
