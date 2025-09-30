<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Medica - Response Message</title>
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
      color: #1e293b;
    }

    .content h3 {
      margin-top: 0;
      color: #1e40af;
    }

    .content p {
      line-height: 1.6;
      margin: 14px 0;
      color: #475569;
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
      <img src="{{ asset('/assets/images/Medica_icon_2.png') }}" alt="Medica Logo">
      <h2>Medica Support</h2>
    </div>
    <div class="content">
      <h3>Thank you for contacting us!</h3>
      <p>Hi {{$name}},</p>
      <p>We’ve received your message and our support team is already on it. We aim to respond within 24 hours, and we’ll make sure to provide you with the assistance you need as quickly as possible.</p>
      <p>In the meantime, if you have any updates or need to share more info, feel free to reply to this email.</p>
      <p>Thanks again for reaching out to <strong>Medica</strong> — your health is our priority 💙</p>
    </div>

    <div class="footer">
      Medica Support Team<br>
      This is an automated response. Please do not reply directly to this email.
    </div>
  </div>

</body>
</html>
