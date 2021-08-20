@foreach ($logs as $key=>$log)
    <tr>
        <td class="text-center">{{ $key+1 }}</td>
        <td class="text-center text-capitalize">{{ App\Admin::getAdminName($log->user) }}</td>
        <td class="text-center hidden-xs">{{ App\Admin::getAdminRole($log->user) }}</td>
        <td class="text-center">{{ $log->log }}</td>
        <td class="text-center">{{ $log->date->format("Y-m-d g:i a") }}</td>
    </tr>
@endforeach