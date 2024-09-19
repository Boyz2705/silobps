<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Appointment Recap</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css2/styles-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cssku.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <script src="{{ asset('https://use.fontawesome.com/releases/v6.1.0/js/all.js') }}" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid p-5">
        <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    <th>App_ID</th>
                    <th>User</th>
                    <th>Services</th>
                    <th>Date</th>
                    <th>Session</th>
                    <th>Pet</th>
                    <th>Clinic</th>
                    <th>Detail</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apps as $app)
                <tr>
                <td>{{ $app->id }}</td>
                <td>{{ $app->user['name'] }}</td>
                <td>{{ $app->service['services_name'] }}</td>
                <td>{{ $app->app_date }}</td>
                <td>{{ $app->session['time'] }}</td>
                <td>{{ $app->pet['pet_name'] }}</td>
                <td>{{ $app->clinic['clinic_name'] }}</td>
                <td>{{ $app->detail }}</td>
                <td>{{ $app->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script>
      $(document).ready(function() {
      $('#example').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ]
      } );
  } );
  </script>
</body>
</html>