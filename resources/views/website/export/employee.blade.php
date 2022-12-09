<table class="table table-bordered">
    <thead>
        <tr>
            <td><b>EmpId</b></td>
            <td><b>Employee Name</b></td>
            <td><b>Email</b></td>
            <td><b>Phone</b></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>
                    {{ $user->emp_id }}
                </td>
                <td>
                    {{ @$user->name }}
                </td>
                <td>
                    {{ @$user->email }}
                </td>
                <td>
                    {{ @$user->phone_no }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
