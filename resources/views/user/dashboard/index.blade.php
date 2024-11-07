<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - FinTech</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      height: 100vh;
      background-color: #f5f7fb;
    }

    .sidebar {
      background-color: #2c3e50;
      color: #fff;
      padding: 30px;
      width: 250px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .sidebar-menu {
      list-style-type: none;
    }

    .sidebar-menu li {
      margin-bottom: 15px;
    }

    .sidebar-menu a {
      color: #fff;
      text-decoration: none;
      display: block;
      padding: 12px 20px;
      border-radius: 6px;
      transition: background-color 0.3s ease;
    }

    .sidebar-menu a:hover {
      background-color: #34495e;
    }

    .sidebar-menu i {
      margin-right: 12px;
      font-size: 18px;
    }

    .sidebar-footer {
      text-align: center;
    }

    .sidebar-footer a {
      color: #fff;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .sidebar-footer a:hover {
      color: #bdc3c7;
    }

    .main-content {
      flex-grow: 1;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .upload-container {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 30px;
      width: 100%;
      max-width: 600px;
    }

    .upload-container h2 {
      margin-bottom: 20px;
      text-align: center;
      color: #2c3e50;
    }

    .upload-button {
      display: block;
      width: 100%;
      background-color: #2980b9;
      color: white;
      padding: 14px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .upload-button:hover {
      background-color: #2471a3;
    }

    .file-list {
      margin-top: 30px;
      width: 100%;
      max-width: 600px;
    }

    .file-item {
      display: flex;
      align-items: center;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 15px;
      margin-bottom: 15px;
    }

    .file-icon {
      font-size: 24px;
      margin-right: 15px;
      color: #2980b9;
    }

    .file-name {
      flex-grow: 1;
      font-weight: bold;
      color: #2c3e50;
    }

    .file-actions a {
      color: #2980b9;
      margin-left: 10px;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .file-actions a:hover {
      color: #2471a3;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <ul class="sidebar-menu">
      <li><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
      <li><a href="#"><i class="fas fa-file-upload"></i> Upload</a></li>
      <li><a href="#"><i class="fas fa-file-alt"></i> Files</a></li>
      <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
    </ul>
    <div class="sidebar-footer">
      <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>

  <div class="main-content">
    <div class="upload-container">
      <h2>Upload File</h2>
      <input type="file" id="file-input" multiple>
      <button class="upload-button">Upload</button>
    </div>

    <div class="file-list">
      <h2 style="color: #2c3e50; margin-bottom: 20px;">Uploaded Files</h2>
      <div class="file-item">
        <i class="fas fa-file-alt file-icon"></i>
        <div class="file-name">example.pdf</div>
        <div class="file-actions">
          <a href="#"><i class="fas fa-download"></i></a>
          <a href="#"><i class="fas fa-trash-alt"></i></a>
        </div>
      </div>
      <div class="file-item">
        <i class="fas fa-image file-icon"></i>
        <div class="file-name">image.jpg</div>
        <div class="file-actions">
          <a href="#"><i class="fas fa-download"></i></a>
          <a href="#"><i class="fas fa-trash-alt"></i></a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>