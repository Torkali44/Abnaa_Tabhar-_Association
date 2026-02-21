<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>جمعية أبناء طبهار الخيرية</title>
    <meta name="description" content="نظام إدارة جمعية أبناء طبهار الخيرية - كفاءة، شفافية، وعطاء" />
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['src/main.tsx', 'src/index.css'])
    
    <style>
      body {
        font-family: 'Cairo', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8fafc;
      }
      .initial-loader {
        position: fixed;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #ffffff;
        z-index: 9999;
        transition: opacity 0.5s ease-out;
      }
      .loader-logo {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        font-weight: bold;
        box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4);
        margin-bottom: 2rem;
        animation: pulse 2s infinite ease-in-out;
      }
      .loader-bar {
        width: 200px;
        height: 4px;
        background-color: #e2e8f0;
        border-radius: 2px;
        overflow: hidden;
      }
      .loader-progress {
        height: 100%;
        background-color: #10b981;
        width: 0%;
        animation: progress 2s infinite;
      }
      @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
      }
      @keyframes progress {
        0% { width: 0%; left: 0; }
        50% { width: 70%; left: 15%; }
        100% { width: 0%; left: 100%; }
      }
    </style>
  </head>

  <body>
    <div id="initial-loader" class="initial-loader">
      <div class="loader-logo">ط</div>
      <div class="loader-bar">
        <div class="loader-progress"></div>
      </div>
      <p style="margin-top: 1rem; color: #64748b; font-weight: 500;">جاري تحميل النظام...</p>
    </div>

    <div id="root"></div>

    <script>
      window.addEventListener('load', function() {
        const loader = document.getElementById('initial-loader');
        if (loader) {
          loader.style.opacity = '0';
          setTimeout(() => {
            loader.style.display = 'none';
          }, 500);
        }
      });
    </script>
  </body>
</html>
