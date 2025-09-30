
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Medica - Contact Message</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f4f7fe;
      padding: 40px;
    }

    .email-wrapper {
      max-width: 600px;
      margin: auto;
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07);
      overflow: hidden;
      border: 1px solid #e2e8f0;
    }

    .header {
      background-color: #2563eb;
      padding: 20px;
      color: white;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .header img {
      height: 40px;
    }

    .header h2 {
      margin: 0;
      font-size: 22px;
    }

    .content {
      padding: 30px;
    }

    .content h3 {
      margin-top: 0;
      color: #1e293b;
    }

    .info {
      margin-top: 20px;
    }

    .info p {
      margin: 12px 0;
      color: #475569;
      line-height: 1.6;
    }

    .label {
      font-weight: 600;
      color: #1e293b;
    }

    .footer {
      text-align: center;
      padding: 15px;
      background-color: #f1f5f9;
      font-size: 14px;
      color: #64748b;
    }
  </style>
</head>
<body>

  <div class="email-wrapper">
    <div class="header">
      <img src={{ asset('/assets/images/Medica_icon_2.png') }} alt="Medica Logo"> 
      <h2>Medica Support</h2>
    </div>

    <div class="content">
      <h3>New Support Request</h3>
      <div class="info">

        <p><span class="label">Name:</span>{{ $name }} </p>
        <p><span class="label">Mail address:</span> {{ $email }}</p>
        <p><span class="label">Phone number:</span>{{ $phone }}</p>
        <p><span class="label">Problem:</span>{{ $msg }} </p>
      </div>
    </div>

    <div class="footer">
      This message was sent from Medica contact system.
    </div>
  </div>

</body>
</html>
