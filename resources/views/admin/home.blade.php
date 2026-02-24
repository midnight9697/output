@extends('layout.app')

@section('head_js')
    @vite(['resources/js/home.js'])
@endsection

@section('main_content')
    @include('admin.home.grid', [ 'count_user' => $count_user, 'count_supplier' => $count_supplier, 'count_pr' => $count_pr, 'count_rfq' => $count_rfq ])
    <!-- TABLE -->
    <div class="table-container">
        <h3 style="margin-bottom:15px;">Recent Transactions</h3>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>User</th>
              <th>Date</th>
              <th>Status</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#1001</td>
              <td>John Doe</td>
              <td>2026-02-20</td>
              <td><span class="success">Completed</span></td>
              <td>$120.00</td>
            </tr>
            <tr>
              <td>#1002</td>
              <td>Jane Smith</td>
              <td>2026-02-21</td>
              <td><span class="warning">Pending</span></td>
              <td>$75.00</td>
            </tr>
            <tr>
              <td>#1003</td>
              <td>Michael Lee</td>
              <td>2026-02-22</td>
              <td><span class="danger">Failed</span></td>
              <td>$210.00</td>
            </tr>
          </tbody>
        </table>
      </div>
@endsection
@section('custom_js')
    <script async defer src="{{env('MARCO_MAP_API')}}&callback=initMap"></script>
    <script>
        localStorage.setItem('asset', "{{ asset('mapicon.png') }}");
    </script>
@endsection