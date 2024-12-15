<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Drag and Drop Gambar dengan Desain Menarik</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    h1 {
      color: #333;
      margin-bottom: 30px;
    }

    .container {
      display: flex;
      gap: 30px;
    }

    .dropzone {
      width: 220px;
      height: 220px;
      border: 2px dashed #ccc;
      border-radius: 15px;
      background: linear-gradient(145deg, #e6e6e6, #ffffff);
      box-shadow: 8px 8px 16px #d1d1d1, -8px -8px 16px #ffffff;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      transition: all 0.3s ease-in-out;
      position: relative;
    }

    .dropzone:hover {
      border-color: #007bff;
      transform: scale(1.05);
      background: linear-gradient(145deg, #ffffff, #f3f3f3);
      box-shadow: 10px 10px 20px #d1d1d1, -10px -10px 20px #ffffff;
    }

    .dropzone img {
      max-width: 100%;
      max-height: 100%;
      cursor: grab;
      transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .dropzone.dragover {
      border-color: #007bff;
      background-color: #e7f0ff;
      transform: scale(1.1);
      box-shadow: 10px 10px 20px rgba(0, 123, 255, 0.3);
    }

    .dropzone.dragover img {
      transform: scale(0.95);
      opacity: 0.8;
    }

    .container::before {
      content: "Drag and drop images between boxes";
      font-size: 16px;
      color: #555;
      position: absolute;
      top: 10px;
    }
  </style>
</head>
<body>
  <h1>Drag and Drop Antar Div</h1>
  <div class="container">
    <div class="dropzone">
      <img src="https://via.placeholder.com/150/ff0000/ffffff?text=Image+1" alt="Gambar 1" draggable="true">
    </div>
    <div class="dropzone">
      <img src="https://via.placeholder.com/150/0000ff/ffffff?text=Image+2" alt="Gambar 2" draggable="true">
    </div>
  </div>

  <script>
    $(document).ready(function () {
      let draggedImage = null;

      // Event dragstart untuk menangkap elemen gambar yang sedang di-drag
      $('.dropzone img').on('dragstart', function (event) {
        draggedImage = $(this); // Simpan elemen gambar sebagai referensi
      });

      // Event dragover untuk mencegah default behavior
      $('.dropzone').on('dragover', function (event) {
        event.preventDefault(); // Harus ada untuk memungkinkan drop
        $(this).addClass('dragover'); // Tambahkan efek visual
      });

      // Event dragleave untuk menghapus efek visual ketika keluar dari dropzone
      $('.dropzone').on('dragleave', function () {
        $(this).removeClass('dragover');
      });

      // Event drop untuk memindahkan gambar
      $('.dropzone').on('drop', function (event) {
        event.preventDefault(); // Cegah perilaku default
        $(this).removeClass('dragover'); // Hapus efek visual

        // Ambil gambar yang sudah ada di dropzone target
        const existingImage = $(this).find('img');

        // Jika ada gambar yang sedang di-drag
        if (draggedImage) {
          // Pindahkan gambar yang sudah ada ke tempat asal gambar yang sedang di-drag
          const sourceDropzone = draggedImage.closest('.dropzone');
          sourceDropzone.append(existingImage);

          // Pindahkan gambar yang di-drag ke dropzone target
          $(this).append(draggedImage);
        }
      });
    });
  </script>
</body>
</html>