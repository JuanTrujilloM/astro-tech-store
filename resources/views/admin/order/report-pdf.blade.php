<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>{{ __('messages.admin.order_report_title') }}</title>
</head>

<body>
  <h1>{{ __('messages.admin.order_report_title') }}</h1>
  <p>{{ __('messages.admin.order_report_generated') }}: {{ now()->format('Y-m-d H:i:s') }}</p>

  <table border="1" width="100%">
    <thead>
      <tr>
        <th>{{ __('messages.admin.id') }}</th>
        <th>{{ __('messages.admin.user') }}</th>
        <th>{{ __('messages.admin.total') }}</th>
        <th>{{ __('messages.admin.date') }}</th>
        <th>{{ __('messages.orders.status') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($orders as $order)
        <tr>
          <td>{{ $order->getId() }}</td>
          <td>{{ $order->getUser()->getName() }}</td>
          <td>${{ number_format($order->getTotal(), 0, ',', '.') }}</td>
          <td>{{ $order->getCreatedAt() }}</td>
          <td>{{ $order->getStatus() }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <p>{{ __('messages.admin.footer_rights') }}</p>
</body>

</html>
